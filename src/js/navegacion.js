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

moverIndicador(actual);

list.forEach((link) => {
  link.addEventListener("mouseover", (e) => {
    if (estaEnPc()) {
      moverIndicador(e.target);
    }
  });
});

nav.addEventListener("mouseout", () => {
  console.log('sale');
  moverIndicador(actual);
});

window.addEventListener("resize", function () {
  if (estaEnPc()) moverIndicador(actual);
});

//cuando carga la pagina
document.addEventListener("DOMContentLoaded", function () {
  //scroll automatico
  document.querySelector("main").scrollIntoView({
    behavior: "smooth",
  });
});
