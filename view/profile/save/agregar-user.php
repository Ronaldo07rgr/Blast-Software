<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Agregar <?php echo (isset($_REQUEST['p'])) ? $_REQUEST['p'] : "Sin Definir" ?></h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=saveUser&p=<?= $_REQUEST['p'] ?>" method="POST">
                    <div class="input-container">
                        <label for="numid">Numero de Identificación</label>
                        <input type="number" name="numid" id="numid" class="input" autocomplete="off" required>
                        <span>Numero de Identificación &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Nombres</label>
                        <input type="text" name="name" id="ctNomProv" class="input" autocomplete="off" required>
                        <span>Nombres</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Apellidos</label>
                        <input type="text" name="surname" id="ctNomProv" class="input" autocomplete="off" required>
                        <span>Apellidos</span>
                    </div>
                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="input" autocomplete="off" required>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <label for="email">Nickname</label>
                        <input type="text" name="nick" id="email" class="input" autocomplete="off" required>
                        <span>Nickname &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="email" class="input" autocomplete="off" required>
                        <span>Contraseña</span>
                    </div>
                        <p class="verifyPass">Longitud minima de 8 caracterres</p>
                        <p class="verifyPass">Debe contener minimo una letra mayuscula</p>
                        <p class="verifyPass">Debe contener minimo una letra minuscula</p>
                        <p class="verifyPass">Debe contener minimo una numero</p>
                    <div class="input-container">
                        <label for="pass">Confirmar Contraseña</label>
                        <input type="password" name="pass2" id="email" class="input" autocomplete="off" required>
                        <span>Confirmar Contraseña &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctDirProv">Dirección</label>
                        <input type="text" name="addres" id="ctDirProv" class="input" autocomplete="off" required>
                        <span>Dirección</span>
                    </div>
                    <div class="input-container">
                        <label for="zone">Zona</label>
                        <select name="zone" class="input" id="zone">
                            <option disabled selected>Seleccione una opcion</option>
                            <option value="urbana">Urbana</option>
                            <option value="rural">Rural</option>
                        </select>
                        <span>Zona</span>
                    </div>
                    <div class="input-container">
                        <label for="ctTelProv">Teléfono</label>
                        <input type="number" name="phone" id="ctTelProv" class="input" autocomplete="off" required>
                        <span>Teléfono</span>
                    </div>
                    <div class="input-container">
                        <label for="phone2">Teléfono 2</label>
                        <input type="number" name="phone2" id="phone2" class="input" autocomplete="off">
                        <span>Teléfono 2</span>
                    </div>
                    <?php 
                        if($_REQUEST['p'] == "Colaborador"){
                            echo "
                            <div class='input-container'>
                                <label for='selRolUser'>Rol</label>
                                <select class='input' name='rol' id='rol'>
                                    <option selected disabled>seleccione un rol</option>
                                    <option value='veterinario'>Veterinario(a)</option>
                                    <option value='recepcionista'>Recepcionista</option>
                                </select>
                                <span>Rol</span>
                            </div>      
                            "; 
                        }else{
                            echo "
                            <div class='input-container'>
                                <label for='selrolUser'>Rol</label>
                                <select class='input' name='rol' id='selRolUser'>
                                <option selected disabled>Seleccione una opcion</option>
                                    <option value='cliente'>Cliente</option>
                                </select>
                                <span>Rol</span>
                            </div>      
                            ";
                        }
                    ?>
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