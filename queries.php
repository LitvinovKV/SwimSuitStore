<?php

    session_start();


    // Функция для подключения к БД
    // Это делается каждый раз и отдельно, т.к. данный скрипт
    // не имеет ничего общего с основным сайтом
    function setConnectionToDB() {
        // Подключить файл с конфигурацией бд
        require_once("application/db_settings.php");
        // Создать соединение с базой
        $connect = mysqli_connect($hostname, $username, $password, $dbName);
        if ($connect == false) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        mysqli_set_charset($connect, 'utf8');
        return $connect;
    }

    // Если пришел GET запрос с параметром EmailName
    if (isset($_GET["EmailName"])) {
        // Установить соединение с БД
        $myConnection = setConnectionToDB();
        // Подготовить запрос на добавление новой почты
        $sql_query = "INSERT INTO email (email_name) VALUES ('" . $_GET["EmailName"] . "')";
        // Если запрос был успешно обработан (добавлена новая запись)
        if ($myConnection->query($sql_query) === true) {
            $result = ($_GET["Language"] === "RU") ? "Вы успешно подписаны на новости." :
                "You have successfully subscribed to the news.";    
        }
        // Ошибка запроса
        else {
            $result = ($_GET["Language"] === "RU") ? "Проблемы с подключением к БД." :
                "Problems with connecting to the database.";
        }
        echo $result;
        return;
            
    }

    // Проверка кнопки добавления в корзину
    // Basket = [
    //     [id, count, color, size], ...    
    // ]
    if (isset($_GET["AddToBasketID"]) === true && isset($_GET["AddToBasketSize"]) === true && 
    isset($_GET["AddToBasketColor"]) === true && isset($_GET["AddToBasketPhoto"]) === true && 
    isset($_GET["AddToBasketPrice"]) === true) {
        $ProductID = $_GET["AddToBasketID"];
        $Color = $_GET["AddToBasketColor"];
        $Size = $_GET["AddToBasketSize"];
        $Photo = $_GET["AddToBasketPhoto"];
        $Price = $_GET["AddToBasketPrice"];

        $connection = setConnectionToDB();
        $sql_query = "SELECT * FROM `product` WHERE `id_product` = " . $ProductID;
        $res = $connection->query($sql_query)->fetch_assoc();
        $priceRU = $res["price_ru"];
        $priceENG = $res["price_eng"];

        if (array_key_exists("Basket", $_SESSION) === true) {
            $Basket = $_SESSION["Basket"];
            $flagProductInBasket = false;

            for($i = 0; $i < count($Basket); $i++) {
                if ($Basket[$i]["id"] === $ProductID && $Basket[$i]["size"] === $Size && $Basket[$i]["color"] === $Color) {
                    $flagProductInBasket = true;
                    $_SESSION["Basket"][$i]["count"]++;
                    break;
                }
            }

            if ($flagProductInBasket === false) {
                    array_push($_SESSION["Basket"], array(
                        "id" => $ProductID,
                        "count" => 1,
                        "size" => $Size,
                        "color" => $Color,
                        "photo" => $Photo,
                        "priceRU" => $priceRU,
                        "priceENG" => $priceENG
                    ));
            }
        }
        else {
            $_SESSION["Basket"] = [];
            array_push($_SESSION["Basket"], array(
                "id" => $ProductID,
                "count" => 1,
                "size" => $Size,
                "color" => $Color,
                "photo" => $Photo,
                "priceRU" => $priceRU,
                "priceENG" => $priceENG
            ));
        }
        

        if (array_key_exists("count", $_SESSION) === true)
            $_SESSION["count"]++;
        else
            $_SESSION["count"] = 1;
        echo "Товар успешно добавлен в корзину";
    }

    if (isset($_POST["DeleteFromBasketId"]) === true && isset($_POST["DeleteFromBasketSize"]) === true 
    && isset($_POST["DeleteFromBasketColor"]) === true) {
        $_SESSION["count"]--;
        $idProduct = $_POST["DeleteFromBasketId"];
        $sizeProduct = $_POST["DeleteFromBasketSize"];
        $colorProduct = $_POST["DeleteFromBasketColor"];
        for ($i = 0; $i < count($_SESSION["Basket"]); $i++) {
            if ($_SESSION["Basket"][$i]["id"] === $idProduct && $_SESSION["Basket"][$i]["size"] === $sizeProduct &&
            $_SESSION["Basket"][$i]["color"] === $colorProduct) {
                $_SESSION["Basket"][$i]["count"]--;
                return;
            }
        }
    }

    if (isset($_POST["AddProductInBasketId"]) === true && isset($_POST["AddProductInBasketSize"]) === true && 
    isset($_POST["AddProductInBasketColor"]) === true) {
        $_SESSION["count"]++;
        $idProduct = $_POST["AddProductInBasketId"];
        $sizeProduct = $_POST["AddProductInBasketSize"];
        $colorProduct = $_POST["AddProductInBasketColor"];
        for ($i = 0; $i < count($_SESSION["Basket"]); $i++) {
            if ($_SESSION["Basket"][$i]["id"] === $idProduct && $_SESSION["Basket"][$i]["size"] === $sizeProduct &&
            $_SESSION["Basket"][$i]["color"] === $colorProduct) {
                $_SESSION["Basket"][$i]["count"]++;
                return;
            }
        }
    }

    if (isset($_POST["DeleteProductInBasketId"]) === true && isset($_POST["DeleteProductInBasketSize"]) === true && 
    isset($_POST["DeleteProductInBasketColor"]) === true) {
        $idProduct = $_POST["DeleteProductInBasketId"];
        $sizeProduct = $_POST["DeleteProductInBasketSize"];
        $colorProduct = $_POST["DeleteProductInBasketColor"];
        for ($i = 0; $i < count($_SESSION["Basket"]); $i++) {
            if ($_SESSION["Basket"][$i]["id"] === $idProduct && $_SESSION["Basket"][$i]["size"] === $sizeProduct &&
            $_SESSION["Basket"][$i]["color"] === $colorProduct) {
                $_SESSION["count"] -= $_SESSION["Basket"][$i]["count"];
                $_SESSION["Basket"][$i]["count"] = 0;
                return;
            }
        }
    }

    if (isset($_POST["AddOrderEmail"]) === true && isset($_POST["AddOrderTelephone"]) === true 
    && isset($_POST["AddOrderName"]) === true && isset($_POST["AddOrderCountry"]) == true && 
    isset($_POST["AddOrderAdress"]) === true && isset($_POST["AddOrderSecondName"]) === true && 
    isset($_POST["AddOrderCity"]) == true && isset($_POST["AddOrderIndex"]) === true && 
    isset($_POST["AddOrderDescription"]) === true && isset($_POST["AddOrderTotalSumm"]) === true && 
    isset($_POST["AddOrderDelivery"]) === true) {
        $fullName = $_POST["AddOrderSecondName"] . " " . $_POST["AddOrderName"];
        $desctiption = $_POST["AddOrderDescription"];
        $desctiption .= "<br><br> Товары:<br>";
        if (array_key_exists("Basket", $_SESSION) === true) {
            for($i = 0; $i < count($_SESSION["Basket"]); $i++) {
                if ($_SESSION["Basket"][$i]["count"] === 0) continue;
                $productString = "->Товар №" . ($i + 1) . 
                "<br>Идентификатор товара : " . $_SESSION["Basket"][$i]["id"] . 
                "<br>Кол-во товара : " . $_SESSION["Basket"][$i]["count"] . 
                "<br>Размер товара : " . $_SESSION["Basket"][$i]["size"] . 
                "<br>Цвет товара : " . $_SESSION["Basket"][$i]["color"] . 
                "<br>Цена в рублях за еденицу товара : " . $_SESSION["Basket"][$i]["priceRU"] . 
                "<br>Цена в долларах за еденицу товара : " . $_SESSION["Basket"][$i]["priceENG"];
                $desctiption .= $productString . "<br>";
            }
            $desctiption .= "Доставка : " . $_POST["AddOrderDelivery"] . "<br>Сумма заказа : " . $_POST["AddOrderTotalSumm"] . "<br>";

            $connection = setConnectionToDB();
            $sql_query = "INSERT INTO `orders` (`full_name`, `adress`, `phone_number`, `post_index`, `description`) VALUES " . 
            "('" . $fullName . "', '". $_POST["AddOrderAdress"] . "', '". $_POST["AddOrderTelephone"] . "', '" . 
            $_POST["AddOrderIndex"] . "', '". $desctiption . "')";
            if($connection->query($sql_query) === true)
                echo "Ваш заказ успешно оформлен! / Your order has been successfully registered!";
            else
                echo "Проблемы на сервере. Проверьте данные и попробуйте снова! / Problems on the server. Check the data and try again!";
        }
        else {
            echo "У Вас нет продуктор в корзине! / You haven't got products in basket";
        }
    }

    if (isset($_POST["ClearAllBaskets"]) === true) {
        unset($_SESSION["count"]);
	    unset($_SESSION["Basket"]);
    }
?>