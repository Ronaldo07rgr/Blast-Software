<?php

include_once 'model/contactus.php'; 

require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';
require 'lib/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class contactUsController{
    private $object; 
    public function __construct(){
        $this->object = new contactUs(); 
    }

    public function Inicio(){
        $style = "<link rel='stylesheet' href='assets/css/style-contact-us.css'>"; 
        require_once "view/head.php"; 
        require_once "view/header.php"; 
        require_once "view/contact-us/contact-us.php"; 
        require_once "view/footer.php"; 
    }

    public function sendEmail(){
        if(empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['message'])){
            redirect("?b=contactus&s=Inicio")->error("Complete todos los campos y vuelva enviar el formulario")->send();
        } else{
            $email = $_POST['email'];
            $user = $_POST['name']." ".$_POST['surname']; 
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $asunto = "ANIMAL WORLD - PQRS"; 
                        $mensaje = "Hola,
                        
                        El usuario ".$user.", correo electronico: ".$email."; realizo el envio del siguiente mensaje: 

                        ".$_POST['message']."
                        
                        Gracias!"; 
                        $cabecera = "From: animal20230world@gmail.com\r\n" .
                        "Reply-To: animal2023world@gmail.com\r\n";
                        $mail = new PHPMailer(true); 
                        $mail -> isSMTP(); 
                        $mail -> Host = "smtp.gmail.com"; 
                        $mail ->Port = 587; 

                        $mail -> SMTPAuth = true; 
                        $mail -> Username = "animal2023world@gmail.com"; 
                        $mail ->Password = "wlplwfqgpkopkney"; 

                        $mail -> setFrom("animal2023world@gmail.com", "Animal World - 2023");
                        $mail -> addAddress("jcuellarmenza@gmail.com", "Usuario"); 
                        
                        $mail -> Subject = $asunto; 
                        $mail -> Body = $mensaje; 

                        if($mail->send()){
                            redirect("?b=contactus")->success("Mensaje enviado con exito")->send();
                        }else {
                            redirect("?b=contactus")->error("Error al enviar el mensaje")->send();
                        }
            } else{
                redirect("?b=contactus")->error("Direccion de correo electronico invalida")->send();
            }
        }
    }      

}
