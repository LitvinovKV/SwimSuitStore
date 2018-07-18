<?php

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

?>