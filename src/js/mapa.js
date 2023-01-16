if (document.querySelector("#mapa")) {
  const lat = -31.743201;
  const lng = -60.539575;
  const zoom = 16;

  var map = L.map("mapa").setView([lat, lng], zoom);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  L.marker([lat, lng])
    .addTo(map)
    .bindPopup(
      `
      <a target="_blank" href="https://www.google.com.ar/maps/place/31%C2%B044'35.5%22S+60%C2%B032'22.5%22W/@-31.743201,-60.5401222,19z/data=!3m1!4b1!4m5!3m4!1s0x0:0xc6aa18ecb4a9c354!8m2!3d-31.743201!4d-60.539575">
         <h2 class="mapa__heading">DevWeBCamp</h2>
        <h3 class="mapa__texto">Paraná, Entre Rios.</h3>
        <p class="mapa__coord">${lat}, ${lng}</p>
      </a>
   `
    )
    .openPopup();
}
