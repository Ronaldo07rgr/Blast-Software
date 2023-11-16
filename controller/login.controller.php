<?php

include_once "model/login.php";

class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login();
    }

    public function Inicio()
    {
        $style = "<link rel='stylesheet' href='assets/css/style-login.css'>";
        require_once "view/head.php";
        require_once "view/login/login.php";
    }

    public function validarUser()
    {
        $usuario = $_POST['ctUser'];
        $passEncrypt = md5($_POST['ctPassword']);

        if (empty($usuario) || empty($passEncrypt)) {
            header('Location: ?b=login');
        } else {
            $usuario_valido = $this->loginModel->validarUsuario($usuario);
            $password_valido = $this->loginModel->validarPassword($passEncrypt, $usuario);
            if ($usuario_valido) {
                if ($password_valido) {
                    session_destroy(); 
                    session_start();
                    
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['ultimaActividad'] = time();
                    $privilegios = $this->loginModel->obtenerPrivilegios();
                    $_SESSION['privilegios'] = $privilegios->privilegios;
                    setNotify("success", "Ha iniciado sesión correctamente");
                    header("Location: ?b=profile&s=Inicio"); 

                    exit();
                } else {
                    redirect("?b=login&s=Inicio&p=admin")->error("Usuario y/o contraseña incorrectos, por favor verifique")->send();
                }
            } else {
                redirect("?b=login&s=Inicio&p=admin")->error("Usuario y/o contraseña incorrectos, por favor verifique")->send();
            }
        }
    }
}
