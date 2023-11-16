<?php

include_once 'lib/database/database.php';
require_once 'model/inventory.php';

class InventoryController
{
    private $model;
    private $prod;
    private $conexion;
    public function __construct()
    {
        $this->conexion = databaseConexion::conexion();
        $this->model = new ProductModel();
    }

    public function Inicio()
    {
        $this->listado();
    }

    public function listado()
    {
        // -----Metodos para obtener los datos----- //
        $productos = $this->model->getAllProducts();
        $categorias = $this->model->getAll("categoria");
        $proveedores = $this->model->getAll("proveedor");

        // -----Metodos para el buscador----- //
        $param = [];
        $resto = "";
        if (isset($_REQUEST["search"])) {
            $resto = "&& (prd.nomprod LIKE ? || prd.desprod LIKE ? || prd.catprod LIKE ? || prv.nomprov LIKE ?)";
            $param[] = "%" . $_REQUEST["search"] . "%";
            $param[] = "%" . $_REQUEST["search"] . "%";
            $param[] = "%" . $_REQUEST["search"] . "%";
            $param[] = "%" . $_REQUEST["search"] . "%";
        }
        $stmt = $this->conexion->prepare("SELECT prd.*, prv.idprov, prv.nomprov FROM producto as prd, proveedor as prv WHERE prv.idprov = prd.idprov" . $resto);
        $stmt->execute($param);
        $productos = [];
        $result = $stmt->get_result();
        while ($item = $result->fetch_assoc()) {
            $productos[] = $item;
        }

        // -----Estilos----- //
        $style = "<link rel='stylesheet' href='assets/css/style-inventory.css'>";
        require_once "view/head.php";
        require_once 'view/inventory/inventory.php';
    }

    // -----Metodo para vista de nueva categoria----- // 
    public function newCategory()
    {
        $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editar.css'>";
        require_once "view/head.php";
        require_once "view/inventory/new-category.php";
    }

    // -----Metodo para vista de editar un producto----- //
    public function showEditar()
    {
        // -----Metodos para obtener los datos----- //
        $productos = $this->model->getAllProducts();
        $categorias = $this->model->getAll("categoria");
        $proveedores = $this->model->getAll("proveedor");


        $stmt = $this->conexion->prepare("SELECT prd.*, prv.idprov, prv.nomprov FROM producto as prd, proveedor as prv WHERE prv.idprov = prd.idprov && idprod = ?");
        $stmt->execute([$_REQUEST["idprod"]]);
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
        $style = "<link rel='stylesheet' href='assets/css/style-editar.css'>";
        require_once "view/head.php";
        require_once 'view/inventory/editar.php';
    }

    // -----Metodo para la vista de agregar nuevo producto----- //
    public function showAdd()
    {
        $categorias = $this->model->getAll("categoria");
        $proveedores = $this->model->getAll("proveedor");
        $style = "<link rel='stylesheet' type='text/css' href='assets/css/agregar.css'>";
        require_once "view/head.php";
        require_once 'view/inventory/agregar.php';
    }

    // -----Metodo para guardar un nuevo producto----- // 
    public function saveProduct()
    {
        if (empty($_POST['name']) || empty($_POST['des']) || empty($_POST['prec']) || empty($_POST['precVen']) || empty($_POST['cant']) || empty($_POST['selCat']) || empty($_POST['selProv'])) {
            redirect("?b=inventory&s=showAdd")->error("Se deben llenar todos los campos")->send();
        } else {
            if ($this->model->verifyNumberString($_POST['nombre'])) {
                redirect("?b=inventory&s=showAdd")->error("El nombre no puede llevar numeros")->send();
            } else {
                if ($this->model->verifyLeterString($_POST['precio'])) {
                    redirect("?b=inventory&s=showAdd")->error("El precio no puede llevar letras")->send();
                } else if ($this->model->verifyLeterString($_POST['venta'])) {
                    redirect("?b=inventory&s=showAdd")->error("El precio de venta no puede llevar letras")->send();
                } else if ($this->model->verifyLeterString($_POST['cantidad'])) {
                    redirect("?b=inventory&s=showAdd")->error("La cantidad de productos no puede llevar letras")->send();
                } else {
                    $prod = new ProductModel();
                    $prod->nomprod = $_POST['name'];
                    $prod->desprod = $_POST['des'];
                    $prod->precprod = $_POST['prec'];
                    $prod->precvenprod = $_POST['precVen'];
                    $prod->stockprod = $_POST['cant'];
                    $prod->catprod = $_POST['selCat'];
                    $prod->idprov = $_POST['selProv'];

                    if ($this->model->saveProducto($prod)) {
                        redirect("?b=inventory&s=Inicio")->success("Producto agregado con exito!!!")->send();
                    } else {
                        redirect("?b=inventory&s=Inicio")->error("No se agrego el producto")->send();
                    }
                }
            }
        }
    }

