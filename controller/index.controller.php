<?php

include_once "model/Index.php"; 

class indexController{
    private $object; 

    public function __construct(){
        $this -> object = new Index(); 
    }

    public function Inicio(){
        $style = "<link rel='stylesheet' href='assets/css/style-index.css'>"; 
        require_once "view/head.php"; 
        require_once "view/header.php"; 
        require_once "view/index/index.php"; 
        require_once "view/footer.php";
    }

    
}

?>