<body>
    <div class="container">
        <div class="edit">
            <div class="header">
                <div class="logo">
                    <img src="assets/img/logo-removebg.png" alt="Animal World">
                </div>
                <div class="informacion-title">
                    <h1>Asignar Cita</h1>
                    <h3>Tu información es importante</h3>
                </div>
            </div>
            <div class="form">
                <form action="?b=profile&s=assigAppointment" method="POST">
                <input type="hidden" name="idcit" value="<?= $_POST['idcit'] ?>" >
                <div class="input-container">
                        <label for="ctNomProv">Numero de Documento</label>
                        <input type="text" name="dniuser" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['dniusercit'] ?? "No definido" ?>" required disabled>
                        <span>Numero de Documento&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Nombre</label>
                        <input type="text" name="genmas" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['nameusercit'] ?? "No definido" ?>" required disabled>
                        <span>Nombre</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Direccion</label>
                        <input type="text" name="addres" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['addresusercit'] ?? "No definido" ?>" required disabled>
                        <span>Direccion</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Numero de Telefono</label>
                        <input type="text" name="phone" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['phoneusercit'] ?? "No definido" ?>" required disabled>
                        <span>Numero de Telefono&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Email</label>
                        <input type="text" name="email" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['emailusercit'] ?? "No definido" ?>" required disabled>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Nombre de la Mascota</label>
                        <input type="text" name="namemas" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['namemascit'] ?? "No definido" ?>" required disabled>
                        <span>Nombre de la Mascota&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Especie de la Mascota</label>
                        <input type="text" name="espmas" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['espmascit'] ?? "No definido" ?>" required disabled>
                        <span>Especie de la Mascota&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Genero de la Mascota</label>
                        <input type="text" name="genero" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['genmascit'] ?? "No definido" ?>" required disabled>
                        <span>Genero de la Mascota&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Motivo </label>
                        <input type="text" name="motive" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['motcit'] ?? "No definido" ?>" required disabled>
                        <span>Motivo</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Servicio Solicitado</label>
                        <input type="text" name="service" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['servicecit'] ?? "No definido" ?>" required disabled>
                        <span>Servicio Solicitado&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Fecha de Creacion de Solicitud</label>
                        <input type="date" name="datesol" id="ctNomProv" class="input" autocomplete="off" value="<?= $cliente['datesolcit'] ?? "No definido" ?>" required disabled>
                        <span>Fecha de Creacion de Solictud&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <div class="input-container">
                        <label for="ctNomProv">Fecha de Asigancion de Cita </label>
                        <input type="date" name="dateasig" id="ctNomProv" class="input" autocomplete="off" value="<?= $_POST['dateasig'] ?? "No definido" ?>" required readonly>
                        <span>Fecha de Asignacion de Cita&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <?php
                        $horasDis = ["07:00:00","07:30:00", "08:00:00", "08:30:00", "09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00", "13:00:00", "13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00", "16:00:00", "16:30:00"];

                        if(empty($horas)){
                            echo "<div class='input-container'>";
                            echo "<label>Asignar hora</label>";
                            echo "<select name='selhour' class='input'>
                                <option selected disabled>Seleccione una opcion</option>"; 
                            
                            foreach ($horasDis as $hora) {
                                echo "<option value='$hora'>$hora</option>"; 
                            }
                            
                            echo "</select>";
                            echo "<span>Asignar Hora</span>"; 
                            echo "</div>"; 
                        } else {
                            echo "<div class='input-container'>"; 
                            echo "<label>Asignar hora</label>"; 
                            echo "<select name='selhour' class='input'>
                                <option selected disabled>Seleccione una opcion</option>"; 
                            
                            foreach ($horasDis as $hora) {
                                if (!in_array($hora, $horas)) {
                                    echo "<option value='$hora'>$hora</option>"; 
                                }
                            }
                            
                            echo "</select>";
                            echo "<span>Asignar Hora</span>"; 
                            echo "</div>"; 
                        }
                    ?>

                    <div class="input-container">
                        <label for="selcol">Persona asiganada</label>
                        <select name="selcol" class="input">

                            <?php
                                foreach ($colaborador as $value) {
                                    if($value['privileges'] == Privilegios::Doctor->get()){
                                        echo ($value['iduser'] == $_POST['selcol']) ? "<option value=".$value['iduser'].">".$value['nameuser']." ".$value['surnameuser']."</option>" : "<option disabled>No encontrado</option>"; 
                                    }
                                }
                            ?>
                        </select>
                        <span>Persona asignada</span>
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