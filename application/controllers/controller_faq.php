<?php

    class Controller_Faq extends Controller {
        
        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $this->action_payment();
        }

        function action_payment() {
            $this->view->generate("payment_view.php", "template_view.php");
        }

        function action_delivery() {
            $this->view->generate("delivery_view.php", "template_view.php");
        }

        function action_guarantee() {
            $this->view->generate("guarantee_view.php", "template_view.php");
        }

        function action_chart() {
            $this->view->generate("chart_view.php", "template_view.php");
        }

        function action_tailoring() {
            $this->view->generate("tailoring_view.php", "template_view.php");
        }
    }

?>