<?php

    require_once "application/models/model_product.php";
    
    class Controller_Product extends Controller {
        private $routesArray;

        function __construct() {
            $this->view = new View();
            $this->model = new Model_Product();
            $this->routesArray = explode('/', $_SERVER['REQUEST_URI']);
            if (LanguageSelect::$lang === "RU")
                $this->routesArray = array_slice($this->routesArray, array_search("RU", $this->routesArray));
            else 
                $this->routesArray = array_slice($this->routesArray, array_search("ENG", $this->routesArray));
        }

        function action_index() {
            Route::ErrorPage404();
        }

        // Метод, который предоставляет пользователю представление (view) с перечнем товаров,
        // который относится к определенной категории
        // $pageNumber - какую страницу товара отображать
        // $CategoryName - название категории (подкатегории)
        // $MaxPage - максимальное кол-во страниц с товаром данной категории (подкатегории)
        function action_category($pageNumber, $CategoryName, $MaxPage) {
            $path = $this->getRoutePathName(true);
            $data = array(
                "Products" => $this->model->getArrayProductCategory($pageNumber, $CategoryName),
                "MaxPages" => (int)$MaxPage,
                "PathContent" => $path,
                "HrefPath" => $this->routesArray,
                "PageNumber" => (int)$pageNumber,
            ); 
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Метод, который предоставляет пользователю представление (view) с перечнем товаров,
        // который относится к определенной подкатегории
        function action_subcategory($pageNumber, $SubCategoryName, $MaxPage) {
            $path = $this->getRoutePathName(false);
            $data = array(
                "Products" => $this->model->getSubCategoryProductsForPage($pageNumber, $SubCategoryName),
                "MaxPages" => (int)$MaxPage,
                "PathContent" => $path,
                "HrefPath" => $this->routesArray,
                "PageNumber" => (int)$pageNumber,
            );
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Данный метод будет возвращать представление (view), если такого товара в подкатегории 
        // (или категории) нет 
        function action_noCountProduct() {
            $data = "WE__HAVEN'T__GOT__THIS__PRODUCT. SORRY!";
            $this->view->generate("noproduct_view.php", "template_view.php", $data);
        }

        // Метод чтобы получить путь к веб-странице (URL), чтобы отобразить на представлении.
        // Если язык русский, то перевести URL На русский
        // На вход подается флаг, чтобы знать, как надо усечь массив для категорий и подкатегорий
        // false - усечь для подкатегорий, true - для категорий
        // На выходе : массив в котором лежит путь к представлению начиная от слова "product"
        private function getRoutePathName($flag) {
            $productIndex = array_search("product", $this->routesArray);
            if ($flag === true)
                $engRoute = array_slice($this->routesArray, $productIndex + 1, 1);
            else
                $engRoute = array_slice($this->routesArray, $productIndex + 1, 2);
            if (LanguageSelect::$lang === "RU") {
                for ($i = 0; $i < count($engRoute); $i++)
                    $engRoute[$i] = LanguageSelect::$SubCateLang[$engRoute[$i]];
            }
            return $engRoute;
        }
    }

?>