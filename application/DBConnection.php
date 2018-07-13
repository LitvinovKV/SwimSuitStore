<?php

    // Статический класс, который будет устанавливать связь с базой данных
    // Атрибут $connect - связь для работы непосредственно с БД
    // Метод $initConnect - установить связь с БД, если не получилось, то 
    //      прекратить выполнение текущего скрипта (exit) 
    class DataBaseConnection {
        public static $connect;

        public static function initConnect() {
            // Подключить файл с конфигурацией бд
            require_once("db_settings.php");
            // Создать соединение с базой
            self::$connect = mysqli_connect($hostname, $username, $password, $dbName);
            // Проверить если не было соединения, то ошибка и досрочное завершение
            if (self::$connect == false) {
                echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
                echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            mysqli_set_charset(self::$connect, 'utf8');
        } 
    }

?>