<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Editar Mascotas</h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=updateMascota&p=mascota&id=<?= $mascota['idmas']; ?>" method="POST">
                    <div class="input-container">
                        <label class="tex" for="">Nombre</label>
                        <input type="text" name="name" id="Nommas" class="input"
                            value="<?= $mascota["nommas"] ?? "No definido" ?>">
                        <span>Nombre</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Edad</label>
                        <input type="text" name="age" id="edadmas" class="input"
                            value="<?= $mascota["edadmas"] ?? "No definido" ?>">
                        <span>edad</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Género</label>
                        <select name="gen" id="genmas" class="input">
                            <option <?php echo ($mascota['genmas'] !== "Macho" && $mascota['genmas'] !== "Hembra") ? "selected" : "" ?> disabled>Seleccione una opcion</option>
                            <option <?php echo ($mascota['genmas'] == "Macho") ? "selected" : "" ?> value="Macho">Macho</option>
                            <option <?php echo ($mascota['genmas'] == "Hembra") ? "selected" : "" ?> value="Hembra">Hembra</option>
                        </select>
                        <span>Género</span>
                    </div>
                    <div class="input-container">
                        <label class="tex" for="">Especie</label>
                        <select name="esp" id="espmas" class="input">
                            <option <?php echo ($mascota['espmas'] == "canino") ? "selected" : "" ?> value="canino">Canino</option>
                            <option <?php echo ($mascota['espmas'] == "felino") ? "selected" : "" ?> value="felino">Felino</option>
                            <option <?php echo ($mascota['espmas'] == "bovino") ? "selected" : "" ?> value="bovino">Bovino</option>
                            <option <?php echo ($mascota['espmas'] == "equino") ? "selected" : "" ?> value="equino">Equino</option>
                            <option <?php echo ($mascota['espmas'] == "porcino") ? "selected" : "" ?> value="porcino">Porcino</option>
                            <option <?php echo ($mascota['espmas'] == "ave") ? "selected" : "" ?> value="ave">Ave</option>
                        </select>
                        <span>Especie</span>
                    </div>

                    <div class="buttons">
                        <input type="submit" name="btnEditar" value="Guardar" class="btn-save btn">
                        <a href="?b=profile&s=Inicio&p=admin" class="btn-regresar btn">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="assets/Javascript/edit-and-save.js"></script>

</html>