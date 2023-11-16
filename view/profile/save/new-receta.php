<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Nueva Receta</h1>
                    <h3>La salud de tus mascotas es nuestra prioridad</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=saveReceta" method="POST">
                    <div class="input-container">
                        <label for="ctNomProv">Fecha</label>
                        <input type="text" value="<?= $_POST['date']; ?>" name="date" id="ctNomProv" class="input" autocomplete="off" readonly required>
                        <span>Fecha</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">DNI Veterinario</label>
                        <input type="text" value="<?= $value3['dniuser']; ?>" name="idcol" id="ctNomProv" class="input" autocomplete="off" readonly required>
                        <span>DNI Veterinario</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">DNI Usuario</label>
                        <input type="text" value="<?= $value['dniuser']; ?>" name="iduser" id="ctNomProv" class="input" autocomplete="off" readonly required>
                        <span>DNI Veterinario</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Mascota</label>
                        <input type="text" value="<?= $value2['nommas']; ?>" id="ctNomProv" class="input" autocomplete="off" readonly required>
                        <span>Mascota</span>
                        <input type="hidden" value="<?= $value2['idmas']; ?>" name="idmas" id="ctNomProv" class="input" autocomplete="off" readonly required>
                    </div>
                    <input type="hidden" value="<?= $_POST['nameprod']; ?>" name="products" required readonly>
                    <input type="hidden" value="<?= $_POST['cantprod']; ?>" name="cantprod" required readonly>
                    <input type="hidden" value="<?= $_POST['precprod']; ?>" name="prect" required readonly>
                    <?php
                        $caja1 = explode(",", $_POST['nameprod']);
                        $caja2 = explode(",", $_POST['cantprod']);
                        $r = new ProfileController(); 
                    ?>
                    <table>
                        <thead>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                        </thead>
                        <tbody>
                            <?php
                                for ($i=0; $i < count($caja1) ; $i++) { 
                                    $precio = $r->preVentProd(trim($caja1[$i]));
                                    $preciot = $r->calcPrecio(trim(intval($caja2[$i])), trim(intval($precio)));
                        echo "
                            <tr>
                                <td>".$caja1[$i]."</td>
                                <td>".$caja2[$i]."</td>
                                <td>".$precio."</td>
                                <td>".$preciot."</td>
                            </tr>";        
                                }    
                            ?>
                            <tr>
                                <th>Total:</th>
                                <td colspan="3"><input type="number" name="preciot" value="<?= $_POST['precprod'] ?>" readonly required></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="input-container">
                        <label for="ctNomProv">Receta</label>
                        <textarea name="receta" id="ctNomProv" class="input" autocomplete="off" readonly required><?= $_POST['receta']; ?></textarea>
                        <span>Receta</span>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="btnEditar" value="Guardar" class="btn-save btn">
                        <a href="?b=profile&s=Inicio" class="btn-regresar btn">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="assets/Javascript/edit-and-save.js"></script>