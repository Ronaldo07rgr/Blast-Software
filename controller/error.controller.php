<?php
class errorController{

public function Inicio(){
    $style = "<link rel='stylesheet' href='assets/css/style-error404.css'>"; 
    require_once "view/head.php"; 
    require_once "view/header.php"; 
    require_once "view/error404/error-404.php"; 
    require_once "view/footer.php"; 
}

}