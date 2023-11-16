<?php 
class Redirector {

    private $route = null;

    public function __construct ($r) {
        $this->route = $r;
        return $this;
    }

    public function success($message) {
        setNotify("success", $message);
        return $this;
    }

    public function error($message) {
        setNotify("error", $message);
        return $this;
    }

    public function send() {
        header("Location: " . $this->route);
        exit;
    }
}