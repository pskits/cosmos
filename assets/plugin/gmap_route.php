<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjXsLjLDmUl9E6Xza1frZpOywrL6i6lWk&callback=initMap&libraries=&v=weekly" defer></script>
<style>
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
  #gmap_route {
    height: 50vh;
    width: 100%;
  }

  .labelClass {
    margin-left: 5px;
  }
</style>
<script>
  function initMap() {
    var start_lat = Number(document.getElementById("route_start_lat").value);
    var start_lng = Number(document.getElementById("route_start_lng").value);
    var waypoints_lat = document.getElementsByClassName("route_end_lat");
    var waypoints_lng = document.getElementsByClassName("route_end_lng");
    const waypts = [];
    for (let i = 0; i < waypoints_lat.length; i++) {
      if (i == (waypoints_lat.length - 1)) {
        //final location is set as end location
        var end_lat = Number(waypoints_lat[i].value);
        var end_lng = Number(waypoints_lng[i].value);
      } else {
        waypts.push({
          location: new google.maps.LatLng(Number(waypoints_lat[i].value), Number(waypoints_lng[i].value)),
          stopover: true,
        });
      }



    }

    const directionsRenderer = new google.maps.DirectionsRenderer();
    const directionsService = new google.maps.DirectionsService();
    const map = new google.maps.Map(document.getElementById("gmap_route"), {
      zoom: 8,
      center: {
        lat: start_lat,
        lng: end_lng
      }
    });
    directionsRenderer.setMap(map);
    directionsService.route({
        origin: {
          lat: start_lat,
          lng: start_lng
        },
        destination: {
          lat: end_lat,
          lng: end_lng
        },
        waypoints: waypts,
        optimizeWaypoints: true,
        // provideRouteAlternatives:true,
        unitSystem: google.maps.UnitSystem.METRIC,
        // draggable: true,
        travelMode: google.maps.TravelMode.DRIVING,
      },
      (response, status) => {
        if (status == "OK") {
          directionsRenderer.setDirections(response);
          var my_route = response.routes[0];

          var marker = new google.maps.Marker({
            position: my_route.legs['0'].start_location,
            title: 'Warehouse',
            label: "Warehouse",
            map: map
          });



        } else {
          window.alert("Directions request failed due to " + status);
        }
      }
    );
  }

  function createMarker(latlng, title, label) {

    if (label == 0) {
      label = "";
    }
    //console.log(label);
    var marker = new google.maps.Marker({
      position: latlng,
      title: title,
      label: "" + label + "",
      map: map
    });
    var infowindow = new google.maps.InfoWindow;
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(title);
      infowindow.open(map, marker);
    });
  }
</script>