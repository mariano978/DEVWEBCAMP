import Swal from "sweetalert2";
(function () {
  let eventos = []; //arreglo de eventos que el usuario va agregando

  const eventosBoton = document.querySelectorAll(".evento__agregar");
  const resumen = document.querySelector("#registro-resumen");

  eventosBoton.forEach((boton) => {
    boton.addEventListener("click", seleccionarEvento);
  });

  function seleccionarEvento(e) {
    if (eventos.length < 5) {
      //copiamos el contenido que tenga previamente el arreglo y le agregamos otro objeto
      eventos = [
        ...eventos,
        {
          id: e.target.dataset.id,
          titulo: e.target.parentElement
            .querySelector(".evento__nombre")
            .textContent.trim(),
        },
      ];

      console.log(eventos);

      //deshabilitar el evento
      e.target.disabled = true;

      mostrarEventos();
    } else {
      Swal.fire({
        text: "Maximo 5 eventos",
        icon: "error",
        confirmButtonText: "Ok",
      });
    }
  }

  function mostrarEventos() {
    //borramos los eventos anteriores
    limpiarHijos(resumen);

    eventos.forEach((evento) => {
      const eventoDOM = document.createElement("DIV");
      eventoDOM.classList.add("registro__evento");
      const titulo = document.createElement("H3");
      titulo.classList.add("registro__nombre");
      titulo.textContent = evento.titulo;
      const botonEliminar = document.createElement("BUTTON");
      botonEliminar.classList.add("registro__eliminar");
      botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>';
      botonEliminar.onclick = function () {
        eliminarEvento(evento.id);
      };
      //renderizar en html
      eventoDOM.appendChild(titulo);
      eventoDOM.appendChild(botonEliminar);
      resumen.appendChild(eventoDOM);
    });
  }

  function eliminarEvento(id) {
    eventos = eventos.filter((evento) => evento.id !== id);
    const botonEvento = (document.querySelector(
      `[data-id="${id}"]`
    ).disabled = false);

    mostrarEventos();
  }

  //esta funcion remueve todos los hijos de un elemento
  function limpiarHijos(element) {
    while (element.firstChild) {
      element.removeChild(element.firstChild);
    }
  }
})();
