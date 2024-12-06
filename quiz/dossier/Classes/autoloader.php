<?php 
    class autoloader {

        static function register(){
            spl_autoload_register(array(__CLASS__,"load"));
        }

        static function autoload($class){
            $file = str_replace("\\","/", $class);
            require 'Classes/' .$file.'.php';
        }
    
}


?>