<body>
    <div class="returm">
        <a href="?b=index"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="container">

        <div class="container1">
            <div>
                <div>
                    <img src="assets/img/logo-removebg.png" alt="">
                    <p>Animal world</p>
                </div>
                <div>
                    <h1>Iniciar sesión</h1>
                </div>
            </div>
            <div>
                <script>
                function validarForm() {
                    let user = document.getElementById('ctUser').value;
                    let pass = document.getElementById('ctPass').value;

                    if (user == "" || pass == "") {
                        setNotify("error", "Complete todos los campos");
                        return false;
                    }
                }
                </script>
                <form action="?b=login&s=validarUser" method="post" onsubmit="return validarForm()">
                    <div class="divForm">
                        <label for="ctUser">Usuario</label>
                        <div class="input">
                            <i class="fa-solid fa-paw" id="icono"></i>
                            <input type="text" placeholder="User" id="ctUser" name="ctUser" required>
                        </div>
                    </div class="divForm">
                    <div>
                        <label for="ctPass">Contraseña</label>
                        <div class="input">
                            <i class="fa-solid fa-lock" id="icono"></i>
                            <input type="password" placeholder="Password" id="ctPass" name="ctPassword" required>
                        </div>
                    </div>
                    <div>
                        <p> Terminos y condiciones <a id="window-up" href="#">Mas información</a></p>
                    </div>
                    <button name="submit">Ingresar</button>
                </form>

            </div>
            <div>
                <a href="?b=restorepassword" id="a1">¿Olvidaste tu contraseña?</a>
                <a href="?b=newaccount" id="a2">Crear cuenta</a>
            </div>
        </div>
        <div class="container2">
            <img src="assets/img/principalLogin.png" alt="">
        </div>
    </div>

    <div id="window">
        <div class="container-window">
            <i id="exit-window" class="fa-solid fa-xmark"></i>
            <h1>Terminos y Condiciones</h1>
            <p>La veterinaria Animal World recopilara la información conforme a lo señalado por la Ley 1712 de 2014 en
                lo relacionado con información reservada y clasificada. Es posible que la información que recopilamos en
                nuestro sitio web (por ejemplo: el nombres, las búsquedas realizadas, las páginas visitadas y la
                duración de la sesión del usuario) se combinen para analizar estadísticamente el tráfico y nivel de
                utilización del sitio web. Esta información se recopila para mejorar el rendimiento de nuestras
                plataformas.
                <br><br>
                En aquellos casos en los cuales el Ciudadano-Usuario publique libre y voluntariamente en el sitio web
                cualquier información adicional a la solicitada que tenga el carácter de clasificada, se entenderá que
                ha consentido la revelación de esta en los términos señalados en el artículo 18 de la Ley 1712 de 2014.
                En el mismo sentido, si la información que sea publicada por la entidad es sujeta a reserva o
                clasificada, los usuarios deberán hacer las reclamaciones respectivas ante el sitio en los términos
                señalados en la Ley 1712 de 2014.
            </p>
        </div>
    </div>


    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous">
    </script>
    <!-- Pop-up Window -->
    <script src="assets/Javascript/popup-window.js"></script>

</body>

</html>