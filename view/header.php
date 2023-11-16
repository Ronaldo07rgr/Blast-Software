<body>
    <div class="container" style="min-height: 500px">
        <header>
            <div class="header-top">
                <div class="social-networks">
                    <a href="https://es-la.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://api.whatsapp.com/send?phone=3133215141"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <div class="button-register">
                    <div class="button-register">
                        <?php
                        if (isset($_SESSION['usuario'])) {
                            $usuario = $_SESSION['usuario'];
                            echo "<a href='?b=profile&s=Inicio'><button><i class='fa-solid fa-user'></i>&nbsp;<span>" . $usuario . "</span></button></a>";
                        } else {
                            echo '<a href="?b=login"><button><i class="fa-solid fa-user"></i>&nbsp;<span>Iniciar Sesión</span></button></a>';
                        }
                        ?>
                    </div>

                </div>
            </div>
            <div class="header-bottom">
                <div class="container-logo">
                    <a href="?b=index"><img src="assets/img/logo-removebg.png" alt=""></a>
                </div>
                <div class="nav">
                    <ul>
                        <a href='?b=index&s=Inicio'><li>Inicio</li></a>
                        <a href='?b=knowus&s=Inicio'><li>Conocenos</li></a>
                        <a href='?b=bookappointment&s=Inicio'><li>Servicios y Reservas</li></a>
                        <a href='?b=contactus&s=Inicio'><li>Contactenos</li></a>
                    </ul>
                </div>
                <div class="icon-menu">
                    <i id="open-menu"  class="fa-solid fa-bars"></i>
                    <i id="close-menu" class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </header>
        <div class="panel-menu" id="panel-menu">
            <ul>
                <a href='?b=index&s=Inicio'><li>Inicio</li></a>
                <a href='?b=knowus&s=Inicio'><li>Conocenos</li></a>
                <a href='?b=bookappointment&s=Inicio'><li>Servicios y Reservas</li></a>
                <a href='?b=contactus&s=Inicio'><li>Contactenos</li></a>
            </ul>
        </div>