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

    // Функция, которая сверяет название в таблице БД
    // возвращает true, если такое название в таблице уже есть
    // возвращает false если название новое в таблице
    // Входные данные : $NewValue - название новой значение в столбце таблицы
    // $tableName - название самой таблицы, $rowName - навание столбца
    function checkNewNameInDBTable($NewValue, $tableName, $rowName) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT " . $rowName . " FROM " . $tableName;
        $res = $connection->query($sql_query);
        for ($i = 0; $i < $res->num_rows; $i++) {
            $res->data_seek($i);
            if ($res->fetch_assoc()[$rowName] === $NewValue) 
                return true;
        }
        return false;
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

    // Ф-ия для добавление простого однотипного запроса в БД
    // Возвращает true, если успешно выполнен запрос
    // Иначе false
    function addNewDataInBD($tableName, $rowName , $value) {
        $sql_query = "INSERT INTO `". $tableName . "` (`" . $rowName . "`) VALUES ('" . $value . "')";
        $connection = setConnectionToDB();
        if ($connection->query($sql_query) === true)
            return true;
        else 
            return false;
    }

    // Отловить добавление новой категории в БД
    if(isset($_POST["CategoryName"]) === true) {
        if (checkNewNameInDBTable($_POST["CategoryName"], "category", "name") === false) {
            if (addNewDataInBD("category", "name" ,$_POST["CategoryName"]) === true)
                echo "Новая категория успешно добавлена в БД.";
            else
                echo "Проблема запроса на сервере, повторите попытку.";
        }
        else 
            echo "Данное название в БД уже имеется.";
        return;
    }

    // Отловить добавлпние новой подкатегории в БД
    if(isset($_POST["SubCategoryName"]) === true && isset($_POST["CategoryNameforSub"]) === true) {
        if(checkNewNameInDBTable($_POST["SubCategoryName"], "subcategory", "name") === false) {
            $connection = setConnectionToDB();

            // Получить идентификатор категории
            $sql_query = "SELECT id_category FROM `category` WHERE name = '" . $_POST["CategoryNameforSub"] . "'";
            $id_category = $connection->query($sql_query)->fetch_assoc()["id_category"];
            
            // Добавить новую подкатегорию в таблицу
            $sql_query = "INSERT INTO `subcategory` (`name`, `id_category`) VALUES ('" 
                . $_POST["SubCategoryName"] . "', " . $id_category . ")";
            // Запрос выполнен успешно и подкатегорию добавлена в таблицу БД
            if ($connection->query($sql_query) === true)
                echo "Новая подкатегория успешно добавлена в БД.";
            else
                echo "Проблема запроса на сервере, повторите попытку.";
        }
        else
            echo "Данное название в БД уже имеется.";
        return;
    }

    // Отловить добавление нового цвета в БД
    if(isset($_POST["ColorName"]) === true) {
        if(checkNewNameInDBTable($_POST["ColorName"], "color", "name") === false) {
            if (addNewDataInBD("color", "name", $_POST["ColorName"]) === true)
                echo "Новый цвет успешно добавлен в БД";
            else
                echo "Проблема отправки запроса на сервер, повторите попытку.";
        }
        else
            echo "Данное название в БД уже имеется.";
    }

    // Отловить добавление нового цвета в БД
    if(isset($_POST["SizeName"]) === true) {
        if(checkNewNameInDBTable($_POST["SizeName"], "size", "name") === false) {
            if (addNewDataInBD("size", "name", $_POST["SizeName"]) === true)
                echo "Новый размер успешно добавлен в БД";
            else
                echo "Проблема отправки запроса на сервер, повторите попытку.";
        }
        else
           echo  "Данное название в БД уже имеется.";
    }

    // Отловить добавление нового товара в БД
    if(isset($_POST["AddProductDescribeRu"]) === true && isset($_POST["AddProductDescribeEng"]) === true && 
        isset($_POST["AddProductMaterialRu"]) === true && isset($_POST["AddProductMaterialEng"]) === true && 
        isset($_POST["AddProductPriceRu"]) === true && isset($_POST["AddProductPriceEng"]) === true && 
        isset($_POST["AddProductCount"]) === true) {

        $connection = setConnectionToDB();
        $sql_query = "INSERT INTO `product` (`description_ru`, `price_ru`, `quantity`, `is_hit`, " . 
        "`description_eng`, `material_ru`, `material_eng`, `price_eng`) VALUES ('" . $_POST["AddProductDescribeRu"] . 
            "', '" . $_POST["AddProductPriceRu"] . "', '" . $_POST["AddProductCount"] . "', " . 0 . 
            ", '" . $_POST["AddProductDescribeEng"] . "', '" . $_POST["AddProductMaterialRu"] . 
            "', '" . $_POST["AddProductMaterialEng"] . "', '" . $_POST["AddProductPriceEng"] . "')";
        echo($sql_query);

        if($connection->query($sql_query) === true)
            echo "Новый товар успешно добавлен.";
        else
            echo "Проблемы с добавлением товара, попробуйте еще раз.";
    }

    // Отловить добавление новой подкатегории к товару (установить связь М:М)
    if(isset($_POST["AddSubcategoryNameForProduct"]) === true && isset($_POST["AddSubcategoryIdProduct"]) === true) {
        $connection = setConnectionToDB();
        // Получить идентификатор подкатегории по названию
        $sql_query = "SELECT id_subcategory FROM `subcategory` WHERE name = '" . $_POST["AddSubcategoryNameForProduct"] . "'";
        $subcategory_id = $connection->query($sql_query)->fetch_assoc()["id_subcategory"];

        $sql_query = "INSERT INTO `product_subcategory`(`id_product`, `id_subcategory`) VALUES (" . 
        $_POST["AddSubcategoryIdProduct"] . ", " . $subcategory_id . ")";
        if ($connection->query($sql_query) === true)
            echo "Товар успешно закреплен к подкатегории.";
        else
            echo "Проблемы с добавлением товара, попробуйте еще раз.";
    }

    // Отловить добавление нового цвета к товару (установить связь М:М) 
    if(isset($_POST["AddColorNameForProduct"]) === true && isset($_POST["AddProductIdForColor"]) === true) {
        $connection = setConnectionToDB();
        // Получить идентификатор цвета по названию
        $sql_query = "SELECT id_color FROM color WHERE name = '" . $_POST["AddColorNameForProduct"] . "'";
        $color_id = $connection->query($sql_query)->fetch_assoc()["id_color"];

        $sql_query = "INSERT INTO `product_color`(`id_color`, `id_product`) VALUES (" .
        $color_id . ", " . $_POST["AddProductIdForColor"] . ")";
        if ($connection->query($sql_query) === true)
            echo "Цвет успешно закреплен за товаром.";
        else
            echo "Проблемы с добавлением товара, попробуйте еще раз.";
    }

    // Отловить добавление нового размера к товару (установить связь М:М)
    if(isset($_POST["AddSizeNameForProduct"]) === true && isset($_POST["AddProductIdForSize"]) === true) {
        $connection = setConnectionToDB();
        // Получить идентификатор размера по названию
        $sql_query = "SELECT id_size FROM size WHERE name = '" . $_POST["AddSizeNameForProduct"] . "'";
        $size_id = $connection->query($sql_query)->fetch_assoc()["id_size"];

        $sql_query = "INSERT INTO `product_size`(`id_size`, `id_product`) VALUES (" . 
        $size_id . ", " . $_POST["AddProductIdForSize"] . ")";
        if ($connection->query($sql_query) === true)
            echo "Размер успешно закреплен за товаром.";
        else
            echo "Проблемы с добавлением товара, попробуйте еще раз.";
    }

    // Отловить добавление нового баннера в БД
    // В конце редирект на страницу панели админисратора
    if(isset($_FILES["BannerPhoto"]) === true) {
        // $flag - для цикла, чтобы не выйти из него пока не будет сгенирированно уникальное имя
        $flag = false;
        // Переменная для хранения имени файла
        $fileName = "";
        while ($flag != true) {
            // сгенерировать новое название файла (уникальное)
            $fileName = getUniqNameFile($_FILES["BannerPhoto"]["name"]);
            $flag = nameInDir($fileName, "images/general_images");
        }
        // полный путь файла
        $nameDir = getcwd() . "/images/general_images/" . basename($fileName);
        var_dump($nameDir);
        var_dump($_FILES["BannerPhoto"]);
        if (move_uploaded_file($_FILES["BannerPhoto"]["tmp_name"], $nameDir) === false) {
            echo "<h3>Ошибка загрузки файла на сервер, повторите попытку!</h3>";
            exit;
        }

        // Записать данные в БД
        $connection = setConnectionToDB();
        $sql_query = "INSERT INTO `general_photo`(`name`) VALUES ('" . $fileName . "')";
        $connection->query($sql_query);

        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/workspace');
    }

?>