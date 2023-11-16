<!--Main-->
<main>
  <!-- background image -->
  <div class="background-image">
    <div class="img-and-text">
      <div class="child-container">
        <div class="contac">
          <h1>Contactos</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- contact information -->
  <div class="child-container">
    <div class="container-main-contact">
      <div class="title-container">
        <div class="title-hr">
          <div class="hr"></div>
        </div>
        <p>¿CÓMO PODEMOS AYUDARTE?</p>
        <div class="title-hr">
          <div class="hr"></div>
        </div>
      </div>
      <div class="cont-contact-text">
        <div class="cont-contact">
          <!-- contact info text -->
          <div class="text-information">
            <p>
              Si deseas obtener más información de las consultas generales y
              especializadas, rayos X, ecografía o alguno de nuestros
              servicios especiales en veterinaria, no dudes en contactarnos
              vía telefónica, visitando nuestra clínica o escribiéndonos por
              medio del formulario de contacto en esta página. ¡Con gusto te
              atenderemos!
            </p>
          </div>
          <!-- numbers contact -->
          <div class="contact-info">
            <div class="telefono-info">
              <h4>Teléfono</h4>
              <a href="tel:+573131241346">
                <i class="fas fa-phone"></i>
                +57
                3131241346</a>
              <a href="tel:+573114352472">
                <i class="fas fa-phone"></i>
                +57
                3114352472</a>
              <a href="tel:+573104589657">
                <i class="fas fa-phone"></i>
                +57
                3104589657</a>
            </div>
            <!-- veterinary address -->
            <div class="direccion-info">
              <h4>Dirección</h4>
              <p> Calle 5 sur # 4B - 10 Barrio Jose Dario Obviez La Plata - Huila</p>
            </div>
          </div>
        </div>
        <!-- location on the map -->
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15945.403692971771!2d-75.9004982339112!3d2.3888799113005112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3ad2ac5e3b81b9%3A0xd8c3baaf8fdec314!2sLa%20Plata%2C%20Huila!5e0!3m2!1ses!2sco!4v1680093840348!5m2!1ses!2sco" width="100%" height="250px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
    <!-- form -->
    <div class="aside">
      <form id="contact-form" action="?b=contactus&s=sendEmail" method="post">
        <div class="name-container">
          <div class="field-container">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="field-container">
            <label for="last-name">Apellido:</label>
            <input type="text" id="last-name" name="surname" required>
          </div>
        </div>
        <div class="email-container">
          <div class="field-container">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required />
          </div>
        </div>
        <div class="message-container">
          <div class="field-container">
            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
          </div>
          <input type="submit" value="Enviar" id="enviar-btn" />
        </div>
        <div class="modal" style="display: none;">
          <p>Gracias por tu mensaje.</p>
          <button class="close" id="close">Volver</button>
        </div>
        <div class="opacidad" style="display: none;"></div>
      </form>
    </div>
  </div>
</main>
</div>
</body>
<script src="https://kit.fontawesome.com/7fa9974a48.js" crossorigin="anonymous"></script>

</html>