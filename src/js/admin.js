document.addEventListener("DOMContentLoaded", function () {
  const enlaces = document.querySelectorAll(".dashboard__enlace");

  enlaces.forEach((enlace) => {
    var colorAnterior = enlace.style.color;
    enlace.style.color = "#fff";
    enlace.style.transition = "none";
    setTimeout(() => {
      enlace.style.color = colorAnterior;
      enlace.style.transition =
        ".3s ease-in-out text-shadow,.3s ease-in-out color";
    }, 0);
  });
});

console.log("wenas");

