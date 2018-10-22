<?php

    class Model_Admin extends Model{        

        private $connection;

        function __construct() {
            $this->connection = DataBaseConnection::$connect;
        }

        function getData() {
            return array(
                "colors" => $this->getColors(),
                "sizes" => $this->getSimpleQueryFromDB("name", "size"),
                "id_products" => $this->getSimpleQueryFromDB("id_product", "product"),
                "categories" => $this->getSimpleQueryFromDB("name", "category"),
                "subcategories" => $this->getSimpleQueryFromDB("name", "subcategory"),
                "hits" => $this->getHitsProducts(),
                "products" => $this->getProducts(),
                "orders" => $this->getOrders(),
                "reviews" => $this->getReviews()
            );
        }

        // Данный метод производит выборку из БД (если запрос простой)
        // На входе: $RowName - название столбца, по кторому делается выборка
        // $tableName - название таблицы
        // На выходе: массив выбранных элементов
        private function getSimpleQueryFromDB($RowName, $tableName) {
            $sql_query = "SELECT ". $RowName . " FROM " . $tableName;
            $res = $this->connection->query($sql_query);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc()[$RowName]);
            }
            return $result;
        }

        // Данный метод производит выборку из БД
        // На выходе: массив состоящий из двух элементов:
        // 1 - кол-во товаров хитов
        // 2 - массив из идентификаторов продуктов, которые являются хитами
        private function getHitsProducts() {
            $sql_query = "SELECT COUNT(*) AS COUNT FROM `product` WHERE `is_hit` = " . 1;
            $count_hits = $this->connection->query($sql_query)->fetch_assoc()["COUNT"];
            
            $sql_query = "SELECT `id_product` FROM `product` WHERE `is_hit` = " . 1;
            $res = $this->connection->query($sql_query);
            $result = [];
            for($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc()["id_product"]);
            }
            return array($count_hits, $result);
        }

        // Данный метод производит выборку из БД
        // На выходе: массив состоящий из двух элементов:
        // 1 - идентификатор товара
        // 2 - названия его фотографий
        private function getProducts() {
            $id_products = $this->getSimpleQueryFromDB("id_product", "product");

            $result = [];
            for ($i = 0; $i < count($id_products); $i++) {
                
                // Все названия изображений продукта
                $sql_query = "SELECT `name` FROM `photo` WHERE `id_product` = " . $id_products[$i];
                $res = $this->connection->query($sql_query);
                $Pictures = [];
                for ($j = 0; $j < $res->num_rows; $j++) {
                    $res->data_seek($j);
                    array_push($Pictures, $res->fetch_assoc()["name"]);
                }

                $hit = $this->getSimpleQueryFromDB("is_hit", "product");
                array_push($result, array(
                    "id" => $id_products[$i],
                    "photos" => $Pictures,
                    "subcategories" => $this->simpleQueryForProduct($id_products[$i], "product_subcategory", "subcategory", "id_subcategory"),
                    "Colors" => $this->simpleQueryForProduct($id_products[$i], "product_color", "color", "id_color"),
                    "Sizes" => $this->simpleQueryForProduct($id_products[$i], "product_size", "size", "id_size"),
                    "Hit" => $hit[$i]
                ));
            }
            return $result;
        }

        // Вспомогательная ф-ия для выборки из БД для продукта
        private function simpleQueryForProduct($idProduct, $FirstTableName, $SecondTableName, $FirstParam) {
            $sql_query = <<<FIRSTQUERY
            SELECT `$FirstParam` FROM `$FirstTableName` WHERE `id_product` = $idProduct
FIRSTQUERY;
            $res = $this->connection->query($sql_query);
            $Result = [];
            for ($j = 0; $j < $res->num_rows; $j++) {
                $res->data_seek($j);
                $need_id = $res->fetch_assoc()[$FirstParam];
                $sql_query = <<<SECONDQUERY
                SELECT `name` FROM `$SecondTableName` WHERE `$FirstParam` =  $need_id;
SECONDQUERY;
                array_push($Result, $this->connection->query($sql_query)->fetch_assoc()["name"]);
            }
            return $Result;
        }

        // Метод, который возвращает массив с полной информацией по заказам
        private function getOrders() {
            $sql_query = "SELECT * FROM `orders`";
            $res = $this->connection->query($sql_query);
            $result = [];
            for($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc());
            }
            return $result;
        }

        // Метод, который возвращает массив с полной информацией по цветам
        private function getColors() {
            $sql_query = "SELECT * FROM `color`";
            $res = $this->connection->query($sql_query);
            $result = [];
            for($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                $color = $res->fetch_assoc();
                array_push($result, array(
                    "id" => $color["id_color"],
                    "name_ru" => $color["name"],
                    "name_eng" => $color["name_eng"],
                    "path" => $color["path_name"]
                ));
            }
            return $result;
        }

        // Метод, который возвращает массив с фотографиями отзывов (строки как ссылки)
        private function getReviews() {
            $sql_query = "SELECT `HrefPic`, `ID_Reviews` FROM `reviews`";
            $res = $this->connection->query($sql_query);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                $review = $res->fetch_assoc();
                array_push($result, array(
                    "id" => $review["ID_Reviews"],
                    "href" => $review["HrefPic"]
                ));
            }
            return $result;
        }
    }

?>