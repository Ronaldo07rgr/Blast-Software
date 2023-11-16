<?php
include_once "model/Profile.php";
include_once 'lib/privileges/privilegios.php';
require_once 'lib/fpdf/fpdf.php';

class ProfileController
{
    private $object;
    public function __construct()
    {
        $this->object = new Profile();
    }

    //-----Metodo para redireccionar segun el rol de inicio de sesión-----//
    public function Inicio()
    {
        $roles = [
            Privilegios::Recepcionist->get() => "Recepcionista",
            Privilegios::Doctor->get() => "Doctor"
        ];

        // -----Variables para obtener las listas a mostrar----- //
        $privilegios = $this->object->getPrivileges();
        $proveedores = $this->object->getAll("proveedor");
        $users = $this->object->getAll("usuario");
        $mascota = $this->object->getAll("mascota");
        $productos = $this->object->getAll("producto");
        $categorias = $this->object->getAll("categoria");
        $cita = $this->object->getAll("cita");
        $recetas = $this->object->getAll("receta");

        // -----Variables de Privilegios----- //
        $privUser = Privilegios::User->get();
        $privRecepcionist = Privilegios::Recepcionist->get();
        $privDoctor = Privilegios::Doctor->get();
        $privAdmin = Privilegios::Admin->get();

        // -----Variables de Session----- //
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);

