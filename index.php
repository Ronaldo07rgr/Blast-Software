<?php
include_once 'lib/notify/helper.php';
include_once 'lib/database/database.php';

session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario'])) {
    // Mostrar el nombre de usuario en lugar de "Iniciar Sesión"
    $nombreUsuario = $_SESSION['usuario'];
}

$controller = "index";

if (!isset($_REQUEST['b'])) {
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'controller';
    $controller = new $controller;
    $controller->Inicio();
} else {
    $controller = strtolower($_REQUEST['b']);
    $action = isset($_REQUEST['s']) ? $_REQUEST['s'] : 'Inicio';
    $params = isset($_REQUEST['p']) ? $_REQUEST['p'] : '';
    $value = isset($_REQUEST['v']) ? $_REQUEST['v'] : '';
    require_once "controller/$controller.controller.php";
    $controller = ucwords($_REQUEST['b']) . 'controller';
    $controller = new $controller();
    call_user_func(array($controller, $action), $params, $value);   
}
require_once "view/notify.php";

?>