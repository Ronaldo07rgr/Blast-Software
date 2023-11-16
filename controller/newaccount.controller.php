<?php

require_once "model/newAccount.php";
include "lib/privileges/privilegios.php";
class newAccountController
{

    private $object;

    public function __construct()
    {
        $this->object = new newAccount();
    }

    public function Inicio()
    {
        $style = "<link rel='stylesheet' href='assets/css/style-new-account.css'>";
        require_once "view/head.php";
        require_once "view/new-account/new-account.php";
    }

    public function GuardarUser()
    {

        if (empty($_POST['ctNombre'] . " " . $_POST['ctApellido']) || empty($_POST['ctEmail']) || empty($_POST['ctNick']) || empty($_POST['ctPass']) || empty($_POST['ctAddres']) || empty($_POST['selTipoUbicacion']) || empty($_POST['ctTel'])) {
            setcookie("notify", serialize(["status" => "error", "message" => "Complete todos los campos con (*)"]), time() + 5, "/");
            header("Location: ?b=newaccount&s=Inicio");
        } else {
            if (isset($_POST['conditions']) && $_POST['conditions'] == "true") {
                $nombre = $_POST['ctNombre'] . " " .  $_POST['ctApellido'];
                if ($this->object->verifyNumberString($nombre)) {
                    setcookie("notify", serialize(["status" => "error", "message" => "El nombre no puede llevar valores numericos"]), time() + 5, "/");
                    header('Location: ?b=newaccount&s=Inicio');
                } else {
                    if ($this->object->verifyLeterString($_POST['ctNumId'])) {
                        redirect("?b=newaccount&s=Inicio")->error("El numero de identificacion no puede llevar letras")->send();
                    } else {
                        $param1 = "numid";
                        $param2 = "numid";
                        $table = "usuario";
                        if ($this->object->userExist($param1, $param2, $table, $_POST['ctNumId'])) {
                            redirect("?b=newaccount&s=Inicio")->error("Ya existe una cuenta con este numero de identificacion")->send();
                        } else {
                            if (!$this->object->verifyEmailString($_POST['ctEmail']) && !$this->object->verifyEmailString($_POST['ctEmailC'])) {
                                redirect("?b=newaccount&s=Inicio")->error("El formato de las direcciones email no son validos")->send();
                            } else {
                                if ($_POST['ctEmail'] <> $_POST['ctEmailC']) {
                                    redirect("?b=newaccount&s=Inicio")->error("Las direcciones email no coinciden")->send();
                                } else {
                                    $param1 = "idcli";
                                    $param2 = "usercli";
                                    $table = "cliente";
                                    if ($this->object->userExist($param1, $param2, $table, $_POST['ctNick'])) {
                                        redirect("?b=newaccount&s=Inicio")->error("El Nickname ya se encuentra registrado")->send();
                                    } else {
                                        if ($this->object->verifyPasswordString($_POST['ctPass'])) {
                                            if ($this->object->verifyLeterString($_POST['ctTel']) && $this->object->verifyLeterString($_POST['ctTel2'])) {
                                                redirect("?b=newaccount&s=Inicio")->error("Los numeros de telefono no pueden tener letras")->send();
                                            } else {
                                                $m = new newAccount();
                                                $m->name = $_POST['ctNombre'];
                                                $m->sname = $_POST['ctApellido'];
                                                $m->id = trim($_POST['ctNumId']);
                                                $m->email = trim($_POST['ctEmail']);
                                                $m->uname = trim($_POST['ctNick']);
                                                $m->pass = md5(trim($_POST['ctPass']));
                                                $m->dir = trim($_POST['ctAddres']);
                                                $m->zone = $_POST['selTipoUbicacion'];
                                                $m->phone = trim($_POST['ctTel']);
                                                $m->phonealt = trim($_POST['ctTel2']);
                                                $m->privileges = Privilegios::User->get();

                                                if ($this->object->saveUser($m)) {
                                                    redirect("?b=login")->success("Cuenta creada con exito, inicia sesión")->send();
                                                } else {
                                                    redirect("?b=newaccount&s=Inicio")->error("Error al crear la cuenta, intentelo nuevamente.")->send();
                                                }
                                            }
                                        } else {
                                            redirect("?b=newaccount&s=Inicio")->error("La contraseña no cumple con los requisitos minimos de seguridad")->send();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                setcookie("notify", serialize(["status" => "error", "message" => "Acepte los Terminos y condiciones"]), time() + 5, "/");
                header("Location: ?b=newaccount&s=Inicio");
            }
        }
    }
}