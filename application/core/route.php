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

            // Вызвать метод на проверку сменя зыка в URL
            $changeLanguegeVal = self::changeLanguage($routes);
            if ($changeLanguegeVal === 1)
                $index = 1;
            else if ($changeLanguegeVal === -1) 
                return;

            // Если пользователь перешел на URL /patterns, то вызывать метод для предосталвения нужного представления (view)
            // пользователю
            if (in_array("patterns", $routes) === true) {
                self::CheckCategoryPages("patterns", ProductsValues::$printsCount, $routes);
                return;
            }

            // Если пользователь перешел на URL /swimwear, то вызывать метод для предосталвения нужного представления (view)
            // пользователю
            if (in_array("swimwear", $routes) === true) {
                self::CheckCategoryPages("swimwear", ProductsValues::$SwimwearCount, $routes);
                return;
            }

            // Если пользователь перешел на URL /underwear, то вызывать метод для предосталвения нужного представления (view)
            // пользователю
            if (in_array("underwear", $routes) === true) {
                self::CheckCategoryPages("underwear", ProductsValues::$UnderwearCount, $routes);
                return;
            }

            // Если пользователь перешел на URL /productcard, то вызвать метод для предоставления нужной вьюхи пользователю 
            if (in_array("productcard", $routes) === true) {
                $flag = self::CheckProductCardPages($routes);
                if ($flag === true) return;
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
        }

        // Метод, который проверят была ли произведена пользователем смена языка или нет
        // На вход URL по которому перешел пользователь
        // На выходе одно значение: -1, если пользователь сменил язык во 
        //  время пользования сайтом (не на главной странице) или попытка сменить язык еще раз
        //  1, если язык был сменен на главной странице
        //  0, если пользователь не пытался сменить язык
        private function changeLanguage($routes) {
            // Подсчитать кол-во каждого элемента в массиве 
            $countElements = array_count_values($routes);
            
            // Два условия, для отслеживания различных ситуаций со смены языка во время эксплуатации сайта
            // 1. Если пользователь попытался сменить язык в первый раз не на главной странице (../.../../RU)
            // 2. Если пользователь попытался сменить язык во второй и более раз (../RU/../RU)
            // то редирект на начальную страницу
            if (in_array("RU", $routes) && ((array_search("RU", $routes) != 1 ) || ($countElements["RU"] > 1))) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/RU");
                return -1;
            }
            if (in_array("ENG", $routes) && ((array_search("ENG", $routes) != 1 ) ||  ($countElements["ENG"] > 1))) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/ENG");
                return -1;
            }

            // Если язык был изменен на Русский, то вызвать статический метод
            // класса setRU() и поменять все на русский язык
            if (LanguageSelect::$lang === "ENG" && $routes[1] === "RU") {
                LanguageSelect::setRU();
                return 1;
            }

            // Если язык был изменен на Английский, то вызвать статический метод
            // класса setENG() и поменять все на английский язык
            if (LanguageSelect::$lang === "RU" && $routes[1] === "ENG") {
                LanguageSelect::setENG();
                return 1;
            }

            // Если в начале URL стоит язык, то контрллер и действие смещаются на 1
            // хост/RU(ENG)/controller/action
            if ($routes[1] === "RU" || $routes[1] === "RU")
                return 1;

            return 0;
        }

        // Метод который, создает контроллер для отображения каталога товаров по подкатегориям
        // На вход получает название подкатегории
        private function callSubcategoryController($SubCategoryName) {
            // Если был передан пустой под URL swimwear/ , то вызвать метод checkSwimwearPage()
            // для предоставления представления (view) страницы с определенным товаром
            if ($SubCategoryName >= 0 && $SubCategoryName <= ProductsValues::$SwimwearCount)
                self::checkSwimwearPage($SubCategoryName);
            // Если была предпринята попытка перейти на страницу несуществующей подкатегории
            if ( (in_array($SubCategoryName, LanguageSelect::$templateData['SwimWearCatName']['Hrefs']) === false) &&
                (in_array($SubCategoryName, LanguageSelect::$templateData['UnderWearCatName']['Hrefs']) === false) )
                Route::ErrorPage404();
            include "application/controllers/controller_product.php";
            $controllerSubCategory = new Controller_Product();
            $controllerSubCategory->action_SubCategory($SubCategoryName);
        }

        // Метод который разбирвает URL на части для категория и подкатегорий и вызывает контроллер с действием
        // чтобы отобразить пользователю перечень необходимого товара из категории или подкатегории
        // .../swimwear/swimsuit/1 или .../underwear/bra или .../patterns
        // На вход подется: $CategoryName - название категории или подкатегории
        // $ProductCount - кол-во страниц товара, которое содержит данная категория или подкатегория
        // $routes - сам маршрут страницы (URL) 
        private function CheckCategoryPages($CategoryName, $ProductCount, $routes) {
            // Найти позицию под URL /категория в страке браузера с конца
            $posCategory = count($routes) - array_search($CategoryName, $routes) - 1;
            // Подготовить переменные для определенной категории
            require_once "application/controllers/controller_product.php";
            // Если название является категорией, то вызвать метод контроллера для категорий
            if (in_array($CategoryName, LanguageSelect::$CategoryArray) === true)
                $actionName = "action_category" ;
            // Иначе вызвать метод контроллера для подкатегорий
            else if (in_array($CategoryName, LanguageSelect::$SubCategoryArray) === true)
                $actionName = "action_subcategory";
            // Если под URL /КАТЕГОРИЯ последний и в данной категории есть товар,
            // то вывести первую страницу с товарами принтами
            if ($posCategory === 0 && $ProductCount > 0) {
                $controller = new Controller_Product();
                $controller->$actionName(1, $CategoryName, $ProductCount);
            }
            // Если под URL /КАТЕГОРИЯ последний и в данной категории нет товара,
            // то вывести соболезнующую картинку (надпись) что товара в данной категории (подкатегории) нет
            else if (($posCategory === 0) && ($ProductCount === (float)0)) {
                $controller = new Controller_Product();
                $controller->action_noCountProduct();    
            }
            // Если под URL /КАТЕГОРИЯ не последний, то перед ним может стоять под URL
            // который указывает какую страницу из перечня товара показывать или стоять подкатегория 
            // товара для данной категории
            else if ($posCategory >= 1) {
                // Вычислить позицию элемента, в маршруте URL, который стоит после категории
                $posSubCategory = count($routes) - ($posCategory - 1) - 1;
                // Если получилось так, что под URL пустой /КАТЕГОРИЯ/ и в категории (подкатегории) есть товар, 
                // то вывести первую страницу 
                if (strlen($routes[$posSubCategory]) === 0 && $ProductCount > 0) {
                    $controller = new Controller_Product();
                    $controller->$actionName(1, $CategoryName, $ProductCount);
                }
                // Если получилось тк, что под URL пустой /КАТЕГОРИЯ/ и в категории (подкатегории) нет товара,
                // то вывести картинку (надпись), что товара в данной категории (подкатегории) нет
                else if (strlen($routes[$posSubCategory]) === 0 && $ProductCount === (float)0) {
                    $controller = new Controller_Product();
                    $controller->action_noCountProduct(); 
                }
                // Если под URL удовлетворяет условию кол-ва страниц у возможной категории
                // то предоставить пользователю эту страницу /КАТЕГОРИЯ/1
                else if ( ($routes[$posSubCategory] <= $ProductCount) &&
                    ($routes[$posSubCategory] > 0) ) {
                    $controller = new Controller_Product();
                    $controller->$actionName($routes[$posSubCategory], $CategoryName, $ProductCount);
                }
                // Если после категории (swimwear, underwear) идет подкатегория (/swimwear/swimsuit и др.), список
                // которых представлен в массиве $templateData статического класса LanguageSelect, то вызвать эту же функцию, 
                // только вместо категории будет определенный подкатегория
                else if ( $CategoryName === "swimwear" &&
                        in_array(($routes[$posSubCategory]), LanguageSelect::$templateData['SwimWearCatName']['Hrefs']) === true) { 
                    self::CheckCategoryPages($routes[$posSubCategory],
                        ProductsValues::callCountSubCategory(LanguageSelect::$SubCateLang[$routes[$posSubCategory]], true), $routes);
                }
                else if ( $CategoryName === "underwear" &&
                        in_array(($routes[$posSubCategory]), LanguageSelect::$templateData['UnderWearCatName']['Hrefs']) === true ) {
                    self::CheckCategoryPages($routes[$posSubCategory],
                        ProductsValues::callCountSubCategory(LanguageSelect::$SubCateLang[$routes[$posSubCategory]], true), $routes);
                }
                // Иначе редирект на 404 (если страница не удовлетворяет кол-ву товара в категории)
                else Route::ErrorPage404();
            }
            // Иначе если категория не последняя и не пред последняя в URL строке, то редирект на 404
            else Route::ErrorPage404();
        }

        // Метод который проверяет адресную строку если в ней упоминалось ключевое слово "productcard"
        // Разбивает урл на подурлы и сверяет с подходящими условиями.
        // На входе : $routes - адресная строка разбитая на массив
        // На выходе : флаг, который указывает на то как пректарил свое действие метод
        // если flag === false, то при возвращении из метода вызовется метод контроллера productcard_controller->action_index()
        // который в свою очередь вызовет ошибку 404, ибо адресная строка не подходит для дальнейшей работы
        // если flaf === true, то это значит, что в метода инициализировался объект класса и вызволся метод, который возвращает
        // представление контента с продуктом по идентификатору 
        private function CheckProductCardPages($routes) {
            $posProductcardURL = array_search("productcard", $routes);
            // Если подурл /productcard последний, тогда выйти из метода 
            // и вызвать начальное действие action_index
            if ($posProductcardURL + 1 === count($routes)) 
                return false;
            // Если подурл /productcard/ не последний, но после него нчиего нет, то
            // вызвать начальное действие action_index
            else if ($posProductcardURL + 1 != count($routes) && strlen($routes[$posProductcardURL + 1]) === 0)
                return false;
            // Если существует такой подурл, который идет после идентификатора товара /productcard/id/
            // и если он не пустой, тогда вызвать начальное действие action_index
            else if (count($routes) > $posProductcardURL + 2) {
                if (strlen($routes[$posProductcardURL + 2]) != 0) return false;
            }
            
            // Если подукрл идентфиикатора товара соответсвует товару в БД, то объявить и инициализировать контроллер
            // который возвращает представление с этим товаром по идентификатору
            if (in_array($routes[$posProductcardURL + 1], ProductsValues::$AllProdcutsId) === true) {
                require_once "application/controllers/controller_productcard.php";
                $controller = new Controller_ProductCard();
                $controller->action_getProduct($routes[$posProductcardURL + 1]);
                return true;
            }
            else
                return false;
        }
    }

?>