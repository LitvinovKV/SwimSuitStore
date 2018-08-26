<?php

    class Controller_Basket extends Controller {

        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $this->view->generate("basket_view.php", "template_view.php");
        }
    }

?>