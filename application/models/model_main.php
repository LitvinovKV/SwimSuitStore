<?php

    class Model_Main extends Model {

        // Переопределение метода родительского класса
        function getData() {
            $allData = array(
                "banners" => $this->getOwlPictures(),
                "hits" => $this->getHitPictures(),
                "bottom" => $this->getBottomPictures()
            );
            return $allData;
        }

        // Метод, который возвращает массив с названиями
        // изображений для карусели на главной странице (5 шт)
        private function getOwlPictures() {
            $result = [];
            $connect = DataBaseConnection::$connect;
            $res = $connect->query("SELECT name FROM general_photo WHERE name LIKE 'banner%'");
            for($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                $row = $res->fetch_assoc();
                array_push($result,$row['name']);
            }
            return $result;
        }

        // Метод, который возвращает массив с названиями
        // изображений для выбора товаров на главную страницу (товар ХИТ - 3 шт)
        private function getHitPictures() {
            $result = [];
            $id = [];
            $connect = DataBaseConnection::$connect;
            // Сделать выборку по продуктам, которые являются хитами
            $res = $connect->query("SELECT id_product FROM product WHERE is_hit = 1");
            for($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                // Сформировать массив из сделанной выборки по таблице PRODUCT, где is_hit === 1
                $row = $res->fetch_assoc();
                // Сделать выборку по имени фотографий, выбрать только первые
                $new_res = $connect->query("SELECT name FROM photo WHERE id_product = " . 
                    $row['id_product']);
                // Сформировать массив из сделанной выборке по таблице PHOTO
                $new_row = $new_res->fetch_assoc();
                // Сформировать конечный массив из двух предыдущих
                $resultArray = array(
                    "id_product" => $row['id_product'],
                    "name" => $new_row['name']
                );
                array_push($result, $resultArray);
            }
            return $result;
        }

        // Метод, который возващает название изоброжения
        // для главной странице конце страницы (1 шт)
        private function getBottomPictures() {
            $connect = DataBaseConnection::$connect;
            $res = $connect->query("SELECT name FROM general_photo WHERE name LIKE 'bottom%'");
            return $res->fetch_assoc()['name'];
        }
    }

?>