<?php
 
include_once "lib/notify/redirector.php";

function redirect($r) {
    $redirector = new Redirector($r);
    return $redirector;
}

function setNotify($status, $message) {
    setcookie("notify", serialize(["status" => $status, "message" => $message]), time() + 5, "/");
}