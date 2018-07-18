<?php

    class Route {
        static function start() {
            // Контроллер и действия по умолчанию
            // Если пользователь перешел на главную страницу - index
            // то вызовется класс Main метод index
            $controllerName = "Main";
            $actionName = "index";

            // Разбить строку маршрута (URL) по разделителю '/'
            $routes = explode('/', $_SERVER['REQUEST_URI']);
            $index = 0;
            // Подсчитать кол-во каждого элемента в массиве 
            $countElements = array_count_values($routes);
            
            // Два условия, для отслеживания различных ситуаций со смены языка во время эксплуатации сайта
            // 1. Если пользователь попытался сменить язык в первый раз не на главной странице (../.../../RU)
            // 2. Если пользователь попытался сменить язык во второй и более раз (../RU/../RU)
            // то редирект на начальную страницу
            if (in_array("RU", $routes) && ((array_search("RU", $routes) != 1 ) || (array_count_values($routes)["RU"] > 1))) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/RU");
                return;
            }
            if (in_array("ENG", $routes) && ((array_search("ENG", $routes) != 1 ) ||  ($countElements["ENG"] > 1))) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/ENG");
                return;
            }

            // Если язык был изменен на Русский, то поменять вызвать статический метод
            // класса setRU() и поменять все на русский язык
            if ($routes[1] === "RU") {
                LanguageSelect::setRU();
                $index = 1; 
            }

            // Если язык был изменен на Английский, то поменять вызвать статический метод
            // класса setENG() и поменять все на английский язык
            if ($routes[1] === "ENG") {
                LanguageSelect::setENG();
                $index = 1;
            }

            // Если был введен в маршруте контроллер, то 
            // Запомнить его
            if (empty($routes[1 + $index]) == false)
                $controllerName = $routes[1 + $index];
            
            // Если был введен метод для контроллера в маршруте, то
            // Запомнить его 
            if (empty($routes[2 + $index]) == false)
                $actionName = $routes[2 + $index];

            // Добавить префиксы для корректной дальнейшей работы
            $model_name = "model_" . $controllerName;
            $controller_name = "controller_" . $controllerName;
            $action_name = "action_" . $actionName;

            // Подключить файл с классом модели
            // (Такого файла может и не быть)
            $model_file = strtolower($model_name) . ".php";
            $model_path = "application/models/" . $model_file;
            // Если такой файл модели существует то включить его
            if (file_exists($model_path) == true)
                include $model_path;
            
            // Подключить файл с классом контроллера
            // Стандартно вызовется класс контроллера Main, метод - index
            $controller_file = strtolower($controller_name) . ".php";
            $controller_path = "application/controllers/" . $controller_file;
            // Если такой файл контроллер существует, то подключить его
            // Иначе такого контроллера нет (такой страницы на сайте нет), то
            // вызвать ошибку 404
            if (file_exists($controller_path) == true)
                include $controller_path;
            else 
                Route::ErrorPage404();

            // Объявить и инициализировать контроллер
            $controller = new $controller_name;
            // Запомнить метод (действие) для контроллера
            $action = $action_name;
            // Если у контроллера есть такой метод, то вызвать его
            if (method_exists($controller, $action) == true)
                $controller->$action();
            // Если такого метода в контроллере нет, то редирект на 404
            else
                Route::ErrorPage404();
        }

        // Отправка HTTP-запроса 404
        static function ErrorPage404() {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            (LanguageSelect::$lang === "RU") ? header("Location:" . $host . "RU/404") : 
                header("Location:" . $host . "ENG/404");
            // header('Location:'.$host.'404');
        }
    }

?>