<?php

include_once "lib/database/database.php";

class restorePassword
{

    private $consulta;
    public function __construct()
    {
        try {
            $this->consulta = databaseConexion::conexion();
        } catch (Exception $e) {
            echo "Error de Conexion " . $e->getMessage();
        }
    }

    public function verifyUser($usuario)
    {
        $query = "(SELECT 'cliente' AS rol FROM usuario WHERE nickuser = '$usuario')";
        $resultado = mysqli_query($this->consulta, $query);

        if (mysqli_num_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyEmail($email)
    {
        $query = "(SELECT 'cliente' AS rol FROM usuario WHERE emailuser = '$email')";
        $resultado = mysqli_query($this->consulta, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
