// Obtén los elementos del contenedor y los botones
const container0 = document.getElementById("container-right");
const container1 = document.getElementById("container-right2");
const container2 = document.getElementById("container-right3");
const container3 = document.getElementById("container-right4");
const container4 = document.getElementById("container-right5");
const container5 = document.getElementById("container-right6");
const container6 = document.getElementById("container-right7");
const container7 = document.getElementById("container-right8");

const profileAdmContainer = document.querySelectorAll(".profile-adm");
const profileAdmBtn = document.querySelectorAll(".profile-adm-btn");

profileAdmBtn.forEach((e, i) => {
  e.addEventListener("click", () => {
    profileAdmContainer.forEach((e) => {
      e.style.setProperty("display", "none");
    });
    profileAdmContainer[i].style.setProperty("display", "block");
  });
});
