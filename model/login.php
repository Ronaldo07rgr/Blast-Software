<?php

class Login
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = databaseConexion::conexion();
    }

    public function validarUsuario($usuario)
    {
        $query = "(SELECT 'usuario' AS rol FROM usuario WHERE nickuser = '$usuario')";

        $resultado = mysqli_query($this->conexion, $query);

        if (mysqli_num_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarPassword($pass, $user){
        $query = "(SELECT 'usuario' AS rol FROM usuario WHERE passuser = '$pass' AND nickuser='$user')";

        $resultado = mysqli_query($this->conexion, $query);

        if (mysqli_num_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerPrivilegios() {
        $query = "SELECT privileges FROM usuario WHERE nickuser = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['usuario']);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_object($resultado);
        } else {
            return false;
        }
    }
    

    public function obtenerRolColaborador($usuario)
    {
        $query = "SELECT rolcol FROM colaborador WHERE nomcol = '$usuario'";
        $resultado = mysqli_query($this->conexion, $query);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return $fila['rolcol'];
        } else {
            return false;
        }
    }
}