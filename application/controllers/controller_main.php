<?php

    class Controller_Main extends Controller {
        
        // Конструткор, где инициилизируется атрибут view
        function __construct() {
            $this->view = new View();
            $this->model = new Model_Main();
        }
        
        // Переопределение родительского метода
        function action_index() {
            $data = $this->model->getData();
            $this->view->generate("main_view.php", "template_view.php", $data);
        }
    }

?>