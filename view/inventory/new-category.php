<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/style-editar.css">
    <title>editar producto</title>

<body>
    <header>
        <div class="imagen-logo">
            <img class="logo" src="assets/img/logo-removebg.png" alt="">
        </div>
        <div class="informacion-title">
            <h1>Nueva Categoria</h1>
            <h3>Animal World</h3>
        </div>
    </header>

    <div class="container">
        <div class="regresar">
            <a href="?b=inventory&s=Inicio"><button class="btn-regresar"><i class="fa-solid fa-arrow-left"></i></button>
            </a>
        </div>
        <form action="?b=inventory&s=guardarCategoria" method="post">
            <div class="input">
                <label for="nombre">Nombre de la categoria: </label>
                <input type="text" id="nameCat" name="nameCat" placeholder="Agrega el nombre del producto">
            </div>
            <div class="input">
                <label for="nombre">Descripcion:</label>
                <input type="text" id="desCat" name="desCat" placeholder="Agrega  la descripcion del producto">
            </div>
            <div class="button">
                <button class="btn-save" type="submit">Guardar</button>
            </div>
        </form>
    </div>
    </head>
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
</body>

</html>