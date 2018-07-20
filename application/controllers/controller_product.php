<?php

    class Controller_Product extends Controller {

        function __construct() {
            $this->view = new View();
        }

        // По умолчанию, если пользователь перешел просто на url /product/
        function action_index() {
            $this->action_swimwear();
        }

        // Метод, который предоставляет пользователю представление (view) с перечнем товаров,
        // который относится к определенной категории
        function action_category($pageNumber, $CategoryName) {
            $data = "ALL_" . $CategoryName . "_#" . $pageNumber;
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Метод, который предоставляет пользователю представление (view) с перечнем товаров,
        // который относится к определенной подкатегории
        function action_subcategory($pageNumber, $SubCategoryName) {
            $data = "ALL_" . $SubCategoryName . "_#" . $pageNumber;
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Данный метод будет возвращать представление (view), если такого товара в подкатегории 
        // (или категории) нет 
        function action_noCountProduct() {
            $data = "WE__HAVEN'T__GOT__THIS__PRODUCT. SORRY!";
            $this->view->generate("product_view.php", "template_view.php", $data);
        }
    } 

?>