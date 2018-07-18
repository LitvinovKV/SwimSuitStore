<?php

    // Статический класс, с помощью которого можно будет
    // отслеживать и изменять язык интерфейса.
    // По умолчанию язык русский, может меняться на Английский
    // Если был отправлен запрос на сервер
    class LanguageSelect {
        public static $lang;
        public static $templateData;

        // Статический метод для смены элементов в тегах footer и header на Русский язык
        public static function setRU() {
            self::$templateData = array(
                "SwimWearCatName" => array(
                    "Name" => "КУПАЛЬНИКИ",
                    "Elements" => ["СЛИТНЫЕ", "РАЗДЕЛЬНЫЕ", "ПРИНТОВАННЫЕ", "ОДНОТОННЫЕ", "АКЦИИ"]
                ),
                "UnderWearCatName" => array(
                    "Name" => "НИЖНЕЕ БЕЛЬЕ",
                    "Elements" => ["БЮСТГАЛТЕРЫ", "ТРУСЫ", "БОДИ", "АКЦИИ"]
                ),
                "PrintsCatName" => "ПРИНТЫ",
                "FAQCatName" => array(
                    "Name" => "FAQ",
                    "Elements" => ["УСЛОВИЯ ОПЛАТЫ", "УСЛОВАИЯ ДОСТАВКИ"]
                ),
                "ReviewsCatName" => "ОТЗЫВЫ",
                "AboutCatName" => "О НАС",
                "OtherSentences" => ["ПОДПИСАТЬСЯ НА НОВОСТИ", "Узанать о новостях и акциях!", 
                    "МЫ В СОЦИАЛЬНЫХ СЕТЯХ", "СЛУЖБА ПОДДЕРЖКИ ПОКУПАТЕЛЕЙ"]
            );
            self::$lang = "RU";
        }

        // Статический метод для смены элементов в тегах footer и header на Английский язык
        public static function setENG() {
            self::$templateData = array(
                "SwimWearCatName" => array(
                    "Name" => "SWIMWEAR",
                    "Elements" => ["SWIMSUIT", "TWO-PIECE", "PRINTED", "ONE-PIECE", "SHARES"]
                ),
                "UnderWearCatName" => array(
                    "Name" => "UNDERWEAR",
                    "Elements" => ["BRA", "UNDERPANTS", "BODY", "SHARES"]
                ),
                "PrintsCatName" => "PRINTS",
                "FAQCatName" => array(
                    "Name" => "FAQ",
                    "Elements" => ["TERMS OF PAYMENT", "TERMS OF DELIVERY"]
                ),
                "ReviewsCatName" => "REVIEWS",
                "AboutCatName" => "ABOUT US",
                "OtherSentences" => ["SUBSCRIBE TO NEWS", "LEARN ABOUT NEWS PROMOTIONS!", 
                    "WE ARE IN SOCIAL NETWORKS", "CUSTOMER SUPPORT SERVICE"]
            );
            self::$lang = "ENG";
        }
    }

?>