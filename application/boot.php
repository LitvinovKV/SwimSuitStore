<?php

    // Подключить основные (ядро) классы
    require_once("core/controller.php");
    require_once("core/model.php");
    require_once("core/route.php");
    require_once("core/view.php");

    // Подключить файл с конфигурацией бд
    require_once("db_settings.php");
    // Создать соединение с базой
    $link = mysqli_connect($hostname, $username, $password, $dbName);
    // Проверить если не было соединения, то ошибка и досрочное завершение
    if ($link == false) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    // Запустить основной статический метод для маршрутизации
    Route::start();
?>