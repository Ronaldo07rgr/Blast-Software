<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style-editar.css">
    <title>editar producto</title>

<body>
    <header>
        <div class="imagen-logo">
            <img class="logo" src="assets/img/logo-removebg.png" alt="">
        </div>
        <div class="informacion-title">
            <h1>EDITAR REGISTROS</h1>
            <h3>Animal World</h3>
        </div>
    </header>
    <div class="container">
        <div class="regresar">
            <a href="?b=inventory&s=Inicio"><button class="btn-regresar"><i
                        class="fa-solid fa-arrow-left"></i></button></a>
        </div>
        <form action="?b=inventory&s=edit" method="post">
            <input type="hidden" value="<?= $producto['idprod'] ?? "" ?>" name="idprod">
            <div class="input">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Edita el nombre del producto"
                    value="<?= $producto["nomprod"] ?? "" ?>">
            </div>
            <div class="input">
                <label for="nombre">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Edita la descripcion del producto" value="<?= $producto["desprod"] ?? "" ?>">
            </div>
            <div class="input">
                <label for="nombre">Precio:</label>
                <input type="text" id="precio" name="precio" placeholder="Edita el precio del producto" value="<?= $producto["precprod"] ?? "" ?>">
            </div>
            <div class="input">
                <label for="nombre">Precio de venta:</label>
                <input type="text" id="precio de venta" name="venta" placeholder="Edita el precio de venta del producto" value="<?= $producto["precvenprod"] ?? "" ?>">
            </div>
            <div class="input">
                <label for="nombre">Cantidad existente:</label>
                <input type="text" id="Cantidad existente" name="cantidad" placeholder="Edita la Cantidad existente del producto" value="<?= $producto["stockprod"] ?? "" ?>">
            </div>
            <div class="input">
                <label for="nombre">Categoria:</label>
                <select name="selCat" id="selCat">
                    <option selected disabled>Seleccione una opcion</option>
                    <?php
                        foreach ($categorias as $categoria) {
                            echo "<option value='" . $categoria['idcat'] . "' " . (($producto['catprod'] == $categoria['idcat']) ? "selected" : "") . ">" . $categoria['namecat'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="input">
                <label for="idprov">Proveedor: </label>
                <select name="selProv" id="selCat">
                    <option selected disabled>Seleccione una opcion</option>
                    <?php
                        foreach ($proveedores as $proveedor) {
                            echo "<option value='" . $proveedor['idprov'] . "' " . (($producto['idprov'] == $proveedor['idprov']) ? "selected" : "") . ">" . $proveedor['nomprov'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="button">
                <button class="btn-save" type="submit">Guardar</button>
            </div>
            <div class="input">
                <input type="hidden" name="idprod"
                    value="<?= $producto["idprod"]                                                               ?>">
            </div>
        </form>
    </div>
    </head>
</body>
<script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>

</html>