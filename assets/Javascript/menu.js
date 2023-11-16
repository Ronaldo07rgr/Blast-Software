const panel = document.getElementById("panel-menu");
const icon = document.getElementById("open-menu");
const iconx = document.getElementById("close-menu");

icon.addEventListener("click", () =>{
    panel.style.display = "block"; 
    icon.style.display = "none"; 
    iconx.style.display = "block"; 
}); 

iconx.addEventListener("click", () =>{
    panel.style.display = "none"; 
    iconx.style.display = "none";
    icon.style.display = "block";  
}); 