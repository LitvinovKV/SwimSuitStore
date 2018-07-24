<?php

    // Класс который будет состоять из статических переменных
    // в которых будет содержаться максимальное кол-во страниц для
    // представления товара .../products/prints/VALUE 
    // (номер страницы  для отображения товара)
    class ProductsValues {
        public static $printsCount;
        public static $SwimwearCount;
        public static $UnderwearCount;
        public static $AllProdcutsId;

        public static function init() {
            self::$printsCount = self::calculateCountCategory("Принты");
            self::$SwimwearCount = self::calculateCountCategory("Купальники");
            self::$UnderwearCount = self::calculateCountCategory("Нижнее белье");
            self::$AllProdcutsId = self::getAllProductsIdArray();
            
        }

        // Метод, который подсчитывает кол-во страниц для купальников (общая страница)
        // На вход приходит название категории, для которой нужно найти товар
        // На выходе отдается кол-во товара нужной категории
        private function calculateCountCategory($CategoryName) {
            $connection = $connection = DataBaseConnection::$connect;
            
            // Запрос чтобы получить id определенной категории поступающей в метод 
            $sql_query = "SELECT id_category FROM category WHERE name = '" . $CategoryName . "'";
            $CategoryRes = $connection->query($sql_query);
            $idCategory = $CategoryRes->fetch_assoc()["id_category"];

            // Запрос чтобы сформировать массив из названий подкатегорий
            // чтобы в дальнейшем узнать какой товар относится к этим подкатегориям
            $sql_query = "SELECT name FROM subcategory WHERE id_category = " . $idCategory;
            $idSubCategoryRes = $connection->query($sql_query);
            $ArrayIdSubCategoty = [];
            for ($i = 0; $i < $idSubCategoryRes->num_rows; $i++) {
                $idSubCategoryRes->data_seek($i);
                $row = $idSubCategoryRes->fetch_assoc();
                array_push($ArrayIdSubCategoty, $row["name"]);
            }

            $CountProducts = 0;
            for ($i = 0; $i < count($ArrayIdSubCategoty); $i++) {
                $CountProducts += self::calculateCountSubCategory($ArrayIdSubCategoty[$i], false);
            }

            // Раздилить все кол-во товара на 8 (столько товаров будет отображаться на странице)
            $pagesCount = floor($CountProducts / 8);
            // Если еще имеется дробная часть, то увеличить число страниц на 1
            if ($CountProducts % 8 != 0) $pagesCount++;
            return $pagesCount;
        }

        // Метод который определяет кол-во товара определенной подкатегории по названию
        // Входные параметры : SubCategoryName - название подкатегории чтобы определить кол-во товара
        // относящиеся к ней
        // $flag - если flag === false, то данный метод вызывается из метода для расчета кол-во 
        // товара категории и никакие расчеты производить не нужно и вернуть только общее кол-во товара
        // подкатегории
        // если flag === true, то данный метод возвращает кол-во отображаемых страниц для заданной подкатегории
        private function calculateCountSubCategory($SubCategoryName, $flag) {
            $connection = $connection = DataBaseConnection::$connect;
            // Запрос чтобы узнать id подкатегории по ее названию
            $sql_query = "SELECT id_subcategory FROM subcategory WHERE name = '" . $SubCategoryName . "'";
            $SubCategoryId = $connection->query($sql_query)->fetch_assoc()["id_subcategory"];
            // Запрос чтобы узнать кол-во товара определенной подкатегории
            $sql_query = "SELECT COUNT(*) AS COUNT FROM product_subcategory WHERE id_subcategory = " . $SubCategoryId;
            $CountProducts = $connection->query($sql_query)->fetch_assoc()["COUNT"];
            if ($flag === false) 
                return $CountProducts;
            else {
                $pagesCount = floor($CountProducts / 8);
                if ($CountProducts % 8 != 0) $pagesCount++;
                return $pagesCount;
            }
        }

        // Функция обертка чтобы вызвать приватную ф-ию
        public static function callCountSubCategory($SubCategoryName, $flag) {
            $pagesCount = self::calculateCountSubCategory($SubCategoryName, $flag);
            return $pagesCount;
        }

        // Метод который возвращает массив всех идентификатор товаров в БД
        public static function getAllProductsIdArray() {
            $connection = $connection = DataBaseConnection::$connect;
            $sql_query = "SELECT id_product FROM product";
            $res = $connection->query($sql_query);
            $result = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($result, $res->fetch_assoc()["id_product"]);
            }
            return $result;
        }
    }

?>