<?php
require_once './lib/database/database.php';
class ProductModel
{

    private $pdo;
    public $idprod, $nomprod, $desprod, $precprod, $precvenprod, $stockprod, $catprod, $idprov, $namecat, $descat;

    public function __construct()
    {
        $this->pdo = databaseConexion::conexion();
    }

    // -----Metodo para seleccionar todos los datos de una tabla ----- //
    public function getAll($table)
    {
        $query = "SELECT * FROM $table";
        $result = $this->pdo->query($query);
        $array = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $array[] = $row;
            }
        }
        return $array;
    }

    public function getAllProducts()
    {
        $query = "SELECT prd.*, prv.nomprov, cat.namecat FROM producto as prd, proveedor as prv, categoria as cat WHERE prd.idprov = prv.idprov";
        $sql = "SELECT * FROM producto; ";
        $result = $this->pdo->query($sql);
        $producto = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $producto[] = $row;
            }
        }
        return $producto;
    }

    public function saveProducto(ProductModel $data)
    {
        try {
            $sql = 'INSERT INTO producto (nomprod,desprod,precprod,precvenprod,stockprod,catprod,idprov)
            VALUES (?, ?, ?, ?, ?, ?, ?)';
            $action = $this->pdo->prepare($sql);
            if ($action->execute(array($data->nomprod, $data->desprod, $data->precprod, $data->precvenprod, $data->stockprod, $data->catprod, $data->idprov))) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function saveCategory(ProductModel $data)
    {
        try {
            $sql = "INSERT INTO categoria(namecat, descat) VALUES (?, ?)";
            $result = $this->pdo->prepare($sql)->execute(
                array(
                    $data->namecat,
                    $data->descat,
                )
            );

            if ($result) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo "Error al guardar la categoria en la base de datos: " . $e->getMessage();
        }
    }

    public function actualizar($data)
    {
        try {
            $sql = 'UPDATE producto SET
                nomprod = ?,
                desprod = ?,
                precprod = ?,
                precvenprod = ?,
                stockprod = ?,
                catprod = ?,
                idprov = ?
                WHERE idprod = ?';
            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->nomprod,
                        $data->desprod,
                        $data->precprod,
                        $data->precvenprod,
                        $data->stockprod,
                        $data->catprod,
                        $data->idprov,
                        $data->idprod
                    )
                );
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM producto WHERE idprod =" . $id;
        try {
            $result = $this->pdo->prepare($sql);
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // -----Metodo para verificar si un string contiene numeros----- //
    public function verifyNumberString($string)
    {
        return preg_match('/\d/', $string) === 1 ? true : false;
    }

    // -----Metodo para verificar que entre los numero haya letras----- //
    public function verifyLeterString($number)
    {
        return preg_match('/[a-zA-Z]/', $number) === 1 ? true : false;
    }

}
?>