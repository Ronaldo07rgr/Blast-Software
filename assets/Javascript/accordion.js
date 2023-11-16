
/*Accordion*/

const slideAccordion = document.querySelectorAll(".container-accordion-slide"); 
slideAccordion.forEach( ac => {
    ac.addEventListener("click", () => {
        ac.classList.toggle("active");
    })
})