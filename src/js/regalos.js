import Chart from "chart.js/auto";
(function () {
  obtenerDatos();
  async function obtenerDatos() {
    const url = "/api/regalos";
    const respuesta = await fetch(url);
    const resultado = await respuesta.json();
    console.log(resultado);

    const ctx = document.getElementById("regalos-grafica");

    if (ctx) {
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: resultado.map((regalo) => regalo.nombre),
          datasets: [
            {
              data: resultado.map((regalo) => regalo.total),
              borderWidth: 1,
              backgroundColor: [
                "#ea580c",
                "#84cc16",
                "#22d3ee",
                "#a855f7",
                "#ef4444",
                "#14b8a6",
                "#db2777",
                "#e11d48",
                "#7e22ce",
              ],
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
        plugins: {
          legend: {
            display: false,
          },
        },
      });
    }
  }
})();
