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

            // Если был введен в маршруте контроллер, то 
            // Запомнить его
            if (empty($routes[1]) == false)
                $controllerName = $routes[1];
            
            // Если был введен метод для контроллера в маршруте, то
            // Запомнить его 
            if (empty($routes[2]) == false)
                $actionName = $routes[2];

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
            header('Location:'.$host.'404');
        }
    }

?>