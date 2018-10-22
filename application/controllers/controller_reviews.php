<?php

    class Controller_Reviews extends Controller {
        
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Reviews();
        }

        function action_index() {
            $data = $this->model->getData();
            $this->view->generate("reviews_view.php", "template_view.php", $data);
        }
    }

?>