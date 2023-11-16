let ventana = document.getElementById("window");

let link = document.getElementById("window-up").addEventListener("click", ()=>{
    ventana.style.display = "block" 
})

let iconx = document.getElementById("exit-window").addEventListener("click", ()=>{
    ventana.style.display = "none";
})