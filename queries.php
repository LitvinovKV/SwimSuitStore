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
?>