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
                "subcategories" => $this->getSimpleQueryFromDB("name", "subcategory")
            );
        }

        // Данный метод производит выборку из БД (если запрос простой)
        // На входе: $RowName - название столбца, по кторому делается выборка
        // $tableName - название таблицы
        // На выходе: массив выбранных элементов
        private function getSimpleQueryFromDB($RowName, $tableName) {
            $sql_quey = "SELECT ". $RowName . " FROM " . $tableName;
            $res = $this->connection->query($sql_quey);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc()[$RowName]);
            }
            return $result;
        }

    }

?>