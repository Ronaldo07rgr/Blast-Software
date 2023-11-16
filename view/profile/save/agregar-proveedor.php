<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Agregar Proveedor</h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=saveProveedor" method="POST">
                    <div class="input-container">
                        <label for="ctNomProv">Nombre</label>
                        <input type="text" name="name" id="ctNomProv" class="input" autocomplete="off">
                        <span>Nombre</span>
                    </div>
                    <div class="input-container">
                        <label for="ctDirProv">Dirección</label>
                        <input type="text" name="addres" id="ctDirProv" class="input" autocomplete="off">
                        <span>Dirección</span>
                    </div>
                    <div class="input-container">
                        <label for="ctEmaProv">E-mail</label>
                        <input type="email" name="email" id="ctEmaProv" class="input" autocomplete="off">
                        <span>E-mail</span>
                    </div>
                    <div class="input-container">
                        <label for="ctTelProv">Teléfono</label>
                        <input type="number" name="phone" id="ctTelProv" class="input" autocomplete="off">
                        <span>Teléfono</span>
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