<?php

    // Статический класс, с помощью которого можно будет
    // отслеживать и изменять язык интерфейса.
    // По умолчанию язык русский, может меняться на Английский
    // Если был отправлен запрос на сервер
    class LanguageSelect {
        public static $lang;
        public static $templateData;
        public static $SubCateLang = array (
            "swimwear" => "Купальники",
            "underwear" => "Нижнее белье",
            "patterns" => "Принты",
            "swimsuit" => "Слитные",
            "two_piece" => "Раздельные",
            "printed" => "Принтованные",
            "one_piece" => "Однотонные",
            "bra" => "Бюстгалтеры",
            "underpants" => "Трусы",
            "body" => "Боди",
            "swimwearshares" => "Акции Купальники",
            "underwearshares" => "Акции Нижнее белье",
            "sleepwear" => "Пижамы"
        );
        public static $CategoryArray = ["patterns", "swimwear", "underwear"];
        public static $SubCategoryArray = ["swimsuit", "two_piece", "printed", "one_piece", "bra",
            "underpants", "body", "swimwearshares", "underwearshares"];

        // Статический метод для смены элементов в тегах footer и header на Русский язык
        public static function setRU() {
            self::$templateData = array(
                "SwimWearCatName" => array(
                    "Name" => "КУПАЛЬНИКИ",
                    "Elements" => ["ВСЕ", "СЛИТНЫЕ", "РАЗДЕЛЬНЫЕ", "ПРИНТОВАННЫЕ", "ОДНОТОННЫЕ", "АКЦИИ"],
                    "Hrefs" => ["", "swimsuit", "two_piece", "printed", "one_piece", "swimwearshares"]
                ),
                "UnderWearCatName" => array(
                    "Name" => "НИЖНЕЕ БЕЛЬЕ",
                    "Elements" => ["ВСЕ", "БЮСТГАЛТЕРЫ", "ТРУСЫ", "БОДИ", "ПИЖАМЫ", "АКЦИИ"],
                    "Hrefs" => ["", "bra", "underpants", "body", "sleepwear", "underwearshares"]
                ),
                "PatternsCatName" => "ПРИНТЫ",
                "FAQCatName" => array(
                    "Name" => "FAQ",
                    "Elements" => ["УСЛОВИЯ ОПЛАТЫ", "УСЛОВАИЯ ДОСТАВКИ", "ГАРАНТИЯ НА ТОВАР", "РАЗМЕРНАЯ СЕТКА", "ИНДИВИДУАЛЬНЫЙ ПОШИВ"],
                    "Hrefs" => ["payment", "delivery", "guarantee", "chart", "tailoring"]
                ),
                "ReviewsCatName" => "ОТЗЫВЫ",
                "AboutCatName" => "О НАС",
                "OtherSentences" => ["ПОДПИСАТЬСЯ НА НОВОСТИ", "Узанать о новостях и акциях!", 
                    "МЫ В СОЦИАЛЬНЫХ СЕТЯХ", "СЛУЖБА ПОДДЕРЖКИ ПОКУПАТЕЛЕЙ"],
                "GeneralBannerButton" => "ПОСМОТРЕТЬ ВСЕ",
                "GeneralProductButton" => "КУПИТЬ СЕЙЧАС",
                "GeneralJoinButton" => "ПРИСОЕДЕНИТЬСЯ К ",
                "Basket" => "ДОБАВИТЬ В КОРЗИНУ",
                "Size" => "РАЗМЕР",
                "Color" => "ЦВЕТ",
                "Description" => "ОПИСАНИЕ",
                "InAvailable" => "ЕСТЬ В НАЛИЧИИ",
                "NoAvailable" => "НЕТ В НАЛИЧИИ",
                "BasketName" => "Корзина",
                "BasketFirst" => "КОРЗИНА ТОВАРОВ",
                "BasketSecond" => "ОФОРМИТЬ ЗАКАЗ",
                "BasketThird" => "ПРОВЕРКА ЗАКАЗА",
                "BasketColumnFirst" => "Товар",
                "BasketColumnSecond" => "ЦЕНА",
                "BasketColumnThird" => "КОЛИЧЕСТВО",
                "BasketColumnFourth" => "СУММА",
                "BasketFirstButton" => "ОБНОВИТЬ КОРЗИНУ",
                "BasketSecondButton" => "ОФОРМЛЕНИЕ ЗАКАЗА",
                "BasketThirdButton" => "ОФОРМИТЬ ЗАКАЗ"
            );
            self::$lang = "RU";
        }

        // Статический метод для смены элементов в тегах footer и header на Английский язык
        public static function setENG() {
            self::$templateData = array(
                "SwimWearCatName" => array(
                    "Name" => "SWIMWEAR",
                    "Elements" => ["ALL", "SWIMSUIT", "TWO-PIECE", "PRINTED", "ONE-PIECE", "SHARES"],
                    "Hrefs" => ["", "swimsuit", "two_piece", "printed", "one_piece", "swimwearshares"]
                ),
                "UnderWearCatName" => array(
                    "Name" => "UNDERWEAR",
                    "Elements" => ["ALL", "BRA", "UNDERPANTS", "BODY", "Sleepwear", "SHARES"],
                    "Hrefs" => ["", "bra", "underpants", "body", "sleepwear", "underwearshares"]
                ),
                "PatternsCatName" => "PATTERNS",
                "FAQCatName" => array(
                    "Name" => "FAQ",
                    "Elements" => ["TERMS OF PAYMENT", "TERMS OF DELIVERY", "PRODUCT GUARANTEE", "SIZE CHART", "UNIQUE TAILORING"],
                    "Hrefs" => ["payment", "delivery", "guarantee", "chart", "tailoring"]
                ),
                "ReviewsCatName" => "REVIEWS",
                "AboutCatName" => "ABOUT US",
                "OtherSentences" => ["SUBSCRIBE TO NEWS", "LEARN ABOUT NEWS PROMOTIONS!", 
                    "WE ARE IN SOCIAL NETWORKS", "CUSTOMER SUPPORT SERVICE"],
                "GeneralBannerButton" => "VIEW ALL",
                "GeneralProductButton" => "SHOP NOW",
                "GeneralJoinButton" => "JOIN ",
                "Basket" => "ADD TO BASKET",
                "Size" => "SIZE",
                "Color" => "COLOR",
                "Description" => "DESCRIPTION",
                "InAvailable" => "ARE AVAILABLE",
                "NoAvailable" => "NOT AVAILABLE",
                "BasketName" => "Basket",
                "BasketFirst" => "BASKET WITH THINGS",
                "BasketSecond" => "ORDERING",
                "BasketThird" => "CHECK ORDER",
                "BasketColumnFirst" => "PRODUCT",
                "BasketColumnSecond" => "PRICE",
                "BasketColumnThird" => "QUANTITY",
                "BasketColumnFourth" => "SUBTOTAL",
                "BasketFirstButton" => "UPDATE BASKET",
                "BasketSecondButton" => "ORDERING",
                "BasketThirdButton" => "CHECKOUT"

            );
            self::$lang = "ENG";
        }
    }

?>