import VanillaTilt from "vanilla-tilt";

//paquetes
const paquetes = document.querySelectorAll(".paquete");

VanillaTilt.init(paquetes, {
  reverse: false,
  max: 6,
  speed: 500,
});

//boletos pagina principal
const boletos = document.querySelectorAll(".boleto");

VanillaTilt.init(boletos, {
  reverse: false,
  max: 10,
  speed: 1000,
  axis: "x",
});
