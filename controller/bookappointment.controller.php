<?php

include_once 'model/bookappointment.php'; 

class bookAppointmentController{

    private $object; 

    public function __construct(){
        $this->object = new bookAppointment(); 
    }

    public function Inicio(){
        $style = "<link rel='stylesheet' href='assets/css/style-book-appointment.css'>"; 
        require_once "view/head.php"; 
        require_once "view/header.php"; 
        require_once "view/book-appointment/book-appointment.php"; 
        require_once "view/footer.php"; 
    }

    public function appointmentRequest(){
        if(empty($_POST['numid']) || empty($_POST['name']) || empty($_POST['addres']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['namepet']) || empty($_POST['genpet']) || empty($_POST['esppet']) || empty($_POST['motive']) || empty($_POST['service'])){
            redirect("?b=bookappointment&p=showForm")->error("Rellene nuevamente el formulario y asegurese de completar todos los campos")->send();
        }else{
            if($this->object->verifyLeterString($_POST['numid'])){
                redirect("?b=bookappointment&p=showForm")->error("El numero de identificacion no debe llevar letras")->send();
            }else{ 
                if($this->object->verifyNumberString($_POST['name']) || $this->object->verifyNumberString($_POST['namepet'])){
                    redirect("?b=bookappointment&p=showForm")->error("El nombre del usuario y/o de la mascota no deben llevar numeros")->send();
                }else{
                    if($this->object->verifyLeterString($_POST['phone'])){
                        redirect("?b=bookappointment&p=showForm")->error("El numero de telefono no debe llevar letras")->send();
                    }else{
                        if(!$this->object->verifyEmailString($_POST['email'])){
                            redirect("?b=bookappointment&p=showForm")->error("Formato de correo electronico invalido!")->send();
                        }else{
                            $iduser = $this->object->userExist($_POST['numid']); 
                            if($iduser){
                                if($this->object->existMascota($_POST['namepet'], $_POST['esppet'], $iduser)){
                                    $c = new bookAppointment(); 
                                    $c->dni = $_POST['numid']; 
                                    $c->nameuser = $_POST['name']; 
                                    $c->addresuser = $_POST['addres']; 
                                    $c->phone = $_POST['phone']; 
                                    $c->email = $_POST['email']; 
                                    $c->namepet = $_POST['namepet']; 
                                    $c->gen = $_POST['genpet']; 
                                    $c->esp = $_POST['esppet']; 
                                    $c->motive = $_POST['motive']; 
                                    $c->service = $_POST['service']; 
                                    $c->datesol =  date("Y/m/d"); 
                                    $c->state = "No asignado"; 

                                    if($this->object->saveCita($c)){
                                        redirect("?b=bookappointment")->success("La <strong>".$_POST['service']."</strong> para <strong>".$_POST['namepet']."</strong> ha sido registrada con exito")->send();
                                    }else{
                                        redirect("?b=bookappointment")->error("Error al registrar ".$_POST['service']." para ".$_POST['namepet'])->send();
                                    }
                                }else{
                                    redirect("?b=bookappointment&p=showForm")->error("La mascota no se encuentra resgitrada o se encuentra registrada con otro usuario!")->send();
                                }
                            }else{
                                redirect("?b=bookappointment&p=showForm")->error("El usuario no se encuentra registrado!")->send();
                            }
                        }
                    }
                }
            }
        }
    }
}
