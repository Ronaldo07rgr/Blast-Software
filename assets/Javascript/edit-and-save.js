const inputs = document.querySelectorAll(".input");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  
  if (input.value.trim() !== "") {
    let parent = input.parentNode;
    parent.classList.add("focus");
  }
  
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});
