<?php
include_once 'lib/database/database.php';


class Profile
{
    private $conexion;

    public $id, $dni, $name, $surname, $nick, $pass, $addres, $zone, $email, $phone, $phone2, $privileges;
    public $idmas, $age, $gen, $esp, $owner;
    public $idcit, $dateasig, $hourasig, $colasig, $statecit;
    public $dnicol, $prod, $cant, $prec, $date, $rec;

    // -----Constructor de la Conexion-----//
    public function __construct()
    {
        $this->conexion = databaseConexion::conexion();
    }

    // ----------METODOS GLOBALES---------- //

    // -----Metodo para verificar si un string contiene numeros----- //
    public function verifyNumberString($string)
    {
        return preg_match('/\d/', $string) === 1 ? true : false;
    }

    // -----Metodo para verificar que un string sea un correo electronico----- //
    public function verifyEmailString($string)
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    // -----Metodo para verificar que entre los numeros haya letras----- //
    public function verifyLeterString($number)
    {
        return preg_match('/[a-zA-Z]/', $number) === 1 ? true : false;
    }

    // -----Metodo para verificar contraseña----- //
    public function verifyPasswordString($password)
    {
        $longmin = 8;
        $mayus = true;
        $minus = true;
        $number = true;

        // -----Verificar longitud minima----- //
        $longpass = (strlen($password) < $longmin) ? false : true;
        // -----Verificar mayuscula----- //
        $mayuspass = ($mayus && preg_match('/[A-Z]/', $password)) ? true : false;
        // -----Verificar minuscula----- //
        $minuspass = ($minus && preg_match('/[a-z]/', $password)) ? true : false;
        // Verificar numeros----- //
        $numberpass = ($number && preg_match('/[0-9]/', $password)) ? true : false;

        return ($longpass === true && $mayuspass === true && $minuspass === true && $numberpass === true) ? true : false;
    }

    // -----Metodo para verificar existencia en la base de datos ----- //
    public function existProfile($table, $param, $id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM $table WHERE $param = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $stmt->close();
        return $result;
    }


    // -----Metodo para seleccionar todos los datos de una tabla ----- //
    public function getAll($table)
    {
        $query = "SELECT * FROM $table";
        $result = $this->conexion->query($query);
        $producto = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }


    // -----Metodo para Seleccionar el un dato ----- //
    public function selectParam($param1, $tabla, $param2, $value)
    {
        $query = "SELECT $param1 FROM $tabla WHERE $param2 = ?";
        $stmt = $this->conexion->prepare($query);
        if (!$stmt) {
            throw new Exception("Error in preparing statement: " . $this->conexion->error);
        }
        $stmt->bind_param("s", $value);
        $stmt->execute();
        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        return $result;
    }


    // -----Metodo para Seleccionar el nombre e id de un usuario segun su id ----- //
    public function selectNameIDUser($value)
    {
        $query = "SELECT dniuser, nickuser FROM usuario WHERE dniuser = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $value);
        $stmt->execute();
        $stmt->bind_result($dniuser, $nameuser);
        $stmt->fetch();
        $stmt->close();
        $result = array(
            'dniuser' => $dniuser,
            'nickuser' => $nameuser
        );
        return $result;
    }

