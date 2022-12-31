(function () {
  const horas = document.querySelector("#horas");

  if (horas) {
    const dias = document.querySelectorAll('[name="dia"]');
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
    const inputHiddenHora = document.querySelector('[name="hora_id"]');
    const categoria = document.querySelector('[name="categoria_id"]');

    let busqueda = {
      categoria_id: "",
      dia: "",
    };

    let seleccionActual = {
      categoria: categoria.value || "",
      dia: inputHiddenDia.value || "",
      hora: inputHiddenHora.value || "",
    };

    let horaDefault = {
      //guardamos la hora que viene por defecto de la base de datos
      categoria: categoria.value || "",
      dia: inputHiddenDia.value || "",
      hora: inputHiddenHora.value || "",
    };

    if (!Object.values(seleccionActual).includes("")) {
      async function iniciarApp() {
        //creamos async para que primero termine buscarEvenrtos antes de ejecutar lo siguiente
        await buscarEventos();

        //una vez activo las horas disponibles, seleccionamos la hora que deberia estar seleccionada actualmente
        seleccionarHoraActual();
      }

      iniciarApp();
    }

    const categoriaSelected = document.querySelector('[selected = "selected"]');
    if (categoriaSelected) {
      busqueda["categoria_id"] = categoriaSelected.value;
    }

    categoria.addEventListener("change", terminoBusqueda);

    dias.forEach((dia) => {
      dia.addEventListener("change", terminoBusqueda);
    });

    function terminoBusqueda(e) {
      busqueda[e.target.name] = e.target.value;

      console.log(e.target.name);
      //cambiamos los inputs ocultos
      if (e.target.name === "dia") {
        inputHiddenDia.value = e.target.value;
      } else {
        categoria.value = e.target.value;
      }

      const horaPrevia = document.querySelector(".horas__hora--seleccionada");
      if (horaPrevia) {
        horaPrevia.classList.remove("horas__hora--seleccionada");
      }

      if (Object.values(busqueda).includes("")) {
        //si la algun campo de la busqueda esta vacio no llama a la API
        return;
      }
      buscarEventos();
    }

    async function buscarEventos() {
      const { dia, categoria_id } = busqueda;
      const url = `http://localhost:8000/api/eventos-horarios?dia_id=${dia}&categoria_id=${categoria_id}`;

      const resultado = await fetch(url);
      const eventos = await resultado.json();

      obtenerHorasDisponibles(eventos);
    }

    function obtenerHorasDisponibles(eventos) {
      //Reiniar hora deshabilitadas
      const listadoHoras = document.querySelectorAll("#horas li");
      listadoHoras.forEach((li) => {
        li.classList.add("horas__hora--deshabilitada");
      });

      //Comprobar eventos ya tomados y quitar la variable deshabilitada
      const horasTomadas = eventos.map((evento) => evento.hora_id);
      const listadoHorasArray = Array.from(listadoHoras);

      const resultado = listadoHorasArray.filter(
        (li) => !horasTomadas.includes(li.dataset.horaId)
      );

      resultado.forEach((li) => {
        li.classList.remove("horas__hora--deshabilitada");
      });

      const horasDisponibles = document.querySelectorAll(
        "#horas li:not(.horas__hora--deshabilitada)"
      );

      horasDisponibles.forEach((hora) => {
        hora.addEventListener("click", seleccionarHora);
      });

      //si en la pagina esta la hora seleccionada con anterioridad se marcará
      seleccionarHoraActual();

      if (!Object.values(horaDefault).includes("")) {
        //si hay una hora default le sacamos el "deshabilitado"
        //ya que esa hora ya esta tomada por el mismo evento (puede volver a seleccionarlo)
        if (
          categoria.value === horaDefault.categoria &&
          inputHiddenDia.value === horaDefault.dia 
        ) {
          console.log('estamos en la pagina');
          //si estamos en la pagina de la hora default le sacamos la clase
          const horaDefaultElement = document.querySelector(
            `#horas li[data-hora-id='${horaDefault.hora}']`
          );
          horaDefaultElement.classList.remove("horas__hora--deshabilitada");
        }
      }
    }

    function seleccionarHora(e) {
      inputHiddenHora.value = e.target.dataset.horaId;

      //Deshabilitar hora previa
      const horaPrevia = document.querySelector(".horas__hora--seleccionada");
      if (horaPrevia) {
        horaPrevia.classList.remove("horas__hora--seleccionada");
      }
      //Agregar clase de seleccionado
      e.target.classList.add("horas__hora--seleccionada");

      //Llenar el campo oculto de dia
      inputHiddenDia.value = document.querySelector(
        '[name="dia"]:checked'
      ).value;

      seleccionActual.categoria = categoria.value;
      seleccionActual.dia = inputHiddenDia.value;
      seleccionActual.hora = inputHiddenHora.value;
    }

    function seleccionarHoraActual() {
      if (
        categoria.value === seleccionActual.categoria &&
        inputHiddenDia.value === seleccionActual.dia &&
        inputHiddenHora.value === seleccionActual.hora
      ) {
        //si estamos en la pagina donde esta la hora selecionada le agregamos la clase
        const horaActual = document.querySelector(
          `[data-hora-id="${seleccionActual.hora}"]`
        );

        horaActual.classList.remove("horas__hora--deshabilitada");
        horaActual.classList.add("horas__hora--seleccionada");
        horaActual.onclick = seleccionarHora;
      }
    }
  }
})();
