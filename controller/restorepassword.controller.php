<?php 

include_once "model/restorepassword.php"; 

require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';
require 'lib/PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class restorePasswordController{

    private $object; 

    public function __construct(){
        $this -> object = new restorePassword();
    }

    public function Inicio(){
        $style = "<link rel='stylesheet' href='assets/css/style-olive-password.css'>"; 
        require_once "view/head.php";
        require_once "view/header.php";
        require_once "view/restore-password/restore-password.php";
        require_once "view/footer.php";
    }

    public function sendEmail(){

        if(empty($_POST['ctUser']) && empty($_POST['ctEmail'])){
            redirect("?b=restorepassword")->error("Complete todos los campos y vuelva a enviar el formulario")->send();
        } else{
            $user = $_POST['ctUser'];
            $email = $_POST['ctEmail'];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if($this->object->verifyUser($user)){
                    if($this->object->verifyEmail($email)){
                        $asunto = "ANIMAL WORLD - RECUPERACION DE CONTRASEÑA"; 
                        $mensaje = "Hola,
                        
                        Dirijase a la sigueinte direccion de enlace para recuperar su contraseña http://localhost:8080/BLAST-SOFTWARE/MVC/index.php?b=index
                        
                        recuerda que no debes compartir esta informacion con nadie. 
                        
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
                        $mail -> addAddress($email, $user); 
                        
                        $mail -> Subject = $asunto; 
                        $mail -> Body = $mensaje; 

                        if($mail->send()){
                            setNotify("success", "Contraseña recuperada con exito!");
                            header("location: ?b=login"); 
                        }else {
                            redirect("?b=restorepassword")->error("Error al recuperar contraseña")->send();    
                        }
                        
                    }else{
                        redirect("?b=restorepassword")->error("El correo electronico no esta vinculado a ningun usuario")->send();
                    }
                }else{
                    redirect("?b=restorepassword")->error("El usuario no existe")->send();
                }
            } else{
                redirect("?b=restorepassword")->error("Direccion de correo electronico invalida")->send();
            }
        }
    }       

}
