addEventListener("DOMContentLoaded", function () {
  setTimeout(() => {
    activarInputs();
  });
  styleSeleccionarArchivo();
});

function activarInputs() {
  const inputs = document.querySelectorAll(".formulario__input");

  inputs.forEach((input) => {
    //cuando carga lapagina verificamos si tiene contenido proveniente de PHP
    if (input.value) {
      input.classList.add("active");
    }

    //Le asigno el evento de change a cada input
    input.addEventListener("change", (e) => {
      if (e.target.value) {
        input.classList.add("active");
      } else {
        input.classList.remove("active");
      }
    });
  });
}

function styleSeleccionarArchivo() {
  //si el formulario tiene un selector de archivos...
  const fileSelector = document.getElementById("imagen");

  if (fileSelector) {
    fileSelector.addEventListener("change", (e) => {
      const btnFile = e.target.parentNode.parentNode;
      console.log(btnFile);
      const fileName = e.target.files[0].name;

      const labelAnterior = document.getElementById("label");
      if (labelAnterior) {
        labelAnterior.remove();
      }
      const label = document.createElement("LABEL");
      label.classList.add("formulario__label--normal");
      label.setAttribute("id", "label");
      label.textContent = fileName;
      btnFile.appendChild(label);

      //actualizar imagen
      const divImagen = document.querySelector(".formulario__imagen--div");
      //1ero remuevo la anterior
      const picture = document.querySelector(".formulario__picture");
      if (picture) {
        divImagen.removeChild(picture);
      }
      const imgAnterior = document.querySelector(".formulario__imagen");
      if (imgAnterior) {
        divImagen.removeChild(imgAnterior);
      }

      const imgPreview = document.createElement("IMG");
      imgPreview.classList.add("formulario__imagen");
      objectURL = URL.createObjectURL(e.target.files[0]);
      console.log(objectURL);
      imgPreview.src = objectURL;

      divImagen.appendChild(imgPreview);
    });
  }
}
