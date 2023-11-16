<?php

class databaseConexion {
    public static function conexion(){
            //Variables que contiene host, nombre de la base de datos usuario y contraseña
            $host= "localhost"; 
            $db = "veterinaria";
            $u = "root"; 
            $p = ""; 
            $con = mysqli_connect($host, $u, $p, $db); 
            return $con;  
    }
}

?>