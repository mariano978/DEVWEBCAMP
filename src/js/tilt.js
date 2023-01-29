import VanillaTilt from "vanilla-tilt";


//boletos pagina principal
const boletos = document.querySelectorAll(".boleto");

VanillaTilt.init(boletos, {
  reverse: false,
  max: 10,
  speed: 1000,
  axis: "x",
});
