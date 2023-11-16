<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Agregar Mascota</h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=saveMascota" method="POST">
                    <div class="input-container">
                        <label for="ctNomProv">Nombre</label>
                        <input type="text" name="name" id="ctNomProv" class="input" autocomplete="off" required>
                        <span>Nombre</span>
                    </div>
                    <div class="input-container">
                        <label for="ctDirProv">Edad </label>
                        <input type="text" name="age" id="ctDirProv" class="input" required autocomplete="off">
                        <span>Edad &nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctEmaProv">Genero</label>
                        <select name="gen" class="input" required>
                            <option selected disabled>Seleccione una opcion</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                        <span>Genero&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctEmaProv">Especie</label>
                        <select name="esp" class="input" required>
                            <option selected disabled>Seleccione una opcion</option></option>
                            <option value="canino">Canino</option>
                            <option value="felino">Felino</option>
                            <option value="bovino">Bovino</option>
                            <option value="equino">Equino</option>
                            <option value="porcino">Porcino</option>
                            <option value="ave">Ave</option>
                        </select>
                        <span>Especie&nbsp;&nbsp;</span>
                    </div>
                    <?php
                        if ($privilegios == Privilegios::User->get()) {
                            $ownerName = '';
                            $id = ''; 
                            foreach ($userdata as $owner) {
                                $ownerName .= $owner['nameuser'] . " " . $owner['surnameuser'];
                                $id .= $owner['iduser'];
                            }
                            echo '
                            <div class="input-container">
                                <label for="ctTelProv">Porpietario</label>
                                <input readonly type="text" class="input" value="' . $ownerName . '">
                                <input readonly type="hidden" name="owner" class="input" value="' . $id . '">
                                <span>Porpietario&nbsp;&nbsp;</span>
                            </div>';
                        } else {
                            echo '
                            <div class="input-container">
                                <label for="ctTelProv">Porpietario</label>
                                <select name="owner" class="input" required>
                                    <option disabled selected>Seleccione una opcion</option>';

                            foreach ($dueños as $value) {
                                if ($value['privileges'] == Privilegios::User->get()) {
                                    echo "<option value=" . $value['iduser'] . " >" . $value['nameuser'] . " " . $value['surnameuser'] . "</option>";
                                }
                            }

                            echo '</select>
                                <span>Porpietario&nbsp;&nbsp;</span>
                            </div>';
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