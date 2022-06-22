<?php
    spl_autoload_register(function ($class_name) {
        if($class_name == "Connection"){
            if(file_exists("../../includes/Connection.class.php")){
                include_once "../../includes/Connection.class.php";
            }
            else{
                include_once "Connection.class.php";
            }
        }
    });

?>