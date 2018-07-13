<?php

    // Подключить основные (ядро) классы
    require_once("core/controller.php");
    require_once("core/model.php");
    require_once("core/route.php");
    require_once("core/view.php");

    // Установить соединения с базой данных
    require_once("DBConnection.php");
    DataBaseConnection::initConnect();

    // Запустить основной статический метод для маршрутизации
    Route::start();
?>