<?php

    class Model_Productcard {

        private $connection;

        function __construct() {
            $this->connection = DataBaseConnection::$connect;
        }

        function getProductInformation($id_product) {
            $sql_query = "SELECT * FROM product WHERE id_product = " . $id_product;
            $product = $this->connection->query($sql_query)->fetch_assoc();
            
            $arrayColor = [];
            $sql_query = "SELECT id_color FROM product_color WHERE id_product = " . $id_product;
            $res = $this->connection->query($sql_query);
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($arrayColor, $this->getColorName($res->fetch_assoc()["id_color"]));
            }

            $arraySize = [];
            $sql_query = "SELECT id_size FROM product_size WHERE id_product = " . $id_product;
            $res = $this->connection->query($sql_query);
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($arraySize, $this->getSizeProduct($res->fetch_assoc()["id_size"]));
            }
            
            $result = array(
                "main" => $product,
                "colors" => $arrayColor,
                "sizes" => $arraySize,
                "generalPhoto" => $this->getGeneralPhotoProduct($id_product),
                "photos" => $this->getPhotoProduct($id_product),
                "path" => $this->getHrefsProduct($id_product)
            );
            return $result;
        }

        private function getColorName($id_color) {
            $sql_query = "SELECT name FROM color WHERE id_color = " . $id_color;
            $result = $this->connection->query($sql_query)->fetch_assoc()["name"];
            return $result;
        }

        private function getSizeProduct($id_size) {
            $sql_query = "SELECT name FROM size WHERE id_size = " . $id_size;
            $result = $this->connection->query($sql_query)->fetch_assoc()["name"];
            return $result;
        }

        private function getPhotoProduct($id_product) {
            $sql_query = "SELECT name FROM photo WHERE id_product = " . $id_product . " AND is_general = 0";
            $res = $this->connection->query($sql_query);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc()["name"]);
            }
            return $result;
        }

        private function getGeneralPhotoProduct($id_product) {
            $sql_query = "SELECT name FROM photo WHERE id_product = " . $id_product . " AND is_general = 1";
            $PhotoName = $this->connection->query($sql_query)->fetch_assoc()["name"];
            return $PhotoName;
        }

        private function getHrefsProduct($id_product) {
            $sql_query = "SELECT id_subcategory FROM product_subcategory WHERE id_product = " . $id_product;
            $id_subcategory = $this->connection->query($sql_query)->fetch_assoc()["id_subcategory"];

            $sql_query = "SELECT name, id_category FROM subcategory WHERE id_subcategory = " . $id_subcategory;
            $subcategory = $this->connection->query($sql_query)->fetch_assoc();
            $NameSubcategory = $subcategory["name"];

            $sql_query = "SELECT name FROM category WHERE id_category = " . $subcategory["id_category"];
            $NameCategory = $this->connection->query($sql_query)->fetch_assoc()["name"];
            $result = array(
                "RU" => [$NameCategory, $NameSubcategory],
                "ENG" => [array_search($NameCategory, LanguageSelect::$SubCateLang), 
                            array_search($NameSubcategory, LanguageSelect::$SubCateLang)]
            );
            return $result;
        }
    }

?>