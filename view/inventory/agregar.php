<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/style-editar.css">
    <title>editar producto</title>
</head>
<body>
    <header>
        <div class="imagen-logo">
            <img class="logo" src="assets/img/logo-removebg.png" alt="">
        </div>
        <div class="informacion-title">
            <h1>AGREGAR PRODUCTO</h1>
            <h3>Animal World</h3>
        </div>
    </header>

    <div class="container">
        <div class="regresar">
            <a href="?b=inventory&s=Inicio"><button class="btn-regresar"><i class="fa-solid fa-arrow-left"></i></button>
            </a>
        </div>
        <form action="?b=inventory&s=saveProduct" method="post">
            <div class="input">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="name" placeholder="Agrega el nombre del producto">
            </div>
            <div class="input">
                <label for="nombre">Descripcion:</label>
                <input type="text" id="descripcion" name="des" placeholder="Agrega  la descripcion del producto">
            </div>
            <div class="input">
                <label for="nombre">Precio:</label>
                <input type="number" id="precio" name="prec" placeholder="Agrega el precio del producto">

            </div>
            <div class="input">
                <label for="nombre">Precio de venta al publico: </label>
                <input type="number" id="precio de venta" name="precVen"
                    placeholder="Agrega el precio de venta del producto">
            </div>
            <div class="input">
                <label for="nombre">Cantidad existente (Unidades):</label>
                <input type="number" id="Cantidad existente" name="cant"
                    placeholder="Agrega la Cantidad existente del producto">
            </div>
            <div class="input">
                <label for="nombre">Categoria:</label>
                <select name="selCat" id="selCat">
                    <option selected disabled>Seleccione una opcion</option>
                    <?php
                        foreach ($categorias as $categoria) {
                            echo "<option value=".$categoria['idcat'].">".$categoria['namecat']."</option>"; 
                        }
                    ?>
                </select>
            </div>
            <div class="input">
                <label for="nombre">Proveedor: </label>
                <select name="selProv" id="selCat">
                    <option selected disabled>Seleccione una opcion</option>
                    <?php
                        foreach ($proveedores as $proveedor) {
                            echo "<option value=".$proveedor['idprov'].">".$proveedor['nomprov']."</option>"; 
                        }
                    ?>
                </select>
            </div>
            <div class="button">
                <button class="btn-save">Guardar</button>
            </div>
        </form>
    </div>
    </head>
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
</body>

</html>