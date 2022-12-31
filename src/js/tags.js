(function () {
  const tagsInput = document.querySelector("#tag_input");
  //si existe el input...
  if (tagsInput) {
    const divTags = document.querySelector("#tags");
    const tagsInputHidden = document.querySelector('[name="tags"]');
    let tags = [];
    //recuperar del input oculto
    if (tagsInputHidden.value) {
      //convertimos de string a arreglo, separa por ','
      tags = tagsInputHidden.value.split(",");
      mostrarTags();
    }

    //escuchar los cambios del input
    tagsInput.addEventListener("keypress", (e) => {
      if (e.keyCode === 44) {
        //si apreta coma...
        e.preventDefault(); //para q la coma no quede escrita prevenimos la accion
        //por defecto del input que es escribir
        if (e.target.value.trim() === "" || e.target.value < 1) return;
        tags = [...tags, e.target.value.trim()];
        tagsInput.value = "";
        console.log(tags);
        mostrarTags();
        actualizarValueInput();
      }
    });

    function mostrarTags() {
      //muestra los tags y da el evento de para eliminarlo
      divTags.textContent = "";
      tags.forEach((tag) => {
        const etiqueta = document.createElement("LI");
        etiqueta.classList.add("formulario__tag");
        etiqueta.textContent = tag;
        divTags.appendChild(etiqueta);
        etiqueta.addEventListener("click", (e) => {
          //el filter trae todos que sea distintos al que di click y lo sobreescribimos en tags
          tags = tags.filter((tag) => tag !== e.target.textContent);
          e.target.remove();
          actualizarValueInput();
        });
      });
    }

    function actualizarValueInput() {
      //agregamos el valor al input oculto para luego poder enviarlo a la BD
      tagsInputHidden.value = tags.toString();
    }
  }
})();
