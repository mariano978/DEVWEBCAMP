(function () {
  const ponentesInput = document.querySelector("#ponentes");
  const listadoPonentes = document.querySelector("#listado-ponentes");
  const ponenteHidden = document.querySelector('[name="ponente_id"]');

  if (ponentesInput) {
    let ponentes = [];
    let ponentesFiltrados = [];

    obtenerPonentes();

    ponentesInput.addEventListener("input", function (e) {
      buscarPonentes(e.target);
    });

    if (ponenteHidden.value) {
      //si el input oculto tiene un valor buscamos el ponente y lo muestra
      (async () => {
        const ponente = await obtenerPonente(ponenteHidden.value);      
        const ponenteDOM = document.createElement("LI");
        ponenteDOM.classList.add(
          "listado-ponentes__ponente",
          "listado-ponentes__ponente--seleccionado"
        );
        ponenteDOM.textContent = `${ponente.nombre} ${ponente.apellido}`;

        listadoPonentes.appendChild(ponenteDOM);
      })();
    }

    async function obtenerPonentes() {
      const url = `http://localhost:8000/api/ponentes`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      formatearPonentes(resultado);
    }

    async function obtenerPonente(id) {
      const url = `http://localhost:8000/api/ponente?id=${id}`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();
      return resultado;
    }

    function formatearPonentes(arrayPonentes = []) {
      ponentes = arrayPonentes.map((ponente) => {
        return {
          nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
          id: ponente.id,
        };
      });
    }

    function buscarPonentes(e) {
      const expAcentos = /[\u0300-\u036f]/g;
      const busqueda = e.value
        .toLowerCase()
        .normalize("NFD")
        .replace(expAcentos, "");

      console.log(ponentesFiltrados);
      console.log(ponentes);

      if (busqueda.length > 3) {
        //cuando tenemos 3 letras filtramos...
        ponentesFiltrados = ponentes.filter((ponente) => {
          if (
            ponente.nombre
              .toLowerCase()
              .normalize("NFD")
              .replace(expAcentos, "")
              .search(busqueda) != -1
          ) {
            //encontro ponente
            return ponente;
          }
        });
      } else {
        ponentesFiltrados = [];
      }

      mostrarPonentes();
    }

    function mostrarPonentes() {
      while (listadoPonentes.firstChild) {
        //removemos listado anterior
        listadoPonentes.removeChild(listadoPonentes.firstChild);
      }

      if (ponentesFiltrados.length > 0) {
        ponentesFiltrados.forEach((ponente) => {
          const ponenteHTML = document.createElement("LI");
          ponenteHTML.classList.add("listado-ponentes__ponente");
          ponenteHTML.textContent = ponente.nombre;
          ponenteHTML.dataset.ponenteId = ponente.id;
          ponenteHTML.onclick = seleccionarPonente;
          if (ponente.id === ponenteHidden.value) {
            ponenteHTML.classList.add(
              "listado-ponentes__ponente--seleccionado"
            );
          }
          //añadir al DOM
          listadoPonentes.appendChild(ponenteHTML);
        });
      } else {
        const noResultado = document.createElement("P");
        noResultado.classList.add("listado-ponentes__no-resultado");
        noResultado.textContent = "No hay resultados";
        //añadir al DOM
        listadoPonentes.appendChild(noResultado);
      }
    }

    function seleccionarPonente(e) {
      const ponente = e.target;
      //remover previo
      const ponentePrevio = document.querySelector(
        ".listado-ponentes__ponente--seleccionado"
      );
      if (ponentePrevio) {
        ponentePrevio.classList.remove(
          "listado-ponentes__ponente--seleccionado"
        );
      }
      ponente.classList.add("listado-ponentes__ponente--seleccionado");
      ponenteHidden.value = ponente.dataset.ponenteId;
    }
  }
})();
