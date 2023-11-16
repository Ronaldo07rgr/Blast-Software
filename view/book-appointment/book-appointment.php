
        <main>
            <div class="header-services">
                <h1>¡No podemos esperar a verte!</h1>
            </div>
            <div class="container-services">
                <div class="container-service">
                    <div>
                        <h1>Citas</h1>
                        <div class="circle-icon"><i class="fa-regular fa-calendar-check"></i></div>
                    </div>
                    <div>
                        <p>En nuestra clínica veterinaria, brindamos atención experta a tus mascotas. Consultas dedicadas y cuidado de calidad garantizado. Precios accesibles desde $25.000 pesos. Confía en nosotros para el bienestar de tu compañero peludo.</p>
                    </div>
                    <div>
                        <button <?php echo (isset($_SESSION['usuario']) ? 'onclick="mostrarForm()"' : 'onclick="errorAlert()"');?> >Agendar Cita</button>
                    </div>
                </div>
                <div class="container-service">
                    <div>
                        <h1>Cirugia</h1>
                        <div class="circle-icon"><i class="fa-solid fa-syringe"></i></div>
                    </div>
                    <div>
                        <p>Nuestro servicio de cirugía garantiza procedimientos expertos y seguros, respaldados por profesionales altamente calificados. Obtén resultados excepcionales y recupera tu bienestar a través de nuestras soluciones médicas confiables.</p>
                    </div>
                    <div>
                        <button <?php echo (isset($_SESSION['usuario']) ? 'onclick="mostrarForm()"' : 'onclick="errorAlert()"');?> >Agendar Cirugia</button>
                    </div>
                </div>
                <div class="container-service">
                    <div>
                        <h1>Laboratorio</h1>
                        <div class="circle-icon"><i class="fa-solid fa-flask"></i></div>
                    </div>
                    <div>
                        <p>Nuestro servicio de laboratorio en la veterinaria ofrece análisis rápidos y precisos en menos de 3 días. Por tan solo $50.000 pesos, obtén diagnósticos confiables para cuidar de tu mascota.</p>
                    </div>
                    <div>
                        <button <?php echo (isset($_SESSION['usuario']) ? 'onclick="mostrarForm()"' : 'onclick="errorAlert()"');?> >Agendar Examenes</button>
                    </div>
                </div>
                <div class="container-service">
                    <div>
                        <h1>Radiografia</h1>
                        <div class="circle-icon"><i class="fa-solid fa-x-ray"></i></div>
                    </div>
                    <div>
                        <p>En nuestra veterinaria, proporcionamos servicios de radiografía a tan solo $150.000 pesos. Obtén diagnósticos precisos en menos de 4 días para el bienestar rápido y seguro de tu adorado compañero.</p>
                    </div>
                    <div>
                        <button <?php echo (isset($_SESSION['usuario']) ? 'onclick="mostrarForm()"' : 'onclick="errorAlert()"');?> >Agendar Radiografia</button>
                    </div>
                </div>
            </div>
        </main>
        <div class="formService" id="formService">
            <i onclick="ocultarForm()" class="fa-solid fa-xmark"></i>
            <h1>Agendamiento de Servicios</h1>
            <div class="form">
                <p>Recuerde que para solicitar los servicios debe encontrase registrado y tener mascotas registradas</p>
                <form action="?b=bookappointment&s=appointmentRequest" method="post">
                    <div class="container-form-service">
                        <div>
                            <h2>Datos de Usuario</h2>
                            
                            <div class="input-container">
                                <label class="tex">Numero de documento</label>    
                                <input type="number" name="numid" class="input" autocomplete="off">
                                <span>Numero de documento &nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="input-container">
                                <label class="tex">Nombre</label>
                                <input type="text" name="name" class="input" autocomplete="off">
                                <span>Direccion</span>
                            </div>
                            <div class="input-container">
                                <label class="tex">Direccion</label>
                                <input type="text" name="addres" class="input" autocomplete="off">
                                <span>Direccion</span>
                            </div>
                            <div class="input-container">
                                <label class="tex">Numero de Telefono</label>
                                <input type="number" name="phone" class="input" autocomplete="off">
                                <span>Numero de Telefono&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="input-container">
                                <label class="tex">Email</label>
                                <input type="email" name="email" class="input" autocomplete="off">
                                <span>Email </span>
                            </div>
                        </div>
                        <div>
                            <h2>Datos de Mascota</h2>
                            <div class="input-container">
                                <label class="tex" for="">Nombre </label>
                                <input type="text" name="namepet" class="input">
                                <span>Nombre</span>
                            </div>
                            <div class="input-container">
                                <label for="">Genero </label>
                                <select name="genpet" class="input">
                                    <option selected disabled>Seleccione una opcion</option>    
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                                <span>Genero</span>
                            </div>
                            <div class="input-container">
                                <label class="tex">Especie</label>
                                <select name="esppet" class="input">
                                    <option selected disabled>Seleccione una opcion</option>
                                    <option value="canino">Canino</option>
                                    <option value="felino">Felino</option>
                                    <option value="equino">Equino</option>
                                    <option value="bovino">Bovino</option>
                                    <option value="porcino">Porcino</option>
                                    <option value="ave">Ave</option>
                                    <option value="otro">Otro...</option>
                                </select>
                                <span>Especie</span>
                            </div>
                            <div class="input-container">
                                <label>Motivo de solicitud</label>
                                <textarea name="motive" class="input" cols="40" rows="1"></textarea>
                                <span>Motivo de solicitud&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="input-container">
                                <label>Tipo de Servicio</label>
                                <select name="service" class="input">
                                    <option selected disabled>Seleccione una opcion</option>
                                    <option value="cita">Cita General</option>
                                    <option value="laboratorio">Examenes de laboratorio</option>
                                    <option value="cirugia">Cirugia</option>
                                    <option value="radiografia">Radiografia</option>
                                </select>
                                <span>Tipo de Servicio&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="submit" value="Solicitar Servicio">
                    </div>  
                    
                </form>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
    <!-- Menu -->
    <script src="assets/Javascript/menu.js"></script>
    <!-- Form Services -->
    <script src="assets/Javascript/services.js"></script>
    <!-- Form Inputs -->
    <script src="assets/Javascript/edit-and-save.js"></script>
    <!-- Form Visible -->
    <script src="assets/Javascript/FormAppointments.js"></script>
    <!-- Form Visible -->
    <script src="assets/Javascript/deleteProduct.js"></script>
</body>
</html>