// form-User-Information
document.getElementById("enableForm1").addEventListener("click", function() {
  enableForm("form-user-information");
});

document.getElementById("disableForm1").addEventListener("click", function() {
  disableForm("form-user-information");
});

// Habilitar y deshabilitar form2
document.getElementById("enableForm2").addEventListener("click", function() {
  enableForm("form-pet-information");
});

document.getElementById("disableForm2").addEventListener("click", function() {
  disableForm("form-pet-information");
});

// Funciones para habilitar y deshabilitar campos del formulario
function enableForm(formId) {
  var form = document.getElementById(formId);
  var inputs = form.getElementsByTagName("input");
  var selects = form.getElementsByTagName("select");

  for (var i = 0; i < inputs.length; i++) {
    inputs[i].disabled = false;
  }

  for (var i = 0; i < selects.length; i++) {
    selects[i].disabled = false;
  }

  // Habilitar el botón "Guardar"
  var submitButton = form.querySelector("input[type='submit']");
  submitButton.disabled = false;
}

function disableForm(formId) {
  var form = document.getElementById(formId);
  var inputs = form.getElementsByTagName("input");
  var selects = form.getElementsByTagName("select");

  for (var i = 0; i < inputs.length; i++) {
    inputs[i].disabled = true;
  }

  for (var i = 0; i < selects.length; i++) {
    selects[i].disabled = true;
  }

  // Deshabilitar el botón "Guardar"
  var submitButton = form.querySelector("input[type='submit']");
  submitButton.disabled = true;
}
