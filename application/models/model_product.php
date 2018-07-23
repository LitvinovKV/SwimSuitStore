<?php

    class Model_Product {

        private $connection;

        function __construct() {
            $this->connection = DataBaseConnection::$connect;
        }

        // Найти весть товар, который может размещаться на определенной странице одной категории
        // На вход : $pageNumber - Номер страницы на которой будет отображаться по 8шт товара
        // $CategoryName - название категории
        // На выходе массив из элементов, которые должны отображаться на определенной странице
        function getArrayProductCategory($pageNumber, $CategoryName) {
            // Поменять название категории на русское как в БД
            $CategoryName = LanguageSelect::$SubCateLang[$CategoryName];
            // Запрос, чтобы получить идентификатор категории
            $sql_query = "SELECT id_category FROM category WHERE name = '" . $CategoryName . "'";
            $CategoryId = $this->connection->query($sql_query)->fetch_assoc()["id_category"];

            // По идентификатору категории, найти все названия подкатегорий которые входят в эту категорию
            $sql_query = "SELECT name FROM subcategory WHERE id_category = " . $CategoryId;
            $res = $this->connection->query($sql_query);
            $ProductsArray = [];
            $result = [];
            // Пройтись по каждой подкатегории, вызвать метод класса getSubCategoryProducts() и найти товар это подкатегории
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                $SubCategoryNameEng = array_search($res->fetch_assoc()['name'], LanguageSelect::$SubCateLang);
                $ProductsArray = $this->getSubCategoryProducts($SubCategoryNameEng);
                // Разбить массив с продуктами на элементы и положить каждый отдельно в массив
                // (если этого не сделать, то итоговый массив будет состоять из массивов с элементами)
                for($j = 0; $j < count($ProductsArray); $j++)
                    array_push($result, $ProductsArray[$j]);
            }
            $result = $this->getProductsOnPages($result, $pageNumber);
            return $result;
        }

        // Найти весть товар, который может размещаться на определенной странице определенной подкатегории
        // На вход : $pageNumber - Номер страницы на которой будет отображаться по 8шт товара
        // $SubCategoryName - название подкатегории
        // На выходе массив из элементов, которые должны отображаться на определенной странице
        function getSubCategoryProductsForPage($pageNumber, $SubCategoryName) {
            $result = $this->getSubCategoryProducts($SubCategoryName);
            // возвращать кол-во товара в зависимости от страницы (1 стр - первые 8 штук, 2 стр - с 9 по 16 позицию и т.д.)
            $result = $this->getProductsOnPages($result, $pageNumber);
            return $result;
        }

        // Метод для нахождения товара в определенной подкатегории
        // На вход : название подкатегории
        // На выходе : массив с перечнем товара, который включает в себя такие данные как
        // (идентификатор товраа, на акции он или нет, кол-во товара, фото обложка)
        function getSubCategoryProducts($SubCategoryName) {
            // Получить название подкатегории на русском языке
            $DBSubCategoryName = LanguageSelect::$SubCateLang[$SubCategoryName];
            // Если подкатегория является купальником, тогда в дальнейшем выполнить запрос на поиск
            // товаров акций для купальников. Иначе для товаров акций нижнего белья
            if (in_array($SubCategoryName, LanguageSelect::$templateData["SwimWearCatName"]["Hrefs"]) === true)
                $SharesName = "Акции Купальники";
            else
                $SharesName = "Акции Нижнее белье";
            
            // Запрос для нахождения id нужной подкатегории 
            $sql_query = "SELECT id_subcategory FROM subcategory WHERE name = '" . $DBSubCategoryName . "'";
            $SubCategoryId = $this->connection->query($sql_query)->fetch_assoc()["id_subcategory"];

            // Запрос для нахождения id нужной акции (раздел подкатегории)
            $sql_query = "SELECT id_subcategory FROM subcategory WHERE name = '" . $SharesName . "'";
            $SharesSubCategoryId = $this->connection->query($sql_query)->fetch_assoc()["id_subcategory"];

            // Найти все продукты входящими в данную подкатегорию
            $ProductsArrayId = $this->getProductsInSubcategory($SubCategoryId);

            // Найти все продукты подходящие под акцию
            $SharesArrayId = $this->getProductsInSubcategory($SharesSubCategoryId);

            // Из выбранных товаров из подкатегории, пометить флагом те товары, который относятся к акциям
            // (присутсвуют в массиве с товарами акций)
            $result = [];
            for ($i = 0; $i < count($ProductsArrayId); $i++) {
                $QuantityFlag = $this->getProductQuantityFlag($ProductsArrayId[$i]);
                $PhotoName = $this->getProductGeneralPhoto($ProductsArrayId[$i]);
                if (in_array($ProductsArrayId[$i], $SharesArrayId))
                    array_push($result, array( "id_product" => $ProductsArrayId[$i], "is_share" => true, 
                        "quantity" => $QuantityFlag, "photo" => $PhotoName));
                else
                array_push($result, array( "id_product" => $ProductsArrayId[$i], "is_share" => false, 
                    "quantity" => $QuantityFlag, "photo" => $PhotoName));
            }

            return $result;
        }

        // Метод, который находит все продукты входящие в данную подкатегорию
        // На вход : идентификатор подкатегории
        // На выходе : массив из продуктов данной подкатегории
        private function getProductsInSubcategory($SubCategoryId) {
            $sql_query = "SELECT id_product FROM product_subcategory WHERE id_subcategory = " . $SubCategoryId;
            $res = $this->connection->query($sql_query);
            $ProductsArrayId = [];
            for ($i = 0; $i < $res->num_rows; $i++) {
                $res->data_seek($i);
                array_push($ProductsArrayId, $res->fetch_assoc()["id_product"]);
            }
            return $ProductsArrayId;
        }

        // Метод, который возвращает информацию о продукте
        // в зависимости от кол-ва товара
        // true - если такой товар в наличии есть, то отоброжать его
        // flase - если такого товара нет, и его отоброжать не стоит
        // На вход : идентификатор продукта
        // На выходе : boolean (флаг)
        private function getProductQuantityFlag($ProductId) {
            $sql_query = "SELECT quantity FROM product WHERE id_product = " . $ProductId;
            $quantity = $this->connection->query($sql_query)->fetch_assoc()["quantity"];
            if ((int)$quantity === 0) return false;
            else return true;
            return $quantity;
        }


        // Метод который обрезает массив, для того чтобы выводить на определенной странице только те элементы
        // которые ей соответсвуют по номеру
        // На входе : $ArrayProducts - Массив из продуктов, $pageNumber - номер страницы
        // На выходе : Урезанный массив для отображения соответствующего товара на странцие 
        private function getProductsOnPages($ArrayProducts, $pageNumber) {
            // Индекс в массиве для конечного элемента, который будет выводиться в каталоге
            $endProduct = $pageNumber * 7;
            // Индекс в массиве для начинающего элемента, который будет выводиться в каталоге
            $startProduct = $endProduct - 7;
            return array_slice($ArrayProducts, $startProduct, $endProduct);
        }

        // Метод, который возвращает главную (для обложки) фотографию продукта
        // На вход : идентификатор продукта
        // На выходе : название фотографии
        private function getProductGeneralPhoto($ProductId) {
            $sql_query = "SELECT name FROM photo WHERE id_product = " . $ProductId;
            $PhotoName = $this->connection->query($sql_query)->fetch_assoc()["name"];
            return $PhotoName;
        }
    }

?>