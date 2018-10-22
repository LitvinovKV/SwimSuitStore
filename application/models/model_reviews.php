<?php
    class Model_Reviews extends Model{        

        private $connection;

        function __construct() {
            $this->connection = DataBaseConnection::$connect;
        }

        function getData() {
            return $this->getReviews();
        }

        private function getReviews() {
            $sql_query = "SELECT `HrefPic`, `HrefInst` FROM `reviews`";

            $res = $this->connection->query($sql_query);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                $review = $res->fetch_assoc();
                array_push($result, array(
                    "HrefPic" => $review["HrefPic"],
                    "HrefInst" => $review["HrefInst"]
                ));
            }

            return $result;
        }
    }
?>