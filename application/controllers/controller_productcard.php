<?php

    require_once "application/models/model_productcard.php";

    class Controller_ProductCard extends Controller {

        function __construct() {
            $this->view = new View();
            $this->model = new Model_Productcard();
        }

        function action_index() {
            Route::ErrorPage404();
        }

        function action_getProduct($id_product) {
            $data = $this->model->getProductInformation($id_product);
            $this->view->generate("productcard_view.php", "template_view.php", $data);
        }
    }

?>