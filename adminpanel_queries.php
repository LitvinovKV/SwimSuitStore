<?php

    // Функция для подключения к БД
    // Это делается каждый раз и отдельно, т.к. данный скрипт
    // не имеет ничего общего с основным сайтом
    function setConnectionToDB() {
        // Подключить файл с конфигурацией бд
        include "application/db_settings.php";
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

    // Ф-ия которая сверяет введенные данные на странице логирования панели администратора по БД
    // возвращает true если такой admin есть и редирект на страницу с панелью
    // если возвращает false То ничего не происходит
    function checkAdmin($login, $password) {
        $connection = setConnectionToDB();
        $resLogins = $connection->query("SELECT login FROM admin");
        $resPasswords = $connection->query("SELECT p_word FROM admin");
        for($i = 0; $i < $resLogins->num_rows; $i++) {
            $resLogins->data_seek($i);
            $resPasswords->data_seek($i);
            $DBLogin = $resLogins->fetch_assoc()["login"];
            $DBPassword = $resPasswords->fetch_assoc()["p_word"];
            if ($DBLogin === $login && $DBPassword === $password)
                return true;
        }
        return false;
    }

    // Отловить нажатие кнопки на вход в панель администратора
    if (isset($_POST['LogIn']) === true) {
        //Если true && true (были заполнены все text input)
        if ( (empty($_POST['UserLog']) == false) && (empty($_POST['UserPass']) == false) ) {
            $login = md5($_POST['UserLog']);
            $password = md5($_POST['UserPass']);
            // // Если такие данные пользователя существуют в базе
            if (checkAdmin($login, $password) === true) {
                $_SESSION['UserLogin'] = $login;
                header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/workspace');
            }
        }
        else 
            return;
    }

    // Отловить нажатие кнопки на выход из панели администратора
    if(isset($_POST['ExitList']) === true) {
        unset($_SESSION["UserLogin"]);
        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/');
    }

?>