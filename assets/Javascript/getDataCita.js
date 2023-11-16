// -----Metodo para obtener los datos
function getCita(row) {
    const idCita = row.getAttribute("data-id");
    const dniUsuario = row.getAttribute("data-dni");
    const estadoCita = row.querySelector("td:nth-child(12)").textContent; 
    const inputid = document.getElementById('cita-id'); 
    const inputdni = document.getElementById('cita-dni'); 
    const assignButtonContainer = document.getElementById('assignButtonContainer');
    const assigButton = document.getElementById('assigButton'); 
    inputid.value = idCita; 
    inputdni.value = dniUsuario;
    console.log(estadoCita); 
    if (estadoCita == "No asignado") {
        assignButtonContainer.style.transform = "translateX(78%)"; 
        assignButtonContainer.style.display = "block"; 
    } else {
        assignButtonContainer.style.display = "none"; 
    }
}


// -----Metodo para poder limpiar el formulario----- // 
function cleanForm() {
    var idcitInput = document.getElementById('cita-id');
    var dniuserInput = document.getElementById('cita-dni');
    var dateasigInput = document.getElementsByName('dateasig')[0];
    var selcolSelect = document.getElementsByName('selcol')[0];
    idcitInput.value = '';
    dniuserInput.value = '';
    dateasigInput.value = '';
    selcolSelect.selectedIndex = 0; 
    idcitInput.focus();
}