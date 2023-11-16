<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Editar <?php echo (isset($_REQUEST['p'])) ? $_REQUEST['p'] : "" ?></h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=updateUser&p=Colaborador&nickname=<?= $colaborador['nickuser'] ?>&iduser=<?= $colaborador['dniuser']?>&id=<?= $colaborador['iduser']?>"
                    method="POST">
                    <div class="input-container">
                        <label class="tex" for="dni">Numero de Identificacion</label>
                        <input type="text" name="numid" id="dni" class="input" value="<?= $colaborador["dniuser"] ?? "No definido" ?>" required>
                        <span>Numero de Identificacion &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Nombres</label>
                        <input type="text" name="name" id="Nomcol" class="input" value="<?= $colaborador["nameuser"] ?? "No definido" ?>" required>
                        <span>Nombres</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Apellidos</label>
                        <input type="text" name="surname" id="Nomcol" class="input" value="<?= $colaborador["surnameuser"] ?? "No definido" ?>" required>
                        <span>Apellidos &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Nickname</label>
                        <input type="text" name="nick" id="Nomcol" class="input"
                            value="<?= $colaborador["nickuser"] ?? "No definido" ?>" required>
                        <span>Apellidos &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">E-mail</label>
                        <input type="email" name="email" id="emacol" class="input"
                            value="<?= $colaborador["emailuser"] ?? "No definido" ?>" required>
                        <span>E-mail</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Direccion</label>
                        <input type="text" name="addres" id="dircol" class="input" value="<?= $colaborador["diruser"] ?? "No definido" ?>" required>
                        <span>Direccion</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Zona</label>
                        <select name="zone" class="input">
                        <option disabled <?php echo ($colaborador['zoneuser'] <> "urbana" || $colaborador['zoneuser'] <> "rural") ? "selected" : "" ?>>Seleccione una opcion</option>
                        <option <?php echo ($colaborador['zoneuser'] == "urbana") ? "selected" : "" ?> value="urbana">Urbana</option>
                        <option <?php echo ($colaborador['zoneuser'] == "rural") ? "selected" : "" ?> value="rural">Rural</option>
                        </select>
                        <span>Zona</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Telefono</label>
                        <input type="number" name="phone" id="telcol" class="input"
                            value="<?= $colaborador["phoneuser"] ?? "00000000000" ?>" required>
                        <span>Telefono</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Telefono 2</label>
                        <input type="number" name="phone2" id="telcol" class="input"
                            value="<?= $colaborador["phonealtuser"] ?? "00000000000" ?>" >
                        <span>Telefono 2 &nbsp;&nbsp;</span>
                    </div>
                    <?php
                        if($_REQUEST['p'] == "Colaborador"){
                            echo '
                                <div class="input-container focus">
                                    <label class="tex" for="rolcol">Rol</label>
                                    <select name="rolcol" id="rolcol" class="input">
                                        <option disabled ' . (($colaborador['privileges'] !== Privilegios::Recepcionist->get() && $colaborador['privileges'] !== Privilegios::Doctor->get()) ? "selected" : "") . '>Seleccione Una Opción</option>
                                        <option ' . (($colaborador['privileges'] === Privilegios::Recepcionist->get()) ? "selected" : "") . ' value="' . Privilegios::Recepcionist->get() . '">Recepcionista</option>
                                        <option ' . (($colaborador['privileges'] === Privilegios::Doctor->get()) ? "selected" : "") . ' value="' . Privilegios::Doctor->get() . '">Veterinario(a)</option>
                                    </select>
                                    <span>Rol</span>
                                </div>
                            ';
                        }else{
                            echo '
                                <div class="input-container focus">
                                    <label class="tex" for="rolcol">Rol</label>
                                    <select name="rolcol" id="rolcol" class="input">
                                        <option disabled ' . (($colaborador['privileges'] !== Privilegios::User->get() ) ? "selected" : "") . '>Seleccione Una opción</option>
                                        <option ' . (($colaborador['privileges'] === Privilegios::User->get()) ? "selected" : "") . ' value="' . Privilegios::User->get() . '">Cliente</option>
                                    </select>
                                    <span>Rol</span>
                                </div>
                            ';
                        }
                    ?>
                    <div class="buttons">
                        <input type="submit" name="btnUpdateProfile" value="Guardar" class="btn-save btn">
                        <a href="?b=profile&s=Inicio" class="btn-regresar btn">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="assets/Javascript/edit-and-save.js"></script>

</html>