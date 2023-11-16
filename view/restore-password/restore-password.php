
        <main>
            <div>
                <div>
                    <h1>¿Olvidaste contraseña?</h1>
                    <h3>Por favor introduce tu usuario y dirección de correo electrónico para recibir un codigo de
                        restablecimiento de contraseña. Si no recuerda su usuario y/o correo electronico, comuniquese con el administrador.</h3>
                </div>
                <div>
                    <div>
                        <form action="?b=restorepassword&s=sendEmail" method="POST">
                            <label for="#">Nombre de usuario</label>
                            <div class="input">
                                <i class="fa-solid fa-paw" id="icono"></i>
                                <input type="text" name="ctUser" placeholder="User" id="input" required>
                            </div>

                            <label for="#">Correo
                                electrónico</label>
                            <div class="input">
                                <i class="fa-solid fa-envelope" id="icono"></i>
                                <input type="email" name="ctEmail" placeholder="Correo" id="input" required>
                            </div>
                            <input type="submit" id="enviar-btn" value="Enviar Correo">
                        </form>
                    </div>
                    <div>
                    </div>
                </div>
            </div>

        </main>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
    <!-- Menu -->
    <script src="assets/Javascript/menu.js"></script>
    <!-- Accordion -->
    <script src="assets/Javascript/accordion.js"></script>
</body>

</html>