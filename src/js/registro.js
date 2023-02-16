import Swal from "sweetalert2";
(function () {
  let eventos = []; //arreglo de eventos que el usuario va agregando

  const resumen = document.querySelector("#registro-resumen");

  if (resumen) {
    const eventosBoton = document.querySelectorAll(".evento__agregar");
    eventosBoton.forEach((boton) => {
      boton.addEventListener("click", seleccionarEvento);
    });
    const formularioRegistro = document.querySelector("#registro");
    formularioRegistro.addEventListener("submit", submitFormulario);

    mostrarEventos();

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

      if (eventos.length === 0) {
        const noRegistro = document.createElement("P");
        noRegistro.textContent = "No hay registros. Añade en el lado izquierdo";
        noRegistro.classList.add("registro__texto");
        resumen.appendChild(noRegistro);
      }
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

    async function submitFormulario(e) {
      e.preventDefault();
      //obtener el regalo
      const regaloId = document.querySelector("#regalo").value;
      //obtengo eventos
      const eventosId = eventos.map((evento) => evento.id);
      if (eventosId.length === 0 || regaloId === "") {
        Swal.fire({
          text: "Selecciona al menos un evento y un regalo",
          icon: "error",
          confirmButtonText: "Ok",
        });
        return;
      }

      //objeto fromdata
      const datos = new FormData();
      datos.append("eventos", eventosId);
      datos.append("regalo", regaloId);
      const url = "/finalizar-registro/conferencias";
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });
      const resultado = await respuesta.json();

      if (resultado.resultado) {
        Swal.fire(
          "Todo ha salido bien",
          "Se ha registrado correctamente !",
          "success"
        ).then(() => {
          location.href = `/boleto?id=${resultado.token}`;
        });
      } else {
        Swal.fire({
          title: "Error",
          text: "Hubo un error",
          icon: "error",
          confirmButtonText: "Ok",
        }).then(() => {
          location.reload();
        });
      }
    }
  }
})();
