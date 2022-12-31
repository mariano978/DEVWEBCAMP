//navegacion transparent
const marcador = document.querySelector("#marcador");
const list = document.querySelectorAll(".navegacion--animate a");
const nav = document.querySelector(".navegacion--animate");
const actual = document.querySelector(".navegacion__enlace--actual");

function moverIndicador(element) {
  marcador.style.left = element.offsetLeft + "px";
  marcador.style.width = element.offsetWidth + "px";
}

function estaEnPc() {
  const windowWidth = window.innerWidth;
  if (windowWidth >= 1024) {
    return true;
  }
  return false;
}

if (actual) {
  moverIndicador(actual);
}

list.forEach((link) => {
  link.addEventListener("mouseover", (e) => {
    if (estaEnPc()) {
      marcador.style.opacity = '1';
      moverIndicador(e.target);
    }
  });
});

nav.addEventListener("mouseout", () => {
  if (estaEnPc() && actual) {
    moverIndicador(actual);
  } else {
    marcador.style.opacity = '0';
  }
});

window.addEventListener("resize", function () {
  if (estaEnPc() && actual) {
    moverIndicador(actual);
  }
});

//cuando carga la pagina
document.addEventListener("DOMContentLoaded", function () {
  const main = document.querySelector("main");
  //scroll automatico
  if (main) {
    main.scrollIntoView({
      behavior: "smooth",
    });
  }
});
