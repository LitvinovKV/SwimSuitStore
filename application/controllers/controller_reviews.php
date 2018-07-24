<?php

    class Controller_Reviews extends Controller {
        
        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $data = "THIS IS REVIEWS PAGE!";
            $this->view->generate("reviews_view.php", "template_view.php", $data);
        }
    }

?>