    // -----Metodo para eliminar Profiles----- //
    public function deleteUser($table, $param, $id)
    {
        $sql = "DELETE FROM $table WHERE $param = ?";
        try {
            if ($this->conexion->prepare($sql)->execute([$id])) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    // -----Metodo para Seleccionar el un dato - Return true ----- //
    public function selectParamBoolean($tabla, $param2, $value)
    {
        $query = "SELECT COUNT(*) FROM $tabla WHERE $param2 = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $value);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    // -----Metodo para seleccionar todos los datos de un usuario segun su nick----- //
    public function getAllUserNick($nick)
    {
        $query = "SELECT * FROM usuario WHERE nickuser  =  '" . $nick . "'";
        $result = $this->conexion->query($query);
        $producto = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }

    // -----Metodo para seleccionar todos los datos de un usuario segun su dni----- //
    public function getAllUser($id)
    {
        $query = "SELECT * FROM usuario WHERE dniuser =  '" . $id . "'";
        $result = $this->conexion->query($query);
        $producto = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }

    // -----Metodo para seleccionar todos los datos de una mascota----- //
    public function getAllPet($id)
    {
        $query = "SELECT * FROM mascota WHERE idmas =  '$id'";
        $result = $this->conexion->query($query);
        $producto = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }

    // -----Metodo para seleccionar todos los datos de una mascota----- //
    public function getAllReceta($id)
    {
        $query = "SELECT * FROM receta WHERE idrec =  '$id'";
        $result = $this->conexion->query($query);
        $producto = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }


    // -----Metodo para Seleccionar el nombre del Usuario----- //
    public function selectUser($nombreUsuario)
    {
        $query = "SELECT * FROM usuario WHERE nickuser ='" . $nombreUsuario . "'";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $administrador = $result->fetch_assoc();
        $stmt->close();
        return $administrador;
    }


    // ----------METODOS DEL PROVEEDOR---------- // 

    // -----Metodo para agregar un nuevo Proveedor----- //
    public function saveProveedor(Profile $data)
    {
        try {
            $sql = 'INSERT INTO proveedor(nomprov, dirprov, emaprov, telprov) VALUES (?, ?, ?, ?)';
            $stmt = $this->conexion->prepare($sql);
            if ($stmt->execute([$data->name, $data->addres, $data->email, $data->phone])) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // -----Metodo para actualizar informacion de Proveedor----- //
    public function updateProveedor(Profile $data)
    {
        $stmt = $this->conexion->prepare("UPDATE proveedor SET nomprov = ?, dirprov = ?, emaprov = ?, telprov = ? WHERE idprov = ?");

        // Vincular los valores de los atributos a las variables de enlace
        $stmt->bind_param("ssssi", $data->name, $data->addres, $data->email, $data->phone, $data->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // -----Metodo del para el buscador de proveedores de Profile----- //
    public function buscarProveedor($buscar)
    {
        $query = "SELECT * FROM proveedor WHERE idprov LIKE '%$buscar%'";
        $result = $this->conexion->query($query);
        $proveedores = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $proveedores[] = $row;
            }
        }
        return $proveedores;
    }
    // ----------METODOS DE USUARIO---------- //

    // ------Metodo para verificar si un usuario existe------ //
    public function userExist($param1, $param2, $table, $value)
    {
        try {
            $sql = "SELECT $param1 FROM $table WHERE $param2='" . $value . "'";
            $result = $this->conexion->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Obtener la fila del resultado como un array asociativo
                return $row[$param1]; // Devolver el valor del nombre de usuario si existe
            } else {
                return null; // Devolver null si el usuario no existe
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // -----Metodo para Obtener Privilegios del Usuario------ //
    public function getPrivileges()
    {
        $query = "SELECT privileges FROM usuario WHERE nickuser = ?";
        $stmt = mysqli_prepare($this->conexion, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['usuario']);
            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);
                return (int) $row["privileges"];
            } else {
                return false;
            }
            mysqli_stmt_close($stmt);
        } else {
            return false;
        }
    }


    // -----Metodo para guardar informacion de Usuario----- //
    public function saveUser(Profile $data)
    {
        try {
            $user = "INSERT INTO usuario(dniuser, nameuser, surnameuser, nickuser, passuser, emailuser, diruser, zoneuser, phoneuser, phonealtuser, privileges) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $opr = $this->conexion->prepare($user);
            if ($opr->execute(array($data->dni, $data->name, $data->surname, $data->nick, $data->pass, $data->email, $data->addres, $data->zone, $data->phone, $data->phone2, $data->privileges))) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $error) {
            echo "No se puede registrar el Usuario: " . $error->getMessage();
        }
    }

    // -----Metodo para actualizar informacion de Usuario----- //
    public function update(Profile $user)
    {

        $update = "UPDATE usuario SET dniuser = ?, nameuser = ?, surnameuser = ?, nickuser= ?, emailuser = ?, diruser = ?, zoneuser = ?, phoneuser = ?, phonealtuser = ? WHERE iduser = ? ";
        try {
            $stmt = $this->conexion->prepare($update);
            $stmt->bind_param(
                "sssssssssi",
                $user->dni,
                $user->name,
                $user->surname,
                $user->nick,
                $user->email,
                $user->addres,
                $user->zone,
                $user->phone,
                $user->phone2,
                $user->id
            );
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al actualizar datos: " . $e->getMessage();
        }
    }

    // -----Metodo para el buscador de clientes en Profile -----//
    public function buscarClientes($buscar)
    {
        $query = "SELECT * FROM usuario WHERE (privileges = " . Privilegios::User->get() . ") AND (dniuser LIKE '%$buscar%' OR nameuser LIKE '%$buscar%' OR surnameuser LIKE '%$buscar%' OR nickuser LIKE '%$buscar%')";
        $result = $this->conexion->query($query);
        $clientes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }
        return $clientes;
    }

    // -----Metodo para el buscador de empleados en Profile----- //
    public function buscarColaborador($buscar)
    {
        $query = "SELECT * FROM usuario WHERE (privileges = " . Privilegios::Recepcionist->get() . " OR privileges = " . Privilegios::Doctor->get() . " OR privileges = " . (Privilegios::Recepcionist->get() | Privilegios::Doctor->get()) . ") AND (dniuser LIKE '%$buscar%' OR nameuser LIKE '%$buscar%' OR surnameuser LIKE '%$buscar%' OR nickuser LIKE '%$buscar%')";
        $result = $this->conexion->query($query);
        $empleados = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
            }
        }

        return $empleados;
    }

    // ----------METODOS PARA MASCOTA---------- //

    // -----Metodo para Guardar una Mascota----- //
    public function saveMascota(Profile $data)
    {
        try {
            $insert = "INSERT INTO mascota(nommas, edadmas, genmas, espmas, idcli) VALUES(?,?,?,?,?)";
            $action = $this->conexion->prepare($insert);
            if ($action->execute(array($data->name, $data->age, $data->gen, $data->esp, $data->owner))) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al guardar mascota en la Base de Datos: " . $e->getMessage();
        }
    }

    // -----Metodo para actualizar informacion de mascota----- //
    public function updateMascota(Profile $data)
    {
        try {
            $stmt = $this->conexion->prepare("UPDATE mascota SET nommas = ?, edadmas = ?, genmas = ?, espmas = ? WHERE idmas = ?");
            if ($stmt->execute(array($data->name, $data->age, $data->gen, $data->esp, $data->id))) {
                return true;
                exit();
            } else {
                return false;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // -----Metodo del para el buscador de mascotas de Profile----- //
    public function buscarMascotas($buscar)
    {
        $query = "SELECT * FROM mascota WHERE idmas LIKE '%$buscar%'";
        $result = $this->conexion->query($query);
        $mascota = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mascota[] = $row;
            }
        }
        return $mascota;
    }

    // ---------METODOS DE CITA---------//

    // -----Metodo para seleccionar todas de las horas en citas----- // 
    public function getHours($fecha, $idcol)
    {
        $query = "SELECT hourcit FROM cita WHERE datecit = ? AND idcolcit = ?";
        $consulta = $this->conexion->prepare($query);
        $consulta->bind_param("ss", $fecha, $idcol);
        $consulta->execute();
        $consulta->bind_result($hourcit);

        $hours = array();

        while ($consulta->fetch()) {
            $hours[] = $hourcit;
        }

        $consulta->close();
        return $hours;
    }

    // -----Metodo para guardar asignar una cita----- // 
    public function updateAppointment(Profile $data)
    {
        try {
            $query = "UPDATE cita SET datecit = ?, hourcit = ?, idcolcit = ?, statecit = ? WHERE idcita = ?";
            $action = $this->conexion->prepare($query);
            if ($action->execute(array($data->dateasig, $data->hourasig, $data->colasig, $data->statecit, $data->idcit))) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al asignar la cita: " . $e->getMessage();
        }
    }


    // -----Metodo para el buscador citas en profile----- //
    public function buscarCita($buscar)
    {
        $query = "SELECT * FROM cita WHERE idcita LIKE";
        $result = $this->conexion->query($query);
        $cita = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cita[] = $row;
            }
        }
        return $cita;
    }


    // ---------METODOS DE RECETAR-------- //

    // -----Metodo para tomar los los productos segun su nombre----- //
    public function getValProduct($name)
    {
        try {
            $sql = "SELECT precvenprod FROM producto WHERE nomprod = '$name'";
            $result = $this->conexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["precvenprod"];
            } else {
                return "No se encontró el valor unitario";
            }
        } catch (Exception $th) {
            echo "Error al consultar producto: " . $th->getMessage();
        }

    }

    // -----Metodo para guardar una receta---- //
    public function saveReceta(Profile $data)
    {
        try {
            $a = $this->conexion->prepare("INSERT INTO receta(dnicolrec, dniuserrec, idmasrec, prodrec, cantprodrec, precrec, fecharec, indrec) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($a->execute(array($data->dnicol, $data->dni, $data->idmas, $data->prod, $data->cant, $data->prec, $data->date, $data->rec))) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al guardar receta: " . $e->getMessage();
        }
    }
}