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
    // if(isset($_POST["ColorName"]) === true) {
    //     if(checkNewNameInDBTable($_POST["ColorName"], "color", "name") === false) {
    //         if (addNewDataInBD("color", "name", $_POST["ColorName"]) === true)
    //             echo "Новый цвет успешно добавлен в БД";
    //         else
    //             echo "Проблема отправки запроса на сервер, повторите попытку.";
    //     }
    //     else
    //         echo "Данное название в БД уже имеется.";
    // }

    if(isset($_FILES["ColorPhoto"]) === true && isset($_POST["AddNewColorNameRu"]) === true && isset($_POST["AddNewColorNameEng"]) === true) {
         // $flag - для цикла, чтобы не выйти из него пока не будет сгенирированно уникальное имя
         $flag = false;
         // Переменная для хранения имени файла
         $fileName = "";
         while ($flag != true) {
             // сгенерировать новое название файла (уникальное)
             $fileName = getUniqNameFile($_FILES["ColorPhoto"]["name"]);
             $flag = nameInDir($fileName, "images/s_networks");
         }
         // полный путь файла
         $nameDir = getcwd() . "/images/s_networks/" . basename($fileName);
        //  var_dump($nameDir);
        //  var_dump($_FILES["ColorPhoto"]);
         if (move_uploaded_file($_FILES["ColorPhoto"]["tmp_name"], $nameDir) === false) {
             echo "<h3>Ошибка загрузки файла на сервер, повторите попытку!</h3>";
             exit;
         }

        $nameRu = $_POST["AddNewColorNameRu"];
        $nameEng = $_POST["AddNewColorNameEng"];
        $sql_query = "INSERT INTO `color`(`name`, `name_eng`, `path_name`) VALUES ('" . $nameRu . "', '" . $nameEng . "', '" .
        $fileName . "')";
        $connection = setConnectionToDB();
        $connection->query($sql_query);
        header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/workspace');
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
        // var_dump($nameDir);
        // var_dump($_FILES["BannerPhoto"]);
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

    // Отловить редактирование названия подкатегории
    if(isset($_POST["RedactSubcategoryName"]) === true && isset($_POST["OldestSubcategoryName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `subcategory` SET `name` = '" . $_POST["RedactSubcategoryName"] . 
            "' WHERE name = '" . $_POST["OldestSubcategoryName"] . "'";
        if ($connection->query($sql_query) === true) {
            echo "Название подкатегории успешно изименено.";
        }
        else
            echo "Проблемы с изменением названия подкатегории, попробуйте снова.";
    }

    // Отловить редактирование названия категории
    if(isset($_POST["RedactCategoryName"]) === true && isset($_POST["OldCategoryName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `category` SET `name` = '" . $_POST["RedactCategoryName"] . "' " . 
            "WHERE name = '" . $_POST["OldCategoryName"] . "'";
        if ($connection->query($sql_query) === true) {
            echo "Название категории успешно изменено.";
        }
        else
            echo "Проблемы с имзенением названия категории, попробуйте снова.";
    }

    // Отловить редактирование название цвета
    if(isset($_POST["RedactColorName"]) === true && isset($_POST["OldColorName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `color` SET `name` = '" . $_POST["RedactColorName"] .
            "' WHERE `name` = '" . $_POST["OldColorName"] . "'";
        if ($connection->query($sql_query) === true)
            echo "Название цвета успешно изменено.";
        else
            echo "Проблемы с имзенением названия цвета, попробуйте снова.";
    }

    // Отловить редактирование название размера
    if(isset($_POST["RedcactSizeName"]) === true && isset($_POST["OldSizeName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `size` SET `name` = '" . $_POST["RedcactSizeName"] . 
            "' WHERE `name` = '" . $_POST["OldSizeName"] ."'";
        if ($connection->query($sql_query) === true)
            echo "Название размера успешно изменено.";
        else
            echo "Проблемы с имзенением размера, попробуйте снова.";
    }

    // Отловить запрос на получение подробной инфорамции по товару из БД
    if(isset($_POST["InformationAboutProductById"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT * FROM `product` WHERE id_product = " . $_POST["InformationAboutProductById"];
        $result = $connection->query($sql_query)->fetch_assoc();
        echo $result["id_product"] . "||" . $result["description_ru"] . "||" . 
            $result["description_eng"] . "||" . $result["material_ru"] . "||" . 
            $result["material_eng"] . "||" . $result["price_ru"] . "||" . 
            $result["price_eng"] . "||" . $result["quantity"];
    }

    // Отловить запрос на изменение информации об товаре в БД
    if(isset($_POST["ChangedInformationProductId"]) === true &&
        isset($_POST["ChangedInformationProductDescRu"]) === true &&
        isset($_POST["ChangedInformationProductDescEng"]) === true &&
        isset($_POST["ChangedInformationProductMaterialDescRu"]) === true &&  
        isset($_POST["ChangedInformationProductMaterialDescEng"]) === true && 
        isset($_POST["ChangedInformationProductPriceRu"]) === true &&
        isset($_POST["ChangedInformationProductPriceEng"]) === true &&
        isset($_POST["ChangedInformationProductQuantity"]) === true) {
        
        $id_product = $_POST["ChangedInformationProductId"];
        $DescRu = $_POST["ChangedInformationProductDescRu"];
        $DescEng = $_POST["ChangedInformationProductDescEng"];
        $DescMaterialRu = $_POST["ChangedInformationProductMaterialDescRu"];
        $DescMaterialEng = $_POST["ChangedInformationProductMaterialDescEng"];
        $PriceRu = $_POST["ChangedInformationProductPriceRu"];
        $PriceEng = $_POST["ChangedInformationProductPriceEng"];
        $Quantity = $_POST["ChangedInformationProductQuantity"];

        $connection = setConnectionToDB();
        $sql_query = <<<DBQUERY
UPDATE `product` SET `description_ru`=  '$DescRu', `price_ru`= $PriceRu, `quantity`= $Quantity, `description_eng`= '$DescEng', `material_ru`= '$DescMaterialRu', `material_eng`= '$DescMaterialEng', `price_eng`= $PriceEng WHERE `id_product` = $id_product
DBQUERY;

        if ($connection->query($sql_query) === true)
            echo "Данные о продукте успешно изменены.";
        else
            echo "Проблемы с имзенением информации о товаре, попробуйте снова.";
    }

    // Отловить запрос на добавление нового хита
    if(isset($_POST["AddNewHitProduct"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `product` SET `is_hit` = " . 1 . " WHERE `id_product` = " . $_POST["AddNewHitProduct"];
        if($connection->query($sql_query) === true)
            echo "Продукт теперь является хитом.";
        else
            echo "Проблемы с изменением продукта на хит, попробуйте снова.";
    }

    if(isset($_POST["DeleteCategoryName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "DELETE FROM `category` WHERE name = '" . $_POST["DeleteCategoryName"] . "'";
        if($connection->query($sql_query) === true)
            echo "Выбранная категория успешно удалена.";
        else
            echo "Проблемы с удалением категории, попробуйте снова.";
    }


    // Отловить запрос на удаление цвета. Его также надо удалить у каждого товара
    if(isset($_POST["DeleteColorName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT `id_color` FROM `color` WHERE name = '" . $_POST["DeleteColorName"] . "'";
        $id_color = $connection->query($sql_query)->fetch_assoc()["id_color"];

        // Удалить выбранный цвет у каждого товара, который его имеет
        $sql_query = "DELETE FROM `product_color` WHERE `id_color` = " . $id_color;
        if ($connection->query($sql_query) === false) {
            echo "Проблемы с удалением цвета, попробуйте снова.";
            return;
        }

        // Удалить непосредственно сам цвет из БД
        $sql_query = "DELETE FROM `color` WHERE `id_color` = " . $id_color;
        if ($connection->query($sql_query) === true) 
            echo "Выбранный цвет успешно удален.";
        else
            echo "Проблемы с удалением цвета, попробуйте снова";
        return;
    }

    // Отправляет запрос на удаление размера. Его также надо удалить у каждого товара
    if(isset($_POST["DeleteSizeName"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT `id_size` FROM `size` WHERE name = '" . $_POST["DeleteSizeName"] . "'";
        $id_size = $connection->query($sql_query)->fetch_assoc()["id_size"];

        // Удалить выбранный размер у каждого товара, который его имеет
        $sql_query = "DELETE FROM `product_size` WHERE `id_size` = " . $id_size;
        if ($connection->query($sql_query) === false) {
            echo "Проблемы с удалением размера, попробуйте снова.";
            return;
        }

        // Удалить непосредственно сам размер из БД
        $sql_query = "DELETE FROM `size` WHERE `id_size` = " . $id_size;
        if ($connection->query($sql_query) === true)
            echo "Выбранный размер успешно удален.";
        else
            echo "Проблемы с удалением размера, попробуйте снова.";
        return;
    }

    // Отлавливает запрос на удаление выбранного цвета у определенного товара.
    if(isset($_POST["DeletePC_ColorName"]) === true && isset($_POST["DeletePC_ProductId"]) === true) {
        $connection = setConnectionToDB();
        
        // Получить идентификатор цвета по названию
        $sql_query = "SELECT `id_color` FROM `color` WHERE `name` = '" . $_POST["DeletePC_ColorName"] . "'";
        $id_color = $connection->query($sql_query)->fetch_assoc()["id_color"];
        
        // Удалить цвет у выбранного продукта по идентификаторам
        $sql_query = "DELETE FROM `product_color` WHERE `id_product` = " . $_POST["DeletePC_ProductId"] . 
        " AND `id_color` = " . $id_color;
        if ($connection->query($sql_query) === true)
            echo "Выбранный цвет успешно удален у выбранного продукта.";
        else
            echo "Проблемы с удалением цвета у продукта, попробуйте снова.";
        return;
    }

    // Отловить запрос на удаление выбранного размера у выбранного товара
    if(isset($_POST["DeletePS_SizeName"]) === true && isset($_POST["DeletePS_ProductId"]) === true) {
        $connection = setConnectionToDB();

        // Получить идентификатор размера по названию
        $sql_query = "SELECT `id_size` FROM `size` WHERE `name` = '" . $_POST["DeletePS_SizeName"] . "'";
        $id_size = $connection->query($sql_query)->fetch_assoc()["id_size"];

        // Удалить выбранный размер у выбранного товара
        $sql_query = "DELETE FROM `product_size` WHERE `id_product` = " . $_POST["DeletePS_ProductId"] . 
        " AND `id_size` = " . $id_size;
        if ($connection->query($sql_query) === true)
            echo "Выбранный размер успешно удален у выбранного товара.";
        else
            echo "Проблемы с удалением размера у продукта, попробуйсте снова.";
        return;
    }

    // Отправляет запрос на удаленние выбранного продукта по идентификатору
    if(isset($_POST["DeleteCurrentProductId"]) === true) {
        $connection = setConnectionToDB();
        $id_product = $_POST["DeleteCurrentProductId"];

        $sql_query = "DELETE FROM `product_color` WHERE `id_product` = " . $id_product;
        $connection->query($sql_query);
        $sql_query = "DELETE FROM `product_size` WHERE `id_product` = " . $id_product;
        $connection->query($sql_query);

        // Удалить фотографии из системы
        $sql_query = "SELECT `name` FROM `photo` WHERE `id_product` = " . $id_product;
        $res = $connection->query($sql_query);
        for($i = 0; $i < $res->num_rows; $i++) {
            $res->data_seek($i);
            $name = $res->fetch_assoc()["name"];
            unlink(getcwd() . "/images/products_images/" . $name);
        }
        $sql_query = "DELETE FROM `photo` WHERE `id_product` = " . $id_product;
        $connection->query($sql_query);
        
        $sql_query = "DELETE FROM `product_subcategory` WHERE `id_product` = " . $id_product;
        $connection->query($sql_query);
        $sql_query = "DELETE FROM `product` WHERE `id_product` =" . $id_product;

        echo "Товар и вся информация касающаяся него была удалена.";
        return;
    }

    // Отлавливает запрос и возвращает фотографии продукта по идентификатору
    if(isset($_POST["ProductPhotosById"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT `name` FROM `photo` WHERE `id_product` = " . $_POST["ProductPhotosById"];
        $res = $connection->query($sql_query);
        $result = "";
        for($i = 0; $i < $res->num_rows; $i++) {
            $res->data_seek($i);
            $namePhoto = $res->fetch_assoc()["name"];
            if ($i + 1 === $res->num_rows)
                $result .= $namePhoto;
            else
                $result .= $namePhoto . "//";

        }
        echo $result;
    }

    // Отловить запрос на удаление выбранных фотографий продукта
    if(isset($_POST["DeleteProductPictures"]) === true) {
        $connection = setConnectionToDB();
        $PhotoNames = explode(',', $_POST["DeleteProductPictures"]);
        for($i = 0; $i < count($PhotoNames); $i++) {
            $sql_query = "DELETE FROM `photo` WHERE `name` = '" . $PhotoNames[$i] . "'";
            $connection->query($sql_query);
            unlink(getcwd() . "/images/products_images/" . $PhotoNames[$i]);
        }
        echo "Выбранные фотографии успешно удалены!";
    }

    // Отловить запрос на выборку заказа из БД
    if(isset($_POST["GetOrderParametrs"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT * FROM `orders` WHERE `id_order` = " . $_POST["GetOrderParametrs"];
        $result = $connection->query($sql_query)->fetch_assoc();
        echo $result["id_order"] . "//" . $result["full_name"] . "//" . $result["adress"] . "//" .
            $result["phone_number"] . "//" . $result["post_index"] . "//" . $result["description"];
    }

    // Отловить запрос на редактирование заказа в БД
    if(isset($_POST["ChangeOrderId"]) === true && isset($_POST["ChangeOrderFIO"]) === true && 
    isset($_POST["ChangeOrderAdress"]) === true && isset($_POST["ChangePhoneNumberOrder"]) === true && 
    isset($_POST["ChangePostIndexOrder"]) === true && isset($_POST["ChangeDescriptionOrder"]) === true) {

        $connection = setConnectionToDB();
        $id_order = $_POST["ChangeOrderId"];
        $FullName = $_POST["ChangeOrderFIO"];
        $adress = $_POST["ChangeOrderAdress"];
        $PhoneNumber = $_POST["ChangePhoneNumberOrder"];
        $PostIndex = $_POST["ChangePostIndexOrder"];
        $description = $_POST["ChangeDescriptionOrder"];

        $sql_query = <<<ORDERQUERY
UPDATE `orders` SET `full_name`='$FullName',`adress`='$adress',`phone_number`='$PhoneNumber',`post_index`='$PostIndex',`description`='$description' WHERE `id_order` = $id_order
ORDERQUERY;
        if($connection->query($sql_query) === true)
            echo "Заказ успешно изменен.";
        else
            echo "Ошибка при изменении заказа, повторите попытку ";
        return;
    }

    // Отловить запрос на удаление заказа из БД
    if(isset($_POST["DeleteCurrentOrder"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "DELETE FROM `orders` WHERE `id_order` = " . $_POST["DeleteCurrentOrder"];
        if ($connection->query($sql_query) === true)
            echo "Заказ успешно удален из базы.";
        else
            echo "Ошибка при удалении заказа, повторите снова.";
        return;
    }


    if(isset($_POST["IdColorForReturnInformation"]) === true) {
        $connection = setConnectionToDB();
        $sql_query = "SELECT * FROM `color` WHERE id_color = " . $_POST["IdColorForReturnInformation"];
        $res = $connection->query($sql_query);
        $res = $res->fetch_assoc();
        echo $res["id_color"] . "//" . $res["name"] . "//" . $res["name_eng"] . "//" . $res["path_name"];
    }

    if(isset($_FILES["RedactColorPhoto"]) === true && isset($_POST["ShowColorNameRu"]) === true && isset($_POST["ShowColorNameEng"]) === true) {
        $nameRu = $_POST["ShowColorNameRu"];
        $nameEng = $_POST["ShowColorNameEng"];
        
        $connection = setConnectionToDB();
        // Удалить старую фотографию из системы
        $sql_query = "SELECT `path_name` FROM `color` WHERE `id_color` = " . $_POST["ShowColorById"];
        $nameColorPath = $connection->query($sql_query)->fetch_assoc()["path_name"];
        unlink(getcwd() . "/images/s_networks/" . $nameColorPath);
         
        // $flag - для цикла, чтобы не выйти из него пока не будет сгенирированно уникальное имя
        $flag = false;
        // Переменная для хранения имени файла
        $fileName = "";
        while ($flag != true) {
            // сгенерировать новое название файла (уникальное)
            $fileName = getUniqNameFile($_FILES["RedactColorPhoto"]["name"]);
            $flag = nameInDir($fileName, "images/s_networks");
        }
        // полный путь файла
        $nameDir = getcwd() . "/images/s_networks/" . basename($fileName);
         if (move_uploaded_file($_FILES["RedactColorPhoto"]["tmp_name"], $nameDir) === false) {
            echo "<h3>Ошибка загрузки файла на сервер, повторите попытку!</h3>";
            exit;
        }
        
        // Записать данные в БД
        $connection = setConnectionToDB();
        $sql_query = "UPDATE `color` SET `name` = '" . $nameRu . "', `name_eng` = '" . $nameEng . "', `path_name` = '" . $fileName . "' WHERE `id_color` = " . $_POST["ShowColorById"];
        $connection->query($sql_query);
 
         header('location:  http://' . $_SERVER['HTTP_HOST'] . '/admin/workspace');
    }

    if(isset($_POST["DeleteHitProduct"]) === true) {
        $connection = setConnectionToDB();

        $sql_query = "UPDATE `product` SET `is_hit` = '0' WHERE `id_product` = " . $_POST["DeleteHitProduct"];
        if ($connection->query($sql_query) === true)
            echo "Выбранный товар теперь не является хитом.";
        else
            echo "Ошибка изменения хита в базе данных. Попробуйте снова.";
    }
?>