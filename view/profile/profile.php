<body>
    <div class="container-sm">
        <div class="header">
            <a href="?b=index&s=Inicio&p=admin"><i class="fa-solid fa-arrow-left"></i></a>
            <div>
                <a href="?b=restorepassword&s=Inicio"><i class="fa-solid fa-key"></i><span>Cambiar contraseña</span></a>
                <a onclick="destroySession()"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar
                        Sesion</span></a>
            </div>
        </div>
        <main style="display: block">
            <div class="container-left">
                <div class="left">
                    <button class="user-data">
                        <img src="assets/img/usuario.png" alt="">
                        <div>
                            <p>
                                <?php echo $user['nameuser'] . " " . $user['surnameuser']; ?>
                            </p>
                            <p>
                                <?php echo ($privilegios === $privUser) ? 'Cliente' : (($privilegios === $privRecepcionist) ? 'Recepcionista' : (($privilegios === $privDoctor) ? 'Doctor' : (($privilegios === $privAdmin) ? 'Administrador' : 'Indefinido'))); ?>
                            </p>

                        </div>
                    </button>
                    <button class="profile-adm-btn"><i class="fa-solid fa-house-user"></i>
                        <p>Inicio</p>
                    </button>
                    <button class="profile-adm-btn"><i class="fa-solid fa-user-pen"></i>
                        <p style="white-space: nowrap">Datos del usuario</p>
                    </button>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<a href='?b=inventory&s=Inicio'><button><i class='fa-solid fa-boxes-stacked'></i><p>Inventarios</p></button></a>" ?>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-users'></i><p>Proveedores</p></button>" ?>
                    <?php echo ($privilegios <> $privAdmin) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-user-gear'></i><p>Colaboradores</p></button>" ?>
                    <?php echo ($privilegios == $privUser) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-person-circle-check'></i><p>Clientes</p></button>" ?>
                    <button class="profile-adm-btn"><i class="fa-solid fa-dog"></i>
                        <p>Mascotas</p>
                    </button>
                    <?php echo ($privilegios == $privUser || $privilegios == $privRecepcionist) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-syringe'></i><p>Recetar</p></button>" ?>
                    <?php echo ($privilegios == $privAdmin || $privilegios == $privRecepcionist || $privilegios == $privUser) ? "<button class='profile-adm-btn'><i class='fa-regular fa-calendar-check'></i><p>Citas</p></button>" : "" ?>
                    <?php echo ($privilegios == $privUser || $privilegios == $privRecepcionist) ? "" : "<button class='profile-adm-btn'><i class='fa-solid fa-clipboard-list'></i><p>Listado Recetas</p></button>" ?>
                </div>
            </div>
            <div class="container-right">
                <div class="profile-adm welcome" id="container-right">
                    <h1>Bienvenido(a) al panel de
                        <?php echo ($privilegios === $privUser) ? 'Cliente' : (($privilegios === $privRecepcionist) ? 'Recepcionista' : (($privilegios === $privDoctor) ? 'Doctor' : (($privilegios === $privAdmin) ? 'Administrador' : 'Indefinido'))); ?>
                    </h1>
                    <p>Dirijase al menu lateral para poder navegar dentro del sitio. </p>
                    <i class="fa-solid fa-face-smile-beam"></i>
                </div>
                <div class="profile-adm container-right user" id="container-right2">
                    <div class="user-information">
                        <h1>Datos</h1>
                        <form id="form-user-information" action="?b=profile&s=updateUser&id=<?= $user['iduser'] ?>"
                            method="post">
                            <label for="name">Numero de identificacion*</label>
                            <input name="numid" type="number" value="<?php echo $user['dniuser'] ?>" disabled>
                            <label for="name">Nombres*</label>
                            <input type="text" name="name" id="ctNameUser"
                                value="<?php echo $user['nameuser'] ?? "Sin definir"; ?>" disabled>
                            <label for="surname">Apellidos *</label>
                            <input type="text" name="surname" id="ctSurNameUser"
                                value="<?php echo $user['surnameuser'] ?? "Sin definir"; ?>" disabled>
                            <input type="hidden" name="nick" id="ctSurNameUser"
                                value="<?php echo $user['nickuser'] ?? "Sin definir"; ?>" disabled>
                            <label for="address">Direccion *</label>
                            <input type="text" name="addres" id="ctAdrUser" value="<?php echo $user['diruser']; ?>"
                                disabled>
                            <label for="zone">Zona: *</label>
                            <select name="zone" id="ctZone" disabled>
                                <option <?php echo ($user['zoneuser'] <> "urbana" && $user['zoneuser'] <> "rural") ? "selected" : "" ?> disabled></option>
                                <option <?php echo ($user['zoneuser'] === "rural") ? "selected" : "" ?> value="rural">
                                    rural</option>
                                <option <?php echo ($user['zoneuser'] === "urbana") ? "selected" : "" ?> value="urbana">
                                    urbana</option>
                            </select>
                            <div>
                                <div>
                                    <label for="email">Correo Eletrónico *</label>
                                    <input type="text" name="email" id="ctEmailUser"
                                        value="<?php echo $user['emailuser']; ?>" disabled>
                                </div>
                                <div>
                                    <label for="phone">Numero de Celular 1 *</label>
                                    <input type="number" name="phone" id="ctNumCelUser"
                                        value="<?php echo $user['phoneuser']; ?>" disabled>
                                </div>
                                <div>
                                    <label for="ctNumCel2">Numero de Celular 2</label>
                                    <input type="number" name="phone2" id="ctNumCel2"
                                        value="<?php echo $user['phonealtuser']; ?>" disabled>

                                </div>
                            </div>
                            <div class="updatebutton">
                                <span id="enableForm1"> Editar</span>
                            </div>

                            <input type="submit" name="btnUpdateProfile" value="Guardar">
                        </form>
                    </div>
                </div>
                <?php
                if ($privilegios <> $privAdmin) {
                    echo "";
                } else {
                    echo "
                    <div class='profile-adm container-right2' id='container-right3'>
                        <div class='title'>
                            <h1>proveedores</h1>
                        </div>
                        <div class='table-container'>
                            <div class='form-container'>
                                <div class='input-group'>
                                    <a href='?b=profile&s=optionSaveRedirec&p=proveedor'><button class='btn btn-default' type='submit'>Agregar</button></a>
                                </div>
                                <form method='post'  onsubmit='return false;'>
                                    <div class='input-group'>
                                        <input type='text' id='searchprov' class='form-control search-input' placeholder='Buscar Proveedor' name='buscar_proveedor'>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='table-wrapper'>
                        <table class='table-container content-table'>                        
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Direccion</th>
                                    <th>Correo</th>
                                    <th class='hide-on-small'>Telefono</th>
                                </tr>
                            </thead>
                            <tbody id='resultados-proveedor'>";
                    foreach ($proveedores as $proveedor) {
                        echo "
                                    <tr>
                                        <td>" . $proveedor['idprov'] . "</td>
                                        <td>" . ($proveedor['nomprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['dirprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['emaprov'] ?? 'Sin definir') . "</td>
                                        <td>" . ($proveedor['telprov'] ?? 'Sin definir') . "</td>
                                        <td class='icons1'>
                                            <a href='?b=profile&s=optionEditRedirec&p=proveedor&idprov=" . $proveedor['idprov'] . "' id='Proveedor'>
                                                <i class='fa fa-pencil fa-lg' aria-hidden='true'></i>
                                            </a>
                                        </td>
                                        <td class='icons2'>
                                            <a onclick='alertProfile(this.id, 'proveedor', '" . addslashes($proveedor['nomprov']) . "')' id='" . $proveedor['idprov'] . "'>
                                                <i class='fa-solid fa-trash-can' aria-hidden='true'></i>
                                            </a>
                                        </td>
                                    </tr>";
                    }
                    echo "
                            </tbody>
                        </table>
                        </div>
                    </div>";
                    echo "
                        <div class='profile-adm container-right3' id='container-right4'>
                            <div class='title'>
                                <h1>Colaboradores</h1>
                            </div>
                            <div class='table-container'>
                                <div class='form-container'>
                                    <div class='input-group'>
                                        <span class='input-group-btn'>
                                            <a href='?b=profile&s=optionSaveRedirec&p=Colaborador'><button class='btn btn-default' type='submit'>Agregar</button></a>
                                        </span>
                                    </div>
                                    <form method='POST' onsubmit='return false;''>
                                        <div class='input-group'>
                                            <input type='text' class='form-control search-input' id='searchcol' placeholder='Buscar Empleado' name='buscar_empleado'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class='table-wrapper'>
                            <table class='table-container content-table'>
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Nickuser</th>
                                        <th>Email</th>
                                        <th>Direccion</th>
                                        <th>Zona</th>
                                        <th>Telefono</th>
                                        <th>Telefono Alt.</th>
                                        <th class='hide-on-small'>Privilegios</th>
                                    </tr>
                                </thead>
                                <tbody id='resultados-empleados'>";
                    foreach ($users as $colaborador) {
                        $value = $colaborador['privileges'];
                        $user = isset($roles[$value]) ? $roles[$value] : "";

                        if (!empty($user)) {
                            echo "
                                <tr>
                                    <td>" . $colaborador['dniuser'] . "</td>
                                    <td>" . $colaborador['nameuser'] . "</td>
                                    <td>" . $colaborador['surnameuser'] . "</td>
                                    <td>" . $colaborador['nickuser'] . "</td>
                                    <td>" . $colaborador['emailuser'] . "</td>
                                    <td>" . $colaborador['diruser'] . "</td>
                                    <td>" . $colaborador['zoneuser'] . "</td>
                                    <td>" . ($colaborador['phoneuser'] ?? 'Sin definir') . "</td>
                                    <td>" . ($colaborador['phonealtuser'] ?? 'Sin definir') . "</td>";
                            echo "
                                        <td>" . (($colaborador['privileges'] == $privRecepcionist) ? 'Recepcionista' : (($colaborador['privileges'] == $privDoctor) ? 'Veterinario(a)' : '')) . "</td>";
                            echo "
                                    <td class='icons1'>
                                        <a href='?b=profile&s=optionEditRedirec&p=Colaborador&iduser=" . $colaborador['dniuser'] . "'>
                                            <i class='fa fa-pencil fa-lg' aria-hidden='true'></i>
                                        </a>
                                    </td>
                                    <td class='icons2'>
                                    <a onclick='alertProfile(this.id, 'usuario', '" . addslashes($colaborador['nameuser']) . "')' id='" . $colaborador['dniuser'] . "'>
                                            <i class='fa-solid fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>";
                        }
                    }
                    echo "
                                </tbody>
                            </table>
                            </div>
                        </div>";
                }

                if ($privilegios == $privUser) {
                    echo "";
                } else {
                    echo '<div class="profile-adm container-right4" id="container-right5">
                    <div class="title">
                        <h1>Clientes</h1>
                    </div>
                    <div class="table-container">
                        <div class="form-container">';
                    if ($privilegios == Privilegios::User->get() || $privilegios == Privilegios::Doctor->get()) {
                        echo '';
                    } else {
                        echo '
                            <div class="input-group">
                                <a href="?b=profile&s=optionSaveRedirec&p=Cliente"><button class="btn btn-default" type="submit">Agregar</button></a>
                            </div>
                        ';
                    }

                    if ($privilegios == $privDoctor) {
                        echo '
                        <form method="POST" action="?b=profile&s=buscarClientes" onsubmit="return false;">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Buscar cliente" name="buscar_cliente" id="searchcli2">                                
                            </div>
                        </form>
                        ';
                    } else {
                        echo '
                        <form method="POST" action="?b=profile&s=buscarClientes"  onsubmit="return false;">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Buscar cliente" name="buscar_cliente" id="searchcli">                                
                            </div>
                        </form>
                        ';
                    }

                    echo '          
                        </div>
                    </div>
                    <div class="table-wrapper">
                    <table class="table-container content-table">
                        <thead>
                            <tr>
                                <th>N° Identificacion</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Email</th>                                
                                <th>Direccion</th>
                                <th>Zona</th>
                                <th>Telefono</th>
                                <th class="hide-on-small">Telefono Alternaivo</th>
                            </tr>
                        </thead>
                        <tbody id="resultados-clientes">';
                    foreach ($users as $key => $cliente) {
                        if ($cliente['privileges'] == Privilegios::User->get()) {
                            echo '
                            <tr>
                                <td>' . $cliente['dniuser'] . '</td>
                                <td>' . $cliente['nameuser'] . '</td>
                                <td>' . $cliente['surnameuser'] . '</td>
                                <td>' . $cliente['nickuser'] . '</td>
                                <td>' . $cliente['emailuser'] . '</td>
                                <td>' . $cliente['diruser'] . '</td>
                                <td>' . $cliente['zoneuser'] . '</td>
                                <td>' . $cliente['phoneuser'] . '</td>
                                <td>' . $cliente['phonealtuser'] . '</td>';
                            if ($privilegios == $privDoctor) {
                                echo '';
                            } else {
                                echo '
                                <td class="icons1">
                                    <a href="?b=profile&s=optionEditRedirec&p=Cliente&iduser=' . $cliente['dniuser'] . '">
                                        <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                    </a>
                                </td>';
                            }

                            if ($privilegios !== Privilegios::Admin->get()) {
                                echo '';
                            } else {
                                echo '
                                <td class="icons2">
                                    <a onclick=\'alertProfile(this.id, "usuario", "' . addslashes($cliente['nameuser']) . '")\' id="' . $cliente['dniuser'] . '">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            ';
                            }
                            echo '
                            </tr>';
                        }
                    }
                    echo '
                        </tbody>
                    </table>
                    </div>
                </div>';
                }
                ?>
                <div class="profile-adm container-right5" id="container-right6">
                    <div class="title">
                        <h1>Mascota</h1>
                    </div>
                    <div class="table-container">
                        <div class="form-container">
                            <?php
                            if ($privilegios == $privUser || $privilegios == $privAdmin) {
                                echo '
                                <div class="input-group">
                                    <a href="?b=profile&s=optionSaveRedirec&p=mascota"><button class="btn btn-default" type="submit">Agregar</button></a>
                                </div>';
                            } else {
                                echo '';
                            }
                            ?>
                            <?php

                            if ($privilegios == $privRecepcionist || $privilegios == $privDoctor || $privilegios == $privAdmin) {

                                if ($privilegios === $privAdmin) {
                                    echo " 
                                    <form method='POST' action='?b=profile&s=buscarMascotas'  onsubmit='return false;'>
                                        <div class='input-group'>
                                            <input type='text' class='form-control search-input' placeholder='Buscar mascota' name='buscar_mascota' id='searchmas'>
                                        </div>
                                    </form>";
                                } elseif ($privilegios === $privRecepcionist) {
                                    echo " 
                                    <form method='POST' action='?b=profile&s=buscarMascotas3'  onsubmit='return false;'>
                                        <div class='input-group'>
                                            <input type='text' class='form-control search-input' placeholder='Buscar mascota' name='buscar_mascota' id='searchmas3'>
                                        </div>
                                    </form>";

                                } else {
                                    echo " 
                                    <form method='POST' action='?b=profile&s=buscarMascotas2'  onsubmit='return false;'>
                                        <div class='input-group'>
                                            <input type='text' class='form-control search-input' placeholder='Buscar mascota' name='buscar_mascota' id='searchmas2'>
                                        </div>
                                    </form>";
                                }
                            } else {
                                echo "";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-container content-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Genero</th>
                                    <th>Especie</th>
                                    <th class="hide-on-small">Numero de identificacion del dueño</th>
                                </tr>
                            </thead>
                            <tbody id="resultados-mascotas">
                                <?php
                                foreach ($mascota as $m) {
                                    if ($privilegios == $privUser && $m['idcli'] != $user['iduser']) {
                                        continue;
                                    }
                                    echo '<tr>';
                                    echo '<td>' . $m['idmas'] . '</td>';
                                    echo '<td>' . $m['nommas'] . '</td>';
                                    echo '<td>' . $m['edadmas'] . '</td>';
                                    echo '<td>' . $m['genmas'] . '</td>';
                                    echo '<td>' . $m['espmas'] . '</td>';
                                    echo '<td>';
                                    if ($privilegios == $privUser) {
                                        echo $user['dniuser'];
                                    } else {
                                        $dueño = array_filter($users, function ($usuario) use ($m) {
                                            return $usuario['iduser'] == $m['idcli'];
                                        });

                                        if (!empty($dueño)) {
                                            $dueño = reset($dueño);
                                            echo $dueño['dniuser'];
                                        }
                                    }
                                    echo '</td>';
                                    if ($privilegios == $privDoctor || $privilegios == $privUser) {

                                    } else {
                                        echo '
                                        <td class="icons1">
                                            <a href="?b=profile&s=optionEditRedirec&p=mascota&idmas=' . $m['idmas'] . '">
                                                <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </td>';
                                    }
                                    if ($privilegios == $privDoctor || $privilegios == $privUser || $privilegios == $privRecepcionist) {
                                    } else {
                                        echo '
                                <td class="icons2">
                                    <a onclick=\'alertProfile(this.id, "mascota", "' . addslashes($m['nommas']) . '")\' id="' . $m['idmas'] . '">
                                        <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                                    </a>
                                </td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                if ($privilegios == $privUser || $privilegios == $privRecepcionist) {
                    echo "";
                } else {
                    echo "
                        <div class='profile-adm container-right2' id='container-right7'>
                            <div class='title'>
                                <h1>Recetar Productos</h1><br><br>
                            </div>
                            <div class='header-receta'>
                                <form action='?b=profile&s=showReceta' class='sendReceta' method='post'>
                                    <h1>Datos del Colaborador</h1>
                                    <br><br>
                                    <div class='colaborador'>";
                    if ($privilegios == $privDoctor) {
                        echo "
                                        <div>
                                            <div>
                                                <input type='number' name='numidcol' id='numIdColaborador' readonly value='" . $user['dniuser'] . "' placeholder='Numero de identificacion del colaborador' required>
                                            </div>
                                        <input readonly type='date' name='date' id='date-receta' placeholder='Fecha Actual' required>
                                        </div>
                                        ";
                    } else {
                        echo "
                                        <div>
                                        <div>
                                            <input type='number' name='numidcol' id='numIdColaborador' placeholder='Numero de identificacion del colaborador' required>
                                        </div>
                                        <input readonly type='date' name='date' id='date-receta' placeholder='Fecha Actual' required>
                                    </div>
                                        ";
                    }
                    echo "
                                    </div>
                                    <br><br><br><br>
                                    <h1>Datos de Usuario y Paciente</h1>
                                    <br><br>
                                    <div class='Usuario'>
                                        <div>
                                            <div>
                                                <input type='number' name='dniuser' id='input-receta' autocomplete='off' placeholder='Numero de identificacion del usuario' required>
                                                <select name='selMas' id='input-receta' required>
                                                <option disabled selected>Seleccione una opcion</option>";
                    foreach ($mascota as $m) {
                        foreach ($users as $r) {
                            if ($r['iduser'] == $m['idcli']) {
                                echo "<option value='" . $m['idmas'] . "'>" . $m['nommas'] . " - " . $r['dniuser'] . "</option>";
                            }
                        }
                    }
                    echo "
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                    <h1>Receta</h1>
                                    <br><br>
                                    <textarea name='receta' placeholder='Escriba la receta a seguir ...' required></textarea>
                                    <br><br><br><br>
                                    <h1>Listado de Productos</h1>
                                    <br><br>
                                    <table class='table-container content-table'>
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Producto</th>
                                                <th>Descripcion</th>
                                                <th>Precio</th>
                                                <th>Categoria</th>
                                                <th>Disponibles (und)</th>
                                                <th class='hide-on-small'>Recetar</th>
                                            </tr>
                                        </thead>
                                        <tbody id='resultados-producto'>";
                    foreach ($productos as $key => $producto) {
                        if ($producto['stockprod'] <> 0) {
                            echo "<tr>
                                                    <td>" . $producto['idprod'] . "</td>
                                                    <td>" . ($producto['nomprod'] ?? 'Sin definir') . "</td>
                                                    <td>" . ($producto['desprod'] ?? 'Sin definir') . "</td>
                                                    <td>" . ($producto['precvenprod'] ?? 'Sin definir') . "</td>
                                                    <td>";
                            foreach ($categorias as $categoria) {
                                echo ($categoria['idcat'] === $producto['catprod']) ? $categoria['namecat'] : '';
                            }
                            echo "</td>
                                                    <td>" . ($producto['stockprod'] ?? 'Sin definir') . "</td>";
                            echo "<td><input type='checkbox' name='recetar'></td>
                                                </tr>";
                        }
                    }
                    echo "
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <button id='addReceta'>Agregar a la receta</button>
                                    <br><br><br><br>
                                    <h1>Productos seleccionados para la receta</h1>
                                    <br><br>
                                    <table class='table-container'>
                                        <thead>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </thead>
                                        <tbody id='resultados-receta'>

                                        </tbody>
                                    </table>
                                    <br><br>
                                    <div class='footer-receta'>
                                        <h2>Total a pagar: $ <span id='total-pagar'></span></h2>
                                    </div>
                                    <input type='hidden' id='productos' name='nameprod' required>
                                    <input type='hidden' id='cantidad' name='cantprod' required>
                                    <input type='hidden' id='precio' name='precprod' required>
                                    <button type='submit' id='sendReceta'>Generar Receta</button>
                                </form>
                            </div>
                        </div>";

                }
                if ($privilegios == $privAdmin || $privilegios == $privRecepcionist || $privilegios == $privUser) {
                    echo '<div class="profile-adm container-right2" id="container-right8">
                <div class=\'title\'>
                    <h1>Solicitud de Citas</h1><br><br>
                </div>';
                    if ($privilegios == $privUser) {
                    } else {
                        echo '
                        <div class="form-appointment colaborador" >
                    <div onclick="cleanForm()"><span>Limpiar</span><i class="fa-solid fa-delete-left"></i></div>
                    <div>
                        <form action="?b=profile&s=sheduleservice" method="post" class="form-cita">
                            <div>
                                <div class="input-cita">
                                    <div><label for="idcit">Id de la Cita</label></div>
                                    <div><input type="number" name="idcit" placeholder="Id cita" id="cita-id" required></div>
                                </div>
                                <div class="input-cita">
                                    <div><label for="dniuser">Numero de DNI del Usuario </label></div>
                                    <div><input type="number" name="dniuser"  placeholder="DNI del usuario" id="cita-dni" required></div>
                                </div>
                                <div class="input-cita">
                                    <div><label for="dateasig">Fecha de Asignacion de la cita</label></div>
                                    <div><input type="date" name="dateasig" placeholder="Fecha de Asignación" required></div>
                                </div>
                                <div class="input-cita">
                                    <div><label for="selcol">Asignar Colaborador</label></div>
                                    <div><select name="selcol" required>
                                    <option selected disabled>Seleccione una opcion</option>';
                        foreach ($users as $col) {
                            $value2 = ($col['privileges'] == Privilegios::Doctor->get()) ? $col['privileges'] : "";
                            $user2 = isset($roles[$value2]) ? $roles[$value2] : "";
                            if (!empty($user2)) {
                                echo '<option value="' . $col['iduser'] . '">' . $col['nameuser'] . ' ' . $col['surnameuser'] . '</option>';
                            }
                        }
                        echo '</select></div>
                                </div>
                            </div>
                            <div class="input-group" id="assignButtonContainer">
                                <button type="submit" id="assigButton">Agendar Servicio</button>
                            </div>
                        </form>
                    </div>
                </div>
                        ';
                    }
                    echo '
                <div class="table-container">
                    <div class="form-container">
                        <div class="input-group">
                            <a href="?b=bookappointment"><button class="btn btn-default" type="submit">Solicitar servicio</button></a>
                        </div>';

                    if ($privilegios == $privUser) {
                    } else {
                        echo '
                        <form method="POST" action="?b=profile&s=buscarCita">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Buscar cita" name="buscar_cita" id="searchcita">
                            </div>
                        </form>';
                    }
                    echo '
                    </div>
                </div>
                <div class="table-wrapper">';
                    if ($privilegios == $privUser) {
                        $userDNI = $user['dniuser'];
                        $citasConNombresUsuarios = array();
                        foreach ($cita as $c) {
                            // Verifica si el DNI del usuario actual coincide con el DNI de la cita
                            if (!empty($c['dniusercit']) && $c['dniusercit'] == $userDNI) {
                                $usuarioAsignado = $user['nameuser'] . " " . $user['surnameuser'];
                                $citasConNombresUsuarios[] = array(
                                    'idcita' => $c['idcita'],
                                    'dniusercit' => $c['dniusercit'],
                                    'nameusercit' => $c['nam eusercit'],
                                    'phoneusercit' => $c['phoneusercit'],
                                    'emailusercit' => $c['emailusercit'],
                                    'namemascit' => $c['namemascit'],
                                    'espmascit' => $c['espmascit'],
                                    'genmascit' => $c['genmascit'],
                                    'motcit' => $c['motcit'],
                                    'servicecit' => $c['servicecit'],
                                    'datesolcit' => date('d-m-Y', strtotime($c['datesolcit'])),
                                    'statecit' => $c['statecit'],
                                    'datecit' => ($c['datecit'] == NULL ? "No asignado" : date('d-m-Y', strtotime($c['datecit']))),
                                    'hourcit' => ($c['hourcit'] == NULL ? "No asignado" : $c['hourcit']),
                                    'nombreUsuarioAsignado' => $usuarioAsignado,
                                );
                            }
                        }

                        // Ahora, crea la tabla utilizando el arreglo $citasConNombresUsuarios
                        echo '<table class=\'table-container content-table\'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>DNI Usuario</th>
                                        <th>Nombre</th>
                                        <th>N° Telefono</th>
                                        <th>Email</th>
                                        <th>Nombre Mascota</th>
                                        <th>Especie Mascota</th>
                                        <th>Genero Mascota</th>
                                        <th>Motivo</th>
                                        <th>Servicio Solicitado</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Estado</th>
                                        <th>Fecha Asignación</th>
                                        <th class="hide-on-small">Hora Asignada</th>
                                        <th>Personal Asignado</th>
                                    </tr>
                                </thead>
                                <tbody id="resultados-cita">';
                        foreach ($citasConNombresUsuarios as $c) {
                            echo '<tr onclick="getCita(this)" class="tr-cita" data-id="' . $c['idcita'] . '" data-dni="' . $c['dniusercit'] . '">
                                    <td>' . $c['idcita'] . '</td>
                                    <td>' . $c['dniusercit'] . '</td>
                                    <td>' . $c['nameusercit'] . '</td>
                                    <td>' . $c['phoneusercit'] . '</td>
                                    <td>' . $c['emailusercit'] . '</td>
                                    <td>' . $c['namemascit'] . '</td>
                                    <td>' . $c['espmascit'] . '</td>
                                    <td>' . $c['genmascit'] . '</td>
                                    <td>' . $c['motcit'] . '</td>
                                    <td>' . $c['servicecit'] . '</td>
                                    <td>' . $c['datesolcit'] . '</td>
                                    <td>' . $c['statecit'] . '</td>
                                    <td>' . $c['datecit'] . '</td>
                                    <td>' . $c['hourcit'] . '</td>
                                    <td>' . $c['nombreUsuarioAsignado'] . '</td>
                                </tr>';
                        }
                    } else {
                        $citasConNombresUsuarios = array();
                        foreach ($cita as $c) {
                            $usuarioAsignado = "No asignado";
                            foreach ($users as $colcit) {
                                if (!empty($c['idcolcit']) && $c['idcolcit'] == $colcit['iduser']) {
                                    $usuarioAsignado = $colcit['nameuser'] . " " . $colcit['surnameuser'];
                                    break;
                                }
                            }
                            $citasConNombresUsuarios[] = array(
                                'idcita' => $c['idcita'],
                                'dniusercit' => $c['dniusercit'],
                                'nameusercit' => $c['nameusercit'],
                                'phoneusercit' => $c['phoneusercit'],
                                'emailusercit' => $c['emailusercit'],
                                'namemascit' => $c['namemascit'],
                                'espmascit' => $c['espmascit'],
                                'genmascit' => $c['genmascit'],
                                'motcit' => $c['motcit'],
                                'servicecit' => $c['servicecit'],
                                'datesolcit' => date('d-m-Y', strtotime($c['datesolcit'])),
                                'statecit' => $c['statecit'],
                                'datecit' => ($c['datecit'] == NULL ? "No asignado" : date('d-m-Y', strtotime($c['datecit']))),
                                'hourcit' => ($c['hourcit'] == NULL ? "No asignado" : $c['hourcit']),
                                'nombreUsuarioAsignado' => $usuarioAsignado,
                            );
                        }

                        // Ahora, crea la tabla utilizando el arreglo $citasConNombresUsuarios
                        echo '<table class=\'table-container content-table\'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>DNI Usuario</th>
                                    <th>Nombre</th>
                                    <th>N° Telefono</th>
                                    <th>Email</th>
                                    <th>Nombre Mascota</th>
                                    <th>Especie Mascota</th>
                                    <th>Genero Mascota</th>
                                    <th>Motivo</th>
                                    <th>Servicio Solicitado</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Estado</th>
                                    <th>Fecha Asignación</th>
                                    <th class="hide-on-small">Hora Asignada</th>
                                    <th>Personal Asignado</th>
                                </tr>
                            </thead>
                            <tbody id="resultados-cita">';
                        foreach ($citasConNombresUsuarios as $c) {
                            echo '<tr onclick="getCita(this)" class="tr-cita" data-id="' . $c['idcita'] . '" data-dni="' . $c['dniusercit'] . '">
                                <td>' . $c['idcita'] . '</td>
                                <td>' . $c['dniusercit'] . '</td>
                                <td>' . $c['nameusercit'] . '</td>
                                <td>' . $c['phoneusercit'] . '</td>
                                <td>' . $c['emailusercit'] . '</td>
                                <td>' . $c['namemascit'] . '</td>
                                <td>' . $c['espmascit'] . '</td>
                                <td>' . $c['genmascit'] . '</td>
                                <td>' . $c['motcit'] . '</td>
                                <td>' . $c['servicecit'] . '</td>
                                <td>' . $c['datesolcit'] . '</td>
                                <td>' . $c['statecit'] . '</td>
                                <td>' . $c['datecit'] . '</td>
                                <td>' . $c['hourcit'] . '</td>
                                <td>' . $c['nombreUsuarioAsignado'] . '</td>
                            </tr>';
                        }
                    }

                    echo '</tbody></table>
                    </div>
                </div>';
                }

                if ($privilegios == $privUser || $privilegios == $privRecepcionist) {
                    echo "";
                } else {
                    echo '<div class="profile-adm container-right2" id="container-right9">';
                    echo '<div class="title">';
                    echo '<h1>Listado de Recetas</h1><br><br>';
                    echo '</div>';

                    echo '<div class="table-wrapper">';
                    echo '<table class="table-container content-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Id</th>';
                    echo '<th>DNI Veterinario</th>';
                    echo '<th>DNI Usuario</th>';
                    echo '<th>Nombre Mascota</th>';
                    echo '<th>Productos</th>';
                    echo '<th>Valor</th>';
                    echo '<th>Fecha Expedición</th>';
                    echo '<th>Indicaciones</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<form action="?b=profile&s=generateReceta" method="POST">';
                    echo '<tbody id="resultados-">';
                    foreach ($recetas as $r) {
                        echo '<tr>';
                        echo '<td><input readonly type="number" id="idrecrec" name="idrec" value="' . $r['idrec'] . '"></td>';
                        echo '<td>' . $r['dnicolrec'] . '</td>';
                        echo '<td>' . $r['dniuserrec'] . '</td>';
                        foreach ($mascota as $masrec) {
                            if ($masrec['idmas'] == $r['idmasrec']) {
                                echo '<td>' . $masrec['nommas'] . '</td>';
                            }
                        }
                        echo '<td>' . $r['prodrec'] . '</td>';
                        echo '<td>' . $r['precrec'] . '</td>';
                        echo '<td>' . $r['fecharec'] . '</td>';
                        echo '<td id="indicaciones">' . $r['indrec'] . '</td>';
                        echo '<td><button id="btnGenRec" type="submit">Generar Receta</button></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</form>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';

                }
                ?>
        </main>

        <script>

        </script>
    </div>
    <!-- Alerts -->
    <script src="assets/Javascript/alert-profile.js"></script>
    <!-- Menu Profile -->
    <script src="assets/Javascript/menu-profile-administrator.js"></script>
    <!-- Form Disable and Enable -->
    <script src="assets/Javascript/form-disable-enable.js"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>
    <!-- Library JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Serach -->
    <script src="assets/Javascript/real_time_search.js"></script>
    <!-- Get Data Cita -->
    <script src="assets/Javascript/getDataCita.js"></script>
</body>

</html>