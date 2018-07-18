<?php

    class Controller_Product extends Controller {

        function __construct() {
            $this->view = new View();
        }

        // По умолчанию, если пользователь перешел просто на url /product/
        function action_index() {
            $this->action_swimwear();
        }

        // Отобразить все плавательные принадлежности
        function action_swimwear() {
            $data = "ALL SWIMWEAR";
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Отобразить все нижнее белье
        function action_underwear() {
            $data = "ALL UNDERWEAR";
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Отобразить все принты
        function action_prints() {
            $data = "ALL PRINTS";
            $this->view->generate("product_view.php", "template_view.php", $data);
        }

        // Отобразить конкретную выбранную подкатегорию
        function action_SubCategory($nameCategory) {
            $data = "ALL " . $nameCategory;
            $this->view->generate("product_view.php", "template_view.php", $data);
        }
    } 

?>