<?php

    class View {

        // Метод для формирования представления
        // contentView - представление отображающий контент страниц
        // templateView - шаблон для всех страниц (Header, Footer)
        // data - массив, содержащий элементы контента страницы. Может быть пустым
        function generate($contentView, $tempalteView, $data = null) {
            include "application/views/" . $tempalteView;
        }
        
    }

?>