        // -----Vistas Requeridas----- //
        $style = "<link rel='stylesheet' href='assets/css/style-profile.css'>";
        require_once "view/head.php";
        require_once "view/profile/profile.php";
        require_once "view/footerprofile.php";
    }

    public function errorPage()
    {
        $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-error404.css'";
        require_once "view/head.php";
        require_once "lib/error/error-404.php";
    }

    // -----METODOS DE REDIRECCION----- //

    // -----Metodo para redireccionar a vista de agregar Proveedor y Colaborador -----// check proveedor
    public function optionSaveRedirec()
    {
        $o = $_REQUEST['p'];
        switch ($o) {
            case 'proveedor':
                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php";
                require_once "view/profile/save/agregar-proveedor.php";
                break;
            case 'Colaborador':
                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php";
                require_once "view/profile/save/agregar-user.php";
                break;
            case 'Cliente':
                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php";
                require_once "view/profile/save/agregar-user.php";
                break;
            case 'mascota':
                $dueños = $this->object->getAll("usuario");
                $usuario = $_SESSION['usuario'];
                $user = $this->object->selectUser($usuario);
                $privilegios = $this->object->getPrivileges();

                ($privilegios == Privilegios::User->get()) ? $userdata = $this->object->getAllUserNick($usuario) : "";

                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php";
                require_once "view/profile/save/agregar-mascota.php";
                break;
            default:
                redirect("?b=profile&s=errorPage")->error("Pagina no encontrada")->send();
                break;
        }
    }

    // -----Metodo para redireccionar a vista de Editar Proveedor y Colaborador -----// check proveedor
    public function optionEditRedirec()
    {
        $o = $_REQUEST['p'];
        switch ($o) {
            case 'proveedor':
                if ($_GET['idprov']) {
                    $table = "proveedor";
                    $param = "idprov";
                    $idProveedor = $_GET['idprov'];
                    $proveedor = $this->object->existProfile($table, $param, $idProveedor);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/edit/editar-proveedor.php";
                }
                break;
            case 'Colaborador':
                if ($_REQUEST['iduser']) {
                    $table = "usuario";
                    $param = "dniuser";
                    $idUser = $_REQUEST['iduser'];
                    $colaborador = $this->object->existProfile($table, $param, $idUser);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/edit/editar-user.php";
                }
                break;
            case 'Cliente':
                if ($_REQUEST['iduser']) {
                    $table = "usuario";
                    $param = "dniuser";
                    $idUser = $_REQUEST['iduser'];
                    $colaborador = $this->object->existProfile($table, $param, $idUser);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/edit/editar-user.php";
                }
                break;
            case 'mascota':
                if ($_GET['idmas']) {
                    $table = "mascota";
                    $param = "idmas";
                    $idMascota = $_GET['idmas'];
                    $mascota = $this->object->existProfile($table, $param, $idMascota);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/edit/editar-mascota.php";
                }
                break;
            default:
                redirect("?b=profile&s=Inicio&p=admin")->error("Pagina no encontrada")->send();
                break;
        }
    }

    public function sheduleService()
    {
        if (empty($_POST['idcit']) || empty($_POST['dniuser']) || empty($_POST['dateasig']) || empty($_POST['selcol'])) {
            redirect("?b=profile&s=Inicio")->error("Complete todos los campos!")->send();
        } else {
            if ($this->object->verifyLeterString($_POST['idcit'])) {
                redirect("?b=profile&s=Inicio")->error("El id de la cita no debe llevar numeros!")->send();
            } else {
                if ($this->object->verifyLeterString($_POST['dniuser'])) {
                    redirect("?b=profile&s=Inicio")->error("El DNI del usuario no debe llevar numeros!")->send();
                } else {
                    $colaborador = $this->object->getAll("usuario");
                    $cliente = $this->object->existProfile("cita", "idcita", $_POST['idcit']);
                    $horas = $this->object->getHours($_POST['dateasig'], $_POST['selcol']);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/save/asignar-cita.php";
                }
            }
        }
    }


    // -----METODOS DE USUARIO ----- //

    //-----Metodo para actualizar datos de usuario-----//
    public function saveUser()
    {
        $rol = ($_REQUEST['p'] == "Colaborador") ? "Colaborador" : (($_REQUEST['p'] == "Cliente") ? "Cliente" : "");

        if (empty($_POST['numid']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['nick']) || empty($_POST['pass']) || empty($_POST['pass2']) || empty($_POST['addres']) || empty($_POST['phone']) || empty($_POST['zone']) || empty($_POST['rol'])) {
            redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("Complete todos los campos")->send();
        } else {
            if ($this->object->verifyLeterString($_POST['numid'])) {
                redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("El numero de Identificacion no puede llevar letras")->send();
            } else {
                if ($this->object->selectParam("dniuser", "usuario", "dniuser", $_POST['numid'])) {
                    redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("El numero de identificacion ya esta registrado con otro usuario")->send();
                } else {
                    if ($this->object->verifyNumberString($_POST['name']) || $this->object->verifyNumberString($_POST['surname'])) {
                        redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("Los nombres y apellidos deben ir sin numeros")->send();
                    } else {
                        if (!$this->object->verifyEmailString($_POST['email'])) {
                            redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("Formato de correo electronico invalido")->send();
                        } else {
                            if ($this->object->selectParam("nickuser", "usuario", "nickuser", $_POST['nick'])) {
                                redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("El nickname ingresado se encuentra en uso")->send();
                            } else {
                                if ($_POST['pass'] === $_POST['pass2']) {
                                    if (!$this->object->verifyPasswordString($_POST['pass'])) {
                                        redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("La contraseña no cumple con los estandares basicos de seguridad")->send();
                                    } else {
                                        if ($this->object->verifyLeterString($_POST['phone']) || $this->object->verifyLeterString($_POST['phone2'])) {
                                            redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("Los numeros de telefono pueden llevar letras")->send();
                                        } else {
                                            $c = new Profile();

                                            $c->dni = $_POST['numid'];
                                            $c->name = $_POST['name'];
                                            $c->surname = $_POST['surname'];
                                            $c->nick = $_POST['nick'];
                                            $c->pass = md5($_POST['pass']);
                                            $c->email = $_POST['email'];
                                            $c->addres = $_POST['addres'];
                                            $c->zone = $_POST['zone'];
                                            $c->phone = $_POST['phone'];
                                            $c->phone2 = $_POST['phone'];
                                            $c->privileges = ($_POST['rol'] == "recepcionista") ? Privilegios::Recepcionist->get() : (($_POST['rol'] == "veterinario") ? Privilegios::Doctor->get() : (($_POST['rol'] == "cliente") ? Privilegios::User->get() : null));

                                            if ($this->object->saveUser($c)) {
                                                redirect("?b=profile&s=Inicio")->success("Usuario <strong>" . $_REQUEST['name'] . " " . $_REQUEST['surname'] . "</strong> agregado con exito")->send();
                                            } else {
                                                redirect("?b=profile&s=Inicio")->error("Error en agregar al colaborador <strong>" . $_REQUEST['name'] . " " . $_REQUEST['surname'] . "</strong>")->send();
                                            }
                                        }
                                    }
                                } else {
                                    redirect("?b=profile&s=optionSaveRedirec&p=$rol")->error("Las contraseñas no coinciden")->send();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    //-----Metodo para actualizar datos de usuario-----// check
    public function updateUser()
    {
        $apodo = (isset($_REQUEST['nickname'])) ? $_REQUEST['nickname'] : $_SESSION['usuario'];
        $rol = (isset($_REQUEST['p'])) ? $_REQUEST['p'] : "";
        $dni = (isset($_REQUEST['iduser'])) ? $_REQUEST['iduser'] : "";
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";
        if (isset($_POST['btnUpdateProfile'])) {
            if (empty($_POST['numid']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['addres']) || empty($_POST['zone']) || empty($_POST['email']) || empty($_POST['phone'])) {
                if (!empty($rol) && $rol == "Colaborador") {
                    redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("Se deben llenar todos los campos")->send();
                } else if (!empty($rol) && $rol == "Cliente") {
                    redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("Se deben llenar todos los campos")->send();
                } else {
                    redirect("?b=profile&s=Inicio")->error("Se deben llenar todos los campos con (*)")->send();
                }
            } else {
                if ($this->object->verifyLeterString($_POST['numid'])) {
                    if (!empty($rol) && $rol == "Colaborador") {
                        redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("El numero de identificacion no puede llevar letras")->send();
                    } else if (!empty($rol) && $rol == "Cliente") {
                        redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("El numero de identificacion no puede llevar letras")->send();
                    } else {
                        redirect("?b=profile&s=Inicio")->error("El numero de identificacion no puede llevar letras")->send();
                    }
                } else {
                    if ($this->object->selectParamBoolean("usuario", "dniuser", $_POST['numid'])) {
                        $currentUser = $this->object->getAllUser($_POST['numid']);
                        if (!empty($currentUser)) {
                            $primerUsuario = $currentUser[0];
                            if ($primerUsuario['nickuser'] == $apodo) {
                                $this->verifyUpdateUser($dni, $rol, $id);
                            } else {
                                if (!empty($rol) && $rol == "Colaborador") {
                                    redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("El número de Identificación se encuentra registrado con otro usuario")->send();
                                } else if (!empty($rol) && $rol == "Cliente") {
                                    redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("El número de Identificación se encuentra registrado con otro usuario")->send();
                                } else {
                                    redirect("?b=profile&s=Inicio")->error("El número de Identificación se encuentra registrado con otro usuario")->send();
                                }
                            }
                        } else {
                            if (!empty($rol) && $rol == "Colaborador") {
                                redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("No se encontraron usuarios para el número de identificación proporcionado.")->send();
                            } else if (!empty($rol) && $rol == "Cliente") {
                                redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("No se encontraron usuarios para el número de identificación proporcionado.")->send();
                            } else {
                                redirect("?b=profile&s=Inicio")->error("No se encontraron usuarios para el número de identificación proporcionado.")->send();
                            }
                        }
                    } else {
                        $this->verifyUpdateUser($dni, $rol, $id);
                    }
                }
            }
        }
    }

    // -----Segunda parte para la actualizacion de datos de un usuario----- // check 
    private function verifyUpdateUser($dni, $rol, $id)
    {

        if ($this->object->verifyNumberString($_POST['name']) || $this->object->verifyNumberString($_POST['surname'])) {
            if (!empty($rol) && $rol == "Colaborador") {
                redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("Los nombres y apellidos no pueden llevar numeros")->send();
            } else if (!empty($rol) && $rol == "Cliente") {
                redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("Los nombres y apellidos no pueden llevar numeros")->send();
            } else {
                redirect("?b=profile&s=Inicio")->error("Los nombres y apellidos no pueden llevar numeros")->send();
            }
        } else {
            if (!$this->object->verifyEmailString($_POST['email'])) {
                if (!empty($rol) && $rol == "Colaborador") {
                    redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("Formato de correo electronico invalido")->send();
                } else if (!empty($rol) && $rol == "Cliente") {
                    redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("Formato de correo electronico invalido")->send();
                } else {
                    redirect("?b=profile&s=Inicio")->error("Formato de correo electronico invalido")->send();
                }
            } else {
                if ($this->object->verifyLeterString($_POST['phone']) || $this->object->verifyLeterString($_POST['phone2'])) {
                    if (!empty($rol) && $rol == "Colaborador") {
                        redirect("?b=profile&s=optionEditRedirec&p=Colaborador&iduser=$dni")->error("Los numeros de telefono no pueden llevar letras")->send();
                    } else if (!empty($rol) && $rol == "Cliente") {
                        redirect("?b=profile&s=optionEditRedirec&p=Cliente&iduser=$dni")->error("Los numeros de telefono no pueden llevar letras")->send();
                    } else {
                        redirect("?b=profile&s=Inicio")->error("Los numeros de telefono no pueden llevar letras")->send();
                    }
                } else {
                    $u = new Profile();
                    $u->id = $id;
                    $u->dni = $_POST['numid'];
                    $u->name = $_POST['name'];
                    $u->surname = $_POST['surname'];
                    $u->nick = $_POST['nick'];
                    $u->email = $_POST['email'];
                    $u->addres = $_POST['addres'];
                    $u->zone = $_POST['zone'];
                    $u->phone = $_POST['phone'];
                    $u->phone2 = $_POST['phone2'];

                    if ($this->object->update($u)) {
                        redirect("?b=profile&s=Inicio")->success("Se ha actualizado la información del usuario")->send();
                    } else {
                        redirect("?b=profile&s=Inicio&p=admin")->error("No se pudo actualizar el usuario")->send();
                    }
                }
            }
        }
    }

    // -----Metodo para eliminar un usuario ----- //
    public function deleteUser()
    {
        $table = "usuario";
        $param = "dniuser";
        $id = $_REQUEST['id'];
        $action = $this->object->deleteUser($table, $param, $id);
        if ($action) {
            redirect("?b=profile&s=Inicio")->success("Se ha eliminado el usuario " . $_REQUEST['name'] . " con exito")->send();
        } else {
            redirect("?b=profile&s=Inicio&p=admin")->error("No se pudo eliminar el usuario.")->send();
        }
    }

    //-----Metodo para mostrar los resultados del buscador de Clientes------ //
    public function buscarClientes()
    {
        $searchTerm = $_POST['buscar_cliente'];
        $clientes = $this->object->buscarClientes($searchTerm);

        $roles = [
            Privilegios::User->get() => "Usuario",
        ];

        foreach ($clientes as $cliente) {
            echo '<tr>';
            echo '<td>' . $cliente['dniuser'] . '</td>';
            echo '<td>' . ($cliente['nameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['surnameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['nickuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['emailuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['diruser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['zoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['phoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['phonealtuser'] ?? "Sin definir") . '</td>';
            echo '<td class="icons1"><a href="#"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>';
            echo '<td class="icons2"><a href="#"><i class="fa-solid fa-trash-can" aria-hidden="true"></i></a></td>';
            echo '</tr>';
        }
    }

    //-----Metodo para mostrar los resultados del buscador de Clientes------ //
    public function buscarClientes2()
    {
        $searchTerm = $_POST['buscar_cliente'];
        $clientes = $this->object->buscarClientes($searchTerm);

        $roles = [
            Privilegios::User->get() => "Usuario",
        ];

        foreach ($clientes as $cliente) {
            echo '<tr>';
            echo '<td>' . $cliente['dniuser'] . '</td>';
            echo '<td>' . ($cliente['nameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['surnameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['nickuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['emailuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['diruser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['zoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['phoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($cliente['phonealtuser'] ?? "Sin definir") . '</td>';
            echo '</tr>';
        }
    }
    // -----METODOS DE PROVEEDOR ----- //

    // -----Metodo para guardar la informacion de un Proveedor----- //
    public function saveProveedor()
    {
        if (empty($_POST['name']) || empty($_POST['addres']) || empty($_POST['email']) || empty($_POST['phone'])) {
            redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("Se deben llenar todos los campos")->send();
        } else {
            if (!$this->object->verifyEmailString($_POST['email'])) {
                redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("Formato de correo electronico invalido")->send();
            } else {
                if ($this->object->verifyLeterString($_POST['phone'])) {
                    redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("el numero de telefono no puede llevar letras")->send();
                } else {

                    $p = new Profile();
                    $p->name = $_POST['name'];
                    $p->addres = $_POST['addres'];
                    $p->email = $_POST['email'];
                    $p->phone = $_POST['phone'];

                    if ($this->object->saveProveedor($p)) {
                        redirect("?b=profile&s=Inicio")->success("Proveedor <strong>" . $_POST['name'] . "</strong> agregado con exito")->send();
                    } else {
                        redirect("?b=profile&s=Inicio")->error("Error al guardar el proveedor")->send();
                    }
                }
            }
        }
    }

    // -----Metodo para Editar la informacion del Proveedor ----- //
    public function editProveedor()
    {
        if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['addres']) || empty($_POST['email']) || empty($_POST['phone'])) {
            $id = $_REQUEST['idprov'];
            redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $id)->error("Complete  todos los campos")->send();
        } else {
            if ($this->object->verifyLeterString($_POST['id'])) {
                $id = $_REQUEST['idprov'];
                redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $id)->error("El id no puede contener letras")->send();
            } else {
                if (!$this->object->verifyEmailString($_POST['email'])) {
                    $id = $_REQUEST['idprov'];
                    redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $id)->error("Formato de correo electronico invalido")->send();
                } else {
                    if ($this->object->verifyLeterString($_POST['phone'])) {
                        $id = $_REQUEST['idprov'];
                        redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $id)->error("El numero de telefono no puede tener letras")->send();
                    } else {
                        $p = new Profile();
                        $p->name = $_POST['name'];
                        $p->addres = $_POST['addres'];
                        $p->email = $_POST['email'];
                        $p->phone = $_POST['phone'];
                        $p->id = $_POST['id'];

                        if ($this->object->updateProveedor($p)) {
                            redirect("?b=profile&s=Inicio")->success("Informacion de proveedor <strong>" . $_POST['name'] . "</strong> editada con exito!")->send();
                        } else {
                            redirect("?b=profile&s=Inicio")->error("Error al editar informacion del Proveedor <strong>" . $_POST['name'] . "</strong>")->send();
                        }
                    }
                }
            }
        }
    }

    // -----Metodo para eliminar Proveedor ----- //
    public function deleteProveedor()
    {
        $table = "proveedor";
        $param = "idprov";
        $id = $_REQUEST['id'];
        $action = $this->object->deleteUser($table, $param, $id);
        if ($action) {
            redirect("?b=profile&s=Inicio")->success("Se ha eliminado el proveedor " . $_REQUEST['name'] . " con exito")->send();
        } else {
            redirect("?b=profile&s=Inicio")->error("No se pudo eliminar el proveedor, revise que no haya ningun producto asignado a este proveedor. ")->send();
        }
    }

    // -----Metodo para buscar Proveedores-----//
    public function buscarProveedor()
    {
        $searchTerm = $_POST['buscar_proveedor'];
        $proveedores = $this->object->getAll("proveedor");

        $filteredProveedores = array_filter($proveedores, function ($proveedor) use ($searchTerm) {
            return (stripos($proveedor['idprov'], $searchTerm) !== false) ||
                (stripos($proveedor['nomprov'], $searchTerm) !== false);
        });

        foreach ($filteredProveedores as $proveedor) {
            echo '<tr>';
            echo '<td>' . $proveedor['idprov'] . '</td>';
            echo '<td>' . ($proveedor['nomprov'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($proveedor['dirprov'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($proveedor['emaprov'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($proveedor['telprov'] ?? "Sin definir") . '</td>';
            echo '<td class="icons1"><a href="?b=profile&s=optionEditRedirec&p=mascota&idmas=<?= $mascota["idmas"]; ?><i
    class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>';
            echo '<td class="icons2"><a href="#"><i class="fa-solid fa-trash-can" aria-hidden="true"></i></a></td>';
            echo '</tr>';
        }
    }

    // ----------METODOS DE MASCOTA---------- //

    // -----Metodo para guardar una mascota-----//
    public function saveMascota()
    {
        if (
            empty($_POST['name']) || empty($_POST['age']) || empty($_POST['gen']) || empty($_POST['esp']) ||
            empty($_POST['owner'])
        ) {
            redirect("?b=profile&s=optionSaveRedirec&p=mascota")->error("Complete todos los campos")->send();
        } else {
            if ($this->object->verifyNumberString($_POST['name'])) {
                redirect("?b=profile&s=optionSaveRedirec&p=mascota")->error("El nombre de la mascota no debe llevar numeros")->send();
            } else {
                $p = new Profile();
                $p->name = $_POST['name'];
                $p->age = $_POST['age'];
                $p->gen = $_POST['gen'];
                $p->esp = $_POST['esp'];
                $p->owner = $_POST['owner'];

                if ($this->object->saveMascota($p)) {
                    redirect("?b=profile&s=Inicio")->success("Mascota " . $_POST['name'] . " agregada con exito!")->send();
                } else {
                    redirect("?b=profile&s=Inicio")->error("Error al guardar la mascota")->send();
                }
            }
        }
    }

    // -----Metodo para editar la informacion de la mascota-----//

    public function updateMascota()
    {
        $id = $_REQUEST['id'];

        if (empty($_POST['name']) || empty($_POST['age']) || empty($_POST['gen']) || empty($_POST['esp'])) {
            redirect("?b=profile&s=optionEditRedirec&p=mascota&idmas=$id")->error("Complete todos los campos")->send();
        } else {
            if ($this->object->verifyNumberString($_POST['name'])) {
                redirect("?b=profile&s=optionEditRedirec&p=mascota&idmas=$id")->error("El nombre de la mascota no puede llevar
numeros")->send();
            } else {
                $up = new Profile();
                $up->id = $id;
                $up->name = $_POST['name'];
                $up->age = $_POST['age'];
                $up->gen = $_POST['gen'];
                $up->esp = $_POST['esp'];

                if ($this->object->updateMascota($up)) {
                    redirect("?b=profile&s=Inicio")->success("La informacion de la mascota <strong>" . $_POST['name'] . "</strong> ha sido
actualizada con exito!")->send();
                } else {
                    redirect("?b=profile&s=Inicio")->error("Error al actualizar la mascota <strong>" . $_POST['name'] .
                        "</strong>")->send();
                }
            }
        }
    }

    // -----Metodo eliminar una mascota----- //
    public function deleteMascota()
    {
        $table = "mascota";
        $param = "idmas";
        $id = $_REQUEST['id'];
        $action = $this->object->deleteUser($table, $param, $id);
        if ($action) {
            redirect("?b=profile&s=Inicio")->success("Se ha eliminado la mascota con exito")->send();
        } else {
            redirect("?b=profile&s=Inicio&p=admin")->error("Error al eliminar la mascota")->send();
        }
    }

    // -----Metodo oara mostrar los resultados del buscador de Mascotas------ //
    public function buscarMascotas()
    {
        $searchTerm = $_POST['buscar_mascota'];
        $mascotas = $this->object->getAll("mascota");

        $privilegios = $_SESSION["privilegios"];
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);
        $users = $this->object->getAll("usuario");

        $filteredmascota = array_filter($mascotas, function ($mascota) use ($searchTerm) {
            return (stripos($mascota['idmas'], $searchTerm) !== false) ||
                (stripos($mascota['nommas'], $searchTerm) !== false) ||
                (stripos($mascota['edadmas'], $searchTerm) !== false) ||
                (stripos($mascota['genmas'], $searchTerm) !== false);
        });

        foreach ($filteredmascota as $mascota) {
            echo '<tr>';
            echo '<td>' . $mascota['idmas'] . '</td>';
            echo '<td>' . ($mascota['nommas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['edadmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['genmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['espmas'] ?? "Sin definir") . '</td>';
            echo '<td>';
            if ($privilegios == Privilegios::User->get()) {
                echo $user['dniuser'];
            } else {
                $dueño = array_filter($users, function ($usuario) use ($mascota) {
                    return $usuario['iduser'] == $mascota['idcli'];
                });

                if (!empty($dueño)) {
                    $dueño = reset($dueño);
                    echo $dueño['dniuser'];
                }
            }
            echo '</td>';
            if ($privilegios == Privilegios::Recepcionist->get()) {
                echo '<td class="icons1"><a href="?b=profile&s=optionEditRedirec&p=mascota&idmas=' . $mascota['idmas'] . '"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>';
            }
            if ($privilegios != Privilegios::Doctor->get() && $privilegios != Privilegios::Recepcionist->get()) {
                echo '<td class="icons2"><a href="#"><i class="fa-solid fa-trash-can" aria-hidden="true"></i></a></td>';
            }
            echo '</tr>';
        }
    }

    public function buscarMascotas2()
    {
        $searchTerm = $_POST['buscar_mascota'];
        $mascotas = $this->object->getAll("mascota");

        $privilegios = $_SESSION["privilegios"];
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);
        $users = $this->object->getAll("usuario");

        $filteredmascota = array_filter($mascotas, function ($mascota) use ($searchTerm) {
            return (stripos($mascota['idmas'], $searchTerm) !== false) ||
                (stripos($mascota['nommas'], $searchTerm) !== false) ||
                (stripos($mascota['edadmas'], $searchTerm) !== false) ||
                (stripos($mascota['genmas'], $searchTerm) !== false);
        });

        foreach ($filteredmascota as $mascota) {
            echo '<tr>';
            echo '<td>' . $mascota['idmas'] . '</td>';
            echo '<td>' . ($mascota['nommas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['edadmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['genmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['espmas'] ?? "Sin definir") . '</td>';
            echo '<td>';
            if ($privilegios == Privilegios::User->get()) {
                echo $user['dniuser'];
            } else {
                $dueño = array_filter($users, function ($usuario) use ($mascota) {
                    return $usuario['iduser'] == $mascota['idcli'];
                });

                if (!empty($dueño)) {
                    $dueño = reset($dueño);
                    echo $dueño['dniuser'];
                }
            }
            echo '</tr>';
        }
    }

    public function buscarMascotas3()
    {
        $searchTerm = $_POST['buscar_mascota'];
        $mascotas = $this->object->getAll("mascota");

        $privilegios = $_SESSION["privilegios"];
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);
        $users = $this->object->getAll("usuario");

        $filteredmascota = array_filter($mascotas, function ($mascota) use ($searchTerm) {
            return (stripos($mascota['idmas'], $searchTerm) !== false) ||
                (stripos($mascota['nommas'], $searchTerm) !== false) ||
                (stripos($mascota['edadmas'], $searchTerm) !== false) ||
                (stripos($mascota['genmas'], $searchTerm) !== false);
        });

        foreach ($filteredmascota as $mascota) {
            echo '<tr>';
            echo '<td>' . $mascota['idmas'] . '</td>';
            echo '<td>' . ($mascota['nommas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['edadmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['genmas'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($mascota['espmas'] ?? "Sin definir") . '</td>';
            echo '<td>';
            if ($privilegios == Privilegios::User->get()) {
                echo $user['dniuser'];
            } else {
                $dueño = array_filter($users, function ($usuario) use ($mascota) {
                    return $usuario['iduser'] == $mascota['idcli'];
                });

                if (!empty($dueño)) {
                    $dueño = reset($dueño);
                    echo $dueño['dniuser'];
                }
            }
            echo '</td>';
            echo '<td class="icons1"><a href="?b=profile&s=optionEditRedirec&p=mascota&idmas=' . $mascota['idmas'] . '"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>';
            echo '</tr>';
        }
    }

    // -----Metodo oara mostrar los resultados del buscador de Colaborador------ //
    public function buscarColaborador()
    {
        $searchTerm = $_POST['buscar_empleado'];
        $empleados = $this->object->buscarColaborador($searchTerm);

        $roles = [
            Privilegios::Recepcionist->get() => "Recepcionista",
            Privilegios::Doctor->get() => "Doctor",
            Privilegios::Recepcionist->get() + Privilegios::Doctor->get() => "Doctor, Recepcionista",
        ];

        foreach ($empleados as $empleado) {
            echo '<tr>';
            echo '<td>' . $empleado['dniuser'] . '</td>';
            echo '<td>' . ($empleado['nameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['surnameuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['nickuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['emailuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['diruser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['zoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['phoneuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($empleado['phonealtuser'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($roles[$empleado['privileges']] ?? "Sin definir") . '</td>';
            echo '<td class="icons1"><a href="#"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>';
            echo '<td class="icons2"><a href="#"><i class="fa-solid fa-trash-can" aria-hidden="true"></i></a></td>';
            echo '</tr>';
        }
    }

    // -----Metodo para buscar Citas-----//
    public function buscarCita()
    {
        $searchTerm = $_POST['buscar_cita'];
        $cita = $this->object->getAll("cita");
        $privilegios = $_SESSION["privilegios"];
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);
        $users = $this->object->getAll("usuario");


        $filteredcita = array_filter($cita, function ($c) use ($searchTerm) {
            return (stripos($c['idcita'], $searchTerm) !== false) ||
                (stripos($c['dniusercit'], $searchTerm) !== false) ||
                (stripos($c['nameusercit'], $searchTerm) !== false) ||
                (stripos($c['servicecit'], $searchTerm) !== false) ||
                (stripos($c['namemascit'], $searchTerm) !== false) ||
                (stripos($c['statecit'], $searchTerm) !== false);
        });

        foreach ($filteredcita as $c) {
            echo '<tr>';
            echo '<td>' . $c['idcita'] . '</td>';
            echo '<td>' . ($c['dniusercit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['nameusercit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['phoneusercit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['emailusercit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['namemascit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['espmascit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['genmascit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['motcit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['servicecit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['datesolcit'] == NULL ? "No Asignado" : $c['datesolcit']) . '</td>';
            echo '<td>' . ($c['statecit'] ?? "Sin definir") . '</td>';
            echo '<td>' . ($c['datecit'] == NULL ? "No Asignado" : $c['datecit']) . '</td>';
            echo '<td>' . ($c['hourcit'] == NULL ? "No Asignado" : $c['hourcit']) . '</td>';
            echo '<td>' . ($c['idcolcit'] ?? "Sin definir") . '</td>';
            echo '</tr>';
        }
    }

    // ---------METODOS PARA CITA---------//

    // -----Metodo par asignar cita-----//
    public function assigAppointment()
    {
        if (empty($_POST['idcit']) || empty($_POST['dateasig']) || empty($_POST['selhour']) || empty($_POST['selcol'])) {
            redirect("?b=profile&s=Inicio")->error("Intente asignar la cita nuevamente y verifique que complete todos los campos!")->send();
        } else {
            $ap = new Profile();
            $ap->idcit = $_POST['idcit'];
            $timestamp = strtotime($_POST['dateasig']);
            $fecha = date("Y-m-d", $timestamp);
            $ap->dateasig = $fecha;
            $timestamp = strtotime($_POST['selhour']);
            $hora = date("H:i:s", $timestamp);
            $ap->hourasig = $hora;
            $ap->colasig = $_POST['selcol'];
            $ap->statecit = "Asignado";

            if ($this->object->updateAppointment($ap)) {
                redirect("?b=profile&s=Inicio")->success("La cita del usuario <strong>" . $_POST['nameuser'] . "</strong> y su mascota <strong>" . $_POST['namemas'] . "</strong> asiganda con exito!")->send();
            } else {
                redirect("?b=profile&s=Inicio")->error("Error al asignar la cita")->send();
            }
        }
    }

    // ----------METODOS PARA RECETAR ---------- // 

    // -----Mostrar Formulario de receta-----//
    public function showReceta()
    {


        if (empty($_POST['numidcol']) || empty($_POST['dniuser']) || empty($_POST['selMas']) || empty($_POST['receta']) || empty($_POST['nameprod']) || empty($_POST['cantprod']) || empty($_POST['precprod'])) {
            redirect("?b=profile&s=Inicio")->error("Campos vacios: Asegurese de completar todos los campos y selccionar productos para recetar!")->send();
        } else {
            if ($this->object->verifyLeterString($_POST['numidcol']) || $this->object->verifyLeterString($_POST['dniuser'])) {
                redirect("?b=profile&s=Inicio")->error("Verifique que los numeros de identificacion no lleven letras!")->send();
            } else {
                $vet = $this->object->getAllUser($_POST['numidcol']);
                $user = $this->object->getAllUser($_POST['dniuser']);
                $pet = $this->object->getAllPet($_POST['selMas']);

                if ($vet) {
                    if ($user) {
                        if ($pet) {
                            foreach ($user as $value) {
                                foreach ($pet as $value2) {
                                    if ($value['iduser'] == $value2['idcli']) {
                                        foreach ($vet as $value3) {
                                            $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                                            include_once "view/head.php";
                                            include_once "view/profile/save/new-receta.php";
                                        }
                                    } else {
                                        redirect("?b=profile&s=Inicio")->error("La mascota no pertenece al cliente!")->send();
                                    }
                                }
                            }

                        } else {
                            redirect("?b=profile&s=Inicio")->error("La mascota no existe!")->send();
                        }
                    } else {
                        redirect("?b=profile&s=Inicio")->error("El cliente con numero de documento <strong>" . $_POST['dniuser'] . "</strong> no existe!")->send();
                    }
                } else {
                    redirect("?b=profile&s=Inicio")->error("El usuario con numero de documento <strong>" . $_POST['numidcol'] . "</strong> no existe!")->send();
                }
            }
        }
    }

    // -----Metodo para Calcular el Precio de un producto segun su cantidad---- //
    public function calcPrecio($cantidad, $precio)
    {
        return $cantidad * $precio;
    }

    public function preVentProd($name)
    {
        return $this->object->getValProduct($name);
    }

    public function saveReceta()
    {

        $rec = new Profile();

        $rec->dnicol = $_POST['idcol'];
        $rec->dni = $_POST['iduser'];
        $rec->idmas = $_POST['idmas'];
        $rec->prod = $_POST['products'];
        $rec->cant = $_POST['cantprod'];
        $rec->prec = $_POST['prect'];
        $rec->date = $_POST['date'];
        $rec->rec = $_POST['receta'];

        if ($this->object->saveReceta($rec)) {
            redirect("?b=profile&s=Inicio")->success("Receta Guardada con exito!")->send();
        } else {
            redirect("?b=profile&s=Inicio")->error("Error al guardar la receta!")->send();
        }

    }

    // -----Metodo para guardar informacion de la receta y generar PDF ----- //
    public function generateReceta()
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->Cell(0, 10, 'RECETA VETERINARIA - ANIMAL WORLD ', 0, 1, 'C');

        $receta = $this->object->getAllReceta($_POST['idrec']);

        foreach ($receta as $receta) {
            $vet = $this->object->getAllUser($receta['dnicolrec']);
            $user = $this->object->getAllUser($receta['dniuserrec']);
            $pet = $this->object->getAllPet($receta['idmasrec']);

            if ($vet) {
                if ($user) {
                    if ($pet) {
                        foreach ($user as $value) {
                            foreach ($pet as $value2) {
                                if ($value['iduser'] == $value2['idcli']) {
                                    foreach ($vet as $value3) {
                                        $pdf->Cell(0, 10, 'Fecha: ' . $receta['fecharec'], 0, 1, 'R');
                                        $pdf->Cell(0, 10, '-- Datos del Veterinario -- ', 0, 1, 'C');
                                        $pdf->Cell(0, 10, 'DNI Veterinario: ' . $value3['dniuser'], 0, 1);
                                        $pdf->Cell(0, 10, 'Nombre del Veterinario: ' . $value3['nameuser'] . ' ' . $value3['surnameuser'], 0, 1);
                                        $pdf->Cell(0, 10, '-- Datos del Usuario y su Mascota -- ', 0, 1, 'C');
                                        $pdf->Cell(0, 10, 'DNI Usuario: ' . $value['dniuser'], 0, 1);
                                        $pdf->Cell(0, 10, utf8_decode('Nombre del Usuario: ' . $value['nameuser'] . ' ' . $value['surnameuser']), 0, 1);
                                        $pdf->Cell(0, 10, 'Mascota: ' . $value2['nommas'], 0, 1);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $pdf->Ln();
            $pdf->Cell(0, 10, 'Productos Recetados:', 0, 1);
            $pdf->Cell(40, 10, 'Producto', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Cantidad', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Precio Unitario', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Precio Total', 1, 0, 'C');
            $pdf->Ln();

            $caja1 = explode(",", $receta['prodrec']);
            $caja2 = explode(",", $receta['cantprodrec']);
            $r = new ProfileController();

            for ($i = 0; $i < count($caja1); $i++) {
                $precio = $r->preVentProd(trim($caja1[$i]));
                $preciot = $r->calcPrecio(trim(intval($caja2[$i])), trim(intval($precio)));

                $pdf->Cell(40, 10, $caja1[$i], 1, 0, 'C');
                $pdf->Cell(40, 10, $caja2[$i], 1, 0, 'C');
                $pdf->Cell(40, 10, ' $ ' . $precio, 1, 0, 'C');
                $pdf->Cell(40, 10, ' $ ' . $preciot, 1, 0, 'C');
                $pdf->Ln();
            }

            $pdf->Cell(120, 10, 'Total:', 1);
            $pdf->Cell(40, 10, ' $ ' . $receta['precrec'], 1, 0, 'R');
            $pdf->Ln();
            $pdf->Ln();

            $pdf->Cell(0, 10, 'Receta:', 0, 1);
            $pdf->MultiCell(0, 10, $receta['indrec'], 0, 'L');
        }

        ob_start();
        $pdf->Output();
        $pdfContent = ob_get_clean();

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="receta_veterinaria_' . $_POST['iduser'] . '.pdf"');
        header('Content-Length: ' . strlen($pdfContent));

        echo $pdfContent;
        exit();
    }


    //Metodo para cerrar Sesion
    public function cerrarSesion()
    {
        session_destroy();
        redirect("index.php")->success("Se ha cerrado la sesion correctamente")->send();
        exit();
    }
}