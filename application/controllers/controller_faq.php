<?php

    class Controller_Faq extends Controller {
        
        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $this->action_payment();
        }

        function action_payment() {
            $data = "THIS IS PAYMENT PAGE!";
            $this->view->generate("payment_view.php", "template_view.php", $data);
        }

        function action_delivery() {
            $data = "THIS IS DELIVERY PAGE!";
            $this->view->generate("delivery_view.php", "template_view.php", $data);
        }

        function action_guarantee() {
            $data = "THIS IS GUARANTEE PAGE!";
            $this->view->generate("guarantee_view.php", "template_view.php", $data);
        }

        function action_chart() {
            $data = "THIS IS SIZE CHART PAGE!";
            $this->view->generate("chart_view.php", "template_view.php", $data);
        }
    }

?>