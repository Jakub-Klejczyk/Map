const map = L.map("map").setView([51.9194, 19.3], 6.5);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution: "© OpenStreetMap",
}).addTo(map);

const dataJst = L.geoJSON(jst, {
  pointToLayer: function (feature, latlng) {
    const smallIcon = new L.Icon({
      iconUrl: "./assets/pin.svg",
      iconSize: [30, 30],
    });
    return L.marker(latlng, { icon: smallIcon });
  },
  onEachFeature(feature, layer) {
    layer.bindPopup(`<h3 class='title'>${feature.properties.name}</h3>
    <ul class="doc-container">
      <li class="doc-item"> ${feature.properties.document}</li>
    </ul>`);

    layer.on("mouseover", function (e) {
      this.openPopup();
    });
    layer.on("mouseout", function (e) {
      this.closePopup();
    });
  },
});
dataJst.addTo(map);

const dataCorps = L.geoJSON(corps, {
  pointToLayer: function (feature, latlng) {
    const smallIcon = new L.Icon({
      iconUrl: "./assets/pin2.svg",
      iconSize: [30, 30],
    });
    return L.marker(latlng, { icon: smallIcon });
  },
  onEachFeature(feature, layer) {
    layer.bindPopup(`<h2 class='title'>${feature.properties.name}</h2>
    <ul class="doc-container">
      <li class="doc-item"> ${feature.properties.document}</li>
    </ul>`);

    layer.on("mouseover", function (e) {
      this.openPopup();
    });
    layer.on("mouseout", function (e) {
      this.closePopup();
    });
  },
});
dataCorps.addTo(map);

const dataNgos = L.geoJSON(ngos, {
  pointToLayer: function (feature, latlng) {
    const smallIcon = new L.Icon({
      iconUrl: "./assets/pin3.svg",
      iconSize: [30, 30],
    });
    return L.marker(latlng, { icon: smallIcon });
  },
  onEachFeature(feature, layer) {
    layer.bindPopup(`<h2 class='title'>${feature.properties.name}</h2>
    <ul class="doc-container">
      <li class="doc-item"> ${feature.properties.document}</li>
    </ul>`);

    layer.on("mouseover", function (e) {
      this.openPopup();
    });
    layer.on("mouseout", function (e) {
      this.closePopup();
    });
  },
});
dataNgos.addTo(map);

const overlayMaps = {
  "Jednostki samorządowe": dataJst,
  Firmy: dataCorps,
  "Organizacje pozarządowe": dataNgos,
};

L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);

fetch("res.php")
  .then(function (res) {
    return res.json();
  })
  .then(function (data) {
    console.log(data);
  });
