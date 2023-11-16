<body>
    <div class="container-background">
        <div class="container-form">
            <h2>Crear cuenta</h2>
            <form id="myForm" action="?b=newaccount&s=GuardarUser" method="POST">
                <div id="parent-container-form-user">
                    <div class="NameandLastname">
                        <div class="input-container">
                            <label>Nombre <strong>*</strong></label>
                            <input type="text" name="ctNombre" required id="input-obligatorio">
                        </div>

                        <div class="input-container">
                            <label>Apellido <strong>*</strong></label>
                            <input type="text" name="ctApellido" required id="input-obligatorio">
                        </div>
                    </div>
                    <label>Numero de Identificacion <strong>*</strong></label>
                    <input type="number" name="ctNumId" required id="input-obligatorio">
                    <label>Email <strong>*</strong></label>
                    <input type="email" name="ctEmail" required id="input-obligatorio">
                    <label>Confirmar Email <strong>*</strong></label>
                    <input type="email" name="ctEmailC" required id="input-obligatorio">
                    <label>Nickname <strong>*</strong></label>
                    <input type="text" name="ctNick" required id="input-obligatorio">
                    <label>Contraseña <strong>*</strong></label>
                    <input type="password" name="ctPass" required id="input-obligatorio">
                    <p class="verifyPass">
                        Longitud minima de 8 caracteres <br>
                        Debe contener por lo menos una letra mayuscula <br>
                        Debe contener por lo menos una letra minuscula <br>
                        Debe contener por lo menos un numero <br>
                    </p>
                    <br><br>
                    <label>Dirección de residencia <strong>*</strong></label>
                    <input type="text" name="ctAddres" required id="input-obligatorio">

                    <label for="location">Tipo de ubicación <strong>*</strong></label>
                    <select type="select" name="selTipoUbicacion" required id="input-obligatorio">
                        <option selected disabled>Selectiona el tipo de ubicación</option>
                        <option value="rural" >Rural</option>
                        <option value="urbana">Urbana</option>
                    </select>
                    <div class="numbers">
                        <div class="input-container">
                            <label>Numero de celular <strong>*</strong></label>
                            <input type="number" name="ctTel" required id="input-obligatorio">
                        </div>

                        <div class="input-container">
                            <label>Numero de celular 2</label>
                            <input type="number" name="ctTel2">
                        </div>
                    </div>
                    <div class="input-check">
                        <input type="checkbox" name="conditions" value="true" required><p> Terminos y condiciones <a id="window-up" href="#">Mas Información</a></p>
                    </div>
                    <div id="window">
                        <div class="container-window">
                            <i id="exit-window" class="fa-solid fa-xmark"></i>
                            <h1>Terminos y Condiciones</h1>
                            <p>La veterinaria Animal World recopilara la información conforme a lo señalado por la Ley 1712 de 2014 en lo relacionado con información reservada y clasificada. Es posible que la información que recopilamos en nuestro sitio web (por ejemplo: el nombres, las búsquedas realizadas, las páginas visitadas y la duración de la sesión del usuario) se combinen para analizar estadísticamente el tráfico y nivel de utilización del sitio web. Esta información se recopila para mejorar el rendimiento de nuestras plataformas.
                            <br><br>
                            En aquellos casos en los cuales el Ciudadano-Usuario publique libre y voluntariamente en el sitio web cualquier información adicional a la solicitada que tenga el carácter de clasificada, se entenderá que ha consentido la revelación de esta en los términos señalados en el artículo 18 de la Ley 1712 de 2014. En el mismo sentido, si la información que sea publicada por la entidad es sujeta a reserva o clasificada, los usuarios deberán hacer las reclamaciones respectivas ante el sitio en los términos señalados en la Ley 1712 de 2014.</p>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="buttons-container">
                            <div class="return">
                                <a href="?b=login">
                                    <span class="button">Volver</span>
                                </a>
                            </div>
                            <input type="submit" value="Siguiente" class="nextpet">
                        </div>
                        <div class="nextpet">
                            <a href="?b=index">
                                <span class="button">Salir</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                        if(empty($_REQUEST['p'])) {
                        } else {
                            echo ($_REQUEST['p'] == "ifalse") ? "Complete todos los campos con el (*)" : ""; 
                        }
                    ?>
            </form>
        </div>
    </div>
    <script src="assets/Javascript/New-Account.js"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
        <!-- Pop-up Window -->
        <script src="assets/Javascript/popup-window.js"></script>

</body>

</html>