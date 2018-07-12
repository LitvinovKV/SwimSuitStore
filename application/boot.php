<?php

    // Подключить основные (ядро) классы
    require_once("core/controller.php");
    require_once("core/model.php");
    require_once("core/route.php");
    require_once("core/view.php");

    // Запустить основной статический метод для маршрутизации
    Route::start();
?>