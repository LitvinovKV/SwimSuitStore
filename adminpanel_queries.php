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

    // Ф-ия которая проверяет, находится ли заданный файл в заданной дирректории
    // На входе: $fileName - имя файла которое надо найти, $path - каталог, в котором
    // будет производиться поиск
    // На выходе: true - если такого файла нет, false - если существует 
    function nameInDir($fileName, $path) {
        // Отбросить . и .. в дирректории и оставить только названия файлов
        $ImagesFiles = array_slice(scandir($path), 2);
        for ($i = 0; $i < count($ImagesFiles); $i++)
            // Если такой файл с таким названием уже существует в дирриктории
            if ($ImagesFiles[$i] === $fileName) return false;
        var_dump($ImagesFiles);
        return true;
    }

    // Создать новое имя файлу, чтобы вероятность совпадения по названию с другими файлами
    // в дирректории была крайне мала
    // Генерировать псевдослучайное число при помощи микросикунд и 
    // изменения начального числа генератора псевдослучайных чисел
    function getUniqNameFile($fileName) {
        // Разбить название файла на название и тип
        list($name, $type ) = explode('.', $fileName);
        list($usec, $sec) = explode(' ', microtime());
        $value = $sec + $usec * 1000000;
        srand($value);
        $newFileName = $name . rand() . "." . $type;
        return $newFileName;
    }

    // Отловить нажатие кнопки на вход в панель администратора
    if (isset($_POST["LogIn"]) === true) {
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
    if(isset($_POST["ExitAdminPanel"]) === true) {
        unset($_SESSION["UserLogin"]);
        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/');
    }


    // Отловить добавление новой фотографии к изображению
    // В конце редирект на страницу панели администратора
    if(isset($_FILES["ProductPhoto"]) === true && isset($_POST["ProductId"]) === true) {

        // $flag - для цикла, чтобы не выйти из него пока не будет сгенирированно уникальное имя
        $flag = false;
        // Переменная для хранения имени файла
        $fileName = "";
        while ($flag != true) {
            // сгенерировать новое название файла (уникальное)
            $fileName = getUniqNameFile($_FILES["ProductPhoto"]["name"]);
            $flag = nameInDir($fileName, "images/products_images");
        }
        // полный путь файла
        $nameDir = getcwd() . "/images/products_images/" . basename($fileName);

        if (move_uploaded_file($_FILES["ProductPhoto"]["tmp_name"], $nameDir) === false) {
            echo "<h3>Ошибка загрузки файла на сервер, повторите попытку!</h3>";
            exit;
        }
       
        // Записать данные в БД
        $connection = setConnectionToDB();
        $sql_query = "INSERT INTO `photo` (`name`, `id_product`, `is_general`) VALUES ('" . 
            $fileName . "', " . $_POST["ProductId"] . ", " . 0 . ")";
        $connection->query($sql_query);

        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/workspace');
    }

?>