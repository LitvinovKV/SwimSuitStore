<?php

    class Controller_Admin extends Controller {
        
        function __construct() {
            $this->view = new View();
        }

        function action_index() {
            $this->action_login();
        }

        function action_login() {
            include "application/views/admin_login.php";
        }

        function action_workspace() {
            include "application/views/admin_workspace.php";
        }
    }

?>