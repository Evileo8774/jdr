<?php
    function mainController($action) {
        $actions = array();
        $actions["default"] = "home.php";

        if(array_key_exists($action, $actions)) {
            return $actions[$action];
        } else {
            return $actions["default"];
        }
    }

?>