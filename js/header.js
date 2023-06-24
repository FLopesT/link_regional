let toggleOn = false;
const COLLAPSE = "navbar-collapse d-flex justify-content-end collapse";
const element = document.getElementsByClassName("navbar-nav")[0];
const elementNav = document.getElementsByClassName("navbar-collapse")[0];
let inter;
let animationOn = false;

setInterval(() => {
  if (window.innerWidth > 991 && toggleOn) {
    element.style = "";
    toggleOn = false;
    elementNav.className = COLLAPSE;
  }
}, 100);

function ligarInter() {
  inter = setTimeout(() => {
    element.style = "";
    animationOn = false;
  }, 100);
}

// clearInterval(inter);

function showNavBar() {
  toggleOn = !toggleOn;
  if (toggleOn) {
    clearInterval(inter);
    element.style.display = "flex";
  } else {
    animationOn = true;
    ligarInter();
  }
}
