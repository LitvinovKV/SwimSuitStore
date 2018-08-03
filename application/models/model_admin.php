<?php

    class Model_Admin extends Model{        

        private $connection;

        function __construct() {
            $this->connection = DataBaseConnection::$connect;
        }

        function getData() {
            return array(
                "colors" => $this->getSimpleQueryFromDB("name", "color"),
                "sizes" => $this->getSimpleQueryFromDB("name", "size"),
                "id_products" => $this->getSimpleQueryFromDB("id_product", "product"),
                "categories" => $this->getSimpleQueryFromDB("name", "category"),
                "subcategories" => $this->getSimpleQueryFromDB("name", "subcategory"),
                "hits" => $this->getHitsProducts()
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

    }

?>