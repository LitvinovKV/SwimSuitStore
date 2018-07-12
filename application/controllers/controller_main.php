<?php

    class Controller_Main extends Controller {
        
        // Конструткор, где инициилизируется атрибут view
        function __construct() {
            $this->view = new View();
        }
        
        // Переопределение родительского метода
        function action_index() {
            $this->view->generate("main_view.php", "template_view.php");
        }
    }

?>