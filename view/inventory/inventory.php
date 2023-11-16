<body>
    <div class="container">
        <header>
            <div class="img-logp">
                <img class="logo" src="assets/img/logo-removebg.png" alt="">
            </div>
            <div class="text-logo">
                <h1>INVENTARIO</h1>
                <h3>Animal World</h3>
            </div>
        </header>
        <div class="child-container">
            <div class="container-button">
                <div class="search-bar">
                    <div class="search">
                        <a href="?b=profile&s=Inicio&p=admin"><button class="btn-regresar"><i
                                    class="fa-solid fa-arrow-left"></i></button></a>
                        <form id="buscador-form" action="?b=inventory&s=listado" method="get">
                            <input id="buscador" name="buscador" type="text" placeholder="Buscar">
                            <button class="btn-buscar" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <script>
                                const bf = document.querySelector("#buscador-form");
                                const bi = document.querySelector("#buscador");
                                bf.addEventListener("submit", (e) => {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    let url = bf.getAttribute("action");
                                    url += "&search=" + bi.value;
                                    window.location.href = url;
                                })
                            </script>
                        </form>
                    </div>
                    <div class="search-right">
                        <a href="?b=inventory&s=showAdd">
                            <button class="btn-agregar">
                                <i class="fa-solid fa-plus"></i> Agregar
                            </button>
                        </a>
                    </div>
                    <div class="search-right">
                        <a href="?b=inventory&s=newCategory">
                            <button class="btn-agregar">
                                <i class="fa-solid fa-plus"></i> Nueva Categoria
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-table1">
                <div class="table-wrapper">
                    <table class="table-container content-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>nombre del producto</th>
                                <th>descripcion</th>
                                <th>precio</th>
                                <th>precio venta</th>
                                <th>cantidad existente</th>
                                <th>categoria</th>
                                <th class="hide-on-small">nombre del distribuidor</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($productos) > 0) {
                                foreach ($productos as $e) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $e["idprod"] ?>
                                        </td>
                                        <td>
                                            <?= $e["nomprod"] ?>
                                        </td>
                                        <td>
                                            <?= $e["desprod"] ?>
                                        </td>

                                        <td>
                                            <?= $e["precprod"] ?>
                                        </td>
                                        <td>
                                            <?= $e["precvenprod"] ?>
                                        </td>
                                        <td>
                                            <?= $e["stockprod"] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $categoriaEncontrada = false;
                                            foreach ($categorias as $categoria) {
                                                if ($categoria['idcat'] == $e["catprod"]) {
                                                    echo $categoria['namecat'];
                                                    $categoriaEncontrada = true;
                                                    break;
                                                }
                                            }
                                            if (!$categoriaEncontrada) {
                                                echo "Sin categoría";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $proveedorEncontrado = false;
                                            foreach ($proveedores as $proveedor) {
                                                if ($proveedor['idprov'] == $e["idprov"]) {
                                                    echo $proveedor['nomprov'];
                                                    $proveedorEncontrado = true;
                                                    break;
                                                }
                                            }
                                            if (!$proveedorEncontrado) {
                                                echo "Sin proveedor";
                                            }
                                            ?>
                                        </td>
                                        <td><a href="?b=inventory&s=showEditar&idprod=<?= $e["idprod"] ?>"><button
                                                    class="btn-editar"><i class="fa-solid fa-pen"></i></button></a></td>

                                        <td><a><button class="btn-borrar" onclick="deleteProduct(this.id)"
                                                    id="<?= $e["idprod"] ?>"><i class="fa-solid fa-trash"></i></button></a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="11" style="text-align: center;">No hay elementos</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<!--  -->
<script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
<!--  -->
<script src="assets/Javascript/deleteProduct.js"></script>

</html>