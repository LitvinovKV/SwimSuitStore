<?php

    class Controller_ProductCard extends Controller {

        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $data = "hmmmm";
            $this->view->generate("productcard_view.php", "template_view.php", $data);
        }
    }

?>