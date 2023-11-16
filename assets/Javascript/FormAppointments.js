const panelService = document.getElementById("formService");
let isFormVisible = false;

function mostrarForm() {
    if (!isFormVisible) {
        panelService.style.transition = "opacity 0.5s ease-in-out";
        panelService.style.visibility = "visible";
        panelService.style.opacity = "0";

        setTimeout(() => {
            panelService.style.opacity = "1";
        }, 10); 

        isFormVisible = true;
    }
}

function ocultarForm() {
    panelService.style.transition = "opacity 0.5s ease-in-out";
    panelService.style.opacity = "0";
    setTimeout(() => {
        panelService.style.visibility = "hidden";
        isFormVisible = false;
    }, 500);
}

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('p') === 'showForm') {
        mostrarForm(); 
    }
}

function errorAlert() {
    console.log(1);
    alert("¡Inicia sesión para poder solicitar nuestros servicios!");
}
