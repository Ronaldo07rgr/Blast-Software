<?php 

include_once 'lib/database/database.php';
include_once 'lib/privileges/privilegios.php';

class bookAppointment{

    private $consulta; 

    public $id, $dni, $nameuser, $addresuser, $phone, $email, $namepet, $esp, $gen, $motive, $datesol, $dateasig, $hour,$service, $idcol, $state; 
    public function __construct(){
        try{
            $this -> consulta = databaseConexion::conexion();
        }catch(Exception $e){
            echo "Error de Conexion ". $e -> getMessage(); 
        }
    }

    // ----------METODOS GLOBALES---------- //

    // -----Metodo para verificar si un string contiene numeros----- //
    public function verifyNumberString($string){
        return preg_match('/\d/', $string) === 1 ? true : false; 
    }

    // -----Metodo para verificar que un string sea un correo electronico----- //
    public function verifyEmailString($string){
        return filter_var($string, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    // -----Metodo para verificar que entre los numero haya letras----- //
    public function verifyLeterString($number){
        return preg_match('/[a-zA-Z]/', $number) === 1 ? true : false; 
    }

    // -----Metodo para saber si un usuario existe----- //
    public function userExist($id){
        try{
            $privilegeValue = Privilegios::User->get();
            $sql = "SELECT iduser FROM usuario WHERE dniuser=? AND privileges=?";
            $stmt = $this->consulta->prepare($sql);
            $stmt->bind_param("ss", $id, $privilegeValue);
            $stmt->execute();
            $stmt->bind_result($value);
            $stmt->fetch();
            $stmt->close();
            return $value;

        }catch(Exception $e){
            echo "Error: ". $e->getMessage(); 
        }
    }

    // -----Metodo para verificar existencia en la base de datos ----- //
    public function existMascota($name, $esp, $id)
    {
        $stmt = $this->consulta->prepare("SELECT * FROM mascota WHERE nommas=? AND espmas=? AND idcli=?");
        $stmt->bind_param("ssi", $name, $esp, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row !== null;
    }

    public function saveCita(bookAppointment $data){
        try{
            $sql = "INSERT INTO cita(dniusercit, nameusercit, addresusercit, phoneusercit, emailusercit, namemascit, espmascit, genmascit, motcit, servicecit, datesolcit, statecit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"; 
            $action = $this->consulta->prepare($sql); 
            if($action->execute(array($data->dni, $data->nameuser, $data->addresuser, $data->phone, $data->email, $data->namepet, $data->esp, $data->gen, $data->motive, $data->service,$data->datesol, $data->state))){
                return true; 
            }else{
                return false; 
            }
        }catch(Exception $e){
            echo "Error al regitrar servicio: ". $e->getMessage(); 
        }
    } 
}



?>