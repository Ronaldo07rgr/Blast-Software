
        <main>
            <div>
                <div>
                    <h1>¿Olvidaste contraseña?</h1>
                    <h3>Por favor introduce tu mueva contraseña la cual debe contener los siguientes parametros: mayusculas, minuscualas, numeros y el numero minimo de caracteres es de 8.</h3>
                </div>
                <div>
                    <div>
                        <form action="?b=restorepassword&s=sendEmail" method="POST">
                            <label for="#">Contraseña</label>
                            <div class="input">
                                <i class="fa-solid fa-shield"></i>
                                <input type="pasword" name="ctUser" placeholder="User" id="input" required>
                            </div>

                            <label for="#">Confirmar contraseña</label>
                            <div class="input">
                                <i class="fa-solid fa-shield"></i>
                                <input type="pasword" name="ctEmail" placeholder="Correo" id="input" required>
                            </div>
                            <input type="submit" id="enviar-btn" value="Confirmar contraseña">
                        </form>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="main-footer"></div>
                <div class="modal" style="display: none;">
                    <p>Gracias por tu mensaje.</p>
                    <button class="close" id="close">Volver</button>
                </div>
                <div class="opacidad" style="display: none;"></div>
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