    public function eliminar()
    {
        $prod = $_REQUEST["idprod"];
        if ($this->model->deleteProduct($prod)) {
            redirect("?b=inventory&s=Inicio")->success("Producto eliminado con exito")->send();
        } else {
            redirect("?b=inventory&s=Inicio")->error("Error al eliminar el producto")->send();
        }

    }

    public function edit()
    {
        if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['venta']) || empty($_POST['cantidad']) || empty($_POST['selCat']) || empty($_POST['selProv'])) {
            $id = $_REQUEST['idprod'];
            redirect("?b=inventory&s=showEditar&idprod=$id")->error("Todos los campos deben estar llenos")->send();
        } else {
            if ($this->model->verifyNumberString($_POST['nombre'])) {
                $id = $_REQUEST['idprod'];
                redirect("?b=inventory&s=showEditar&idprod=$id")->error("El nombre no puede llevar numeros")->send();
            } else {
                if ($this->model->verifyLeterString($_POST['precio'])) {
                    $id = $_REQUEST['idprod'];
                    redirect("?b=inventory&s=showEditar&idprod=$id")->error("El precio no puede llevar letras")->send();
                } else if ($this->model->verifyLeterString($_POST['venta'])) {
                    $id = $_REQUEST['idprod'];
                    redirect("?b=inventory&s=showEditar&idprod=$id")->error("El precio de venta no puede llevar letras")->send();
                } else if ($this->model->verifyLeterString($_POST['cantidad'])) {
                    $id = $_REQUEST['idprod'];
                    redirect("?b=inventory&s=showEditar&idprod=$id")->error("La cantidad de productos no puede llevar letras")->send();
                } else {
                    $prod = new ProductModel();
                    $prod->idprod = $_POST['idprod'];
                    $prod->nomprod = $_POST['nombre'];
                    $prod->desprod = $_POST['descripcion'];
                    $prod->precprod = $_POST['precio'];
                    $prod->precvenprod = $_POST['venta'];
                    $prod->stockprod = $_POST['cantidad'];
                    $prod->catprod = $_POST['selCat'];
                    $prod->idprov = $_POST['selProv'];

                    if ($this->model->actualizar($prod)) {
                        redirect("?b=inventory&s=Inicio")->success("Se ha actualizado el producto <b>" . $_REQUEST["nombre"] . "</b> correctamente")->send();
                    } else {
                        redirect("?b=inventory&s=Inicio")->error("Error al editar informacion del Producto")->send();
                    }

                }
            }
        }
    }


    // -----Metodo para guardar un nueva categoria----- // 
    public function guardarCategoria()
    {
        if (!empty($_POST['nameCat']) || !empty($_POST['desCat'])) {
            if ($this->model->verifyNumberString($_POST['nameCat'])) {
                redirect("?b=inventory&s=newCategory")->error("El nombre de la categoria no puede llevar numeros")->send();
            } else {
                $cat = new ProductModel();
                $cat->namecat = $_POST['nameCat'];
                $cat->descat = $_POST['desCat'];
                if ($this->model->saveCategory($cat)) {
                    redirect("?b=inventory&s=Inicio")->success("Categoria agregada con exito!!!")->send();
                } else {
                    redirect("?b=inventory&s=Inicio")->error("No se agrego la categoria")->send();
                }
            }
        } else {
            var_dump(empty($_POST['nameCat']));
        }
    }
}