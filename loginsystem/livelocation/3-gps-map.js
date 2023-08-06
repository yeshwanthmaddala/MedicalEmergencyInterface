// (A) INSERT ACCESS TOKEN HERE!
mapboxgl.accessToken = "pk.eyJ1Ijoic3llZHJhaG1hbjQxODkiLCJhIjoiY2wwenFrejRsMjZleDNsandhaWF2NzFyMiJ9.Qd0JZ8VjUZf3C2sOffvkKw";

// (B) GET GPS COORDINATES
navigator.geolocation.getCurrentPosition(
  // (B1) DRAW MAP
  (pos) => {
    // THE MAP
    let map = new mapboxgl.Map({
      container: "map",
      style: "mapbox://styles/mapbox/streets-v11",
      center: [pos.coords.longitude, pos.coords.latitude],
      zoom: 13
    });
    // ADD A MARKER
    let marker = new mapboxgl.Marker()
      .setLngLat([pos.coords.longitude, pos.coords.latitude])
      .addTo(map);
  },

  // (B2) ON FAILING TO GET GPS COORDINATES
  (err) => { console.error(err); },

  // (B3) GPS OPTIONS
  {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  }
);
