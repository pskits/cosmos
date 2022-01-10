    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjXsLjLDmUl9E6Xza1frZpOywrL6i6lWk&callback=initMap&libraries=&v=weekly" defer></script>
    <style type="text/css">
        #gmap_latlong {
            height: 50vh;
        }
    </style>
    <script>
        $('#geo').attr("autocomplete", "off");
        function gmap_latlong_modal() {
            if ($('#gmap_latlong_modal').is(':visible')) {
                $("#gmap_latlong_modal").hide();
            } else {
                $("#gmap_latlong_modal").show();
            }
            var myLatlng = {
                lat: 21.629113479422994,
                lng: 53.1226570572483
            };
            if (navigator.geolocation) {
                var geoLatlng = null;
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geoLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    initMap(geoLatlng);
                });
                if (geoLatlng == null) {
                    // alert("Current Geo Location is Not Allowed");
                    initMap(myLatlng);
                }
            } else {
                alert("Geolocation is not supported by this browser");
                initMap(myLatlng);
            }
        }
        function initMap(Latlng) {
            data = Latlng;
            if (!(document.getElementById('geo').value)) {
                $('#lat').val(data.lat);
                $('#lng').val(data.lng);
                data = JSON.stringify(data);
                document.getElementById('geo').value = data;
            }
            const map = new google.maps.Map(document.getElementById("gmap_latlong"), {
                zoom: 4,
                center: data,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: Latlng,
            });
            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                data = mapsMouseEvent.latLng.toJSON();
                infoWindow.open(map);
                $('#lat').val(data.lat);
                $('#lng').val(data.lng);
                data = JSON.stringify(data)
                document.getElementById('geo').value = data;
            });
        }
    </script>
    <div class="modal" id="gmap_latlong_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Locate GMAP</h4>
                    <button type="button" class="close" onclick="gmap_latlong_modal();">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p id="gmap_latlong"></p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="gmap_latlong_modal();">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>