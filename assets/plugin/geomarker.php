
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjXsLjLDmUl9E6Xza1frZpOywrL6i6lWk&libraries=&v=weekly"
        async></script>
<style type="text/css">
        /* Set the size of the div element that contains the map */
        #maplocator {
            height: 400px;
            width: 100%;
        }
    </style>
    <script>
        // Initialize and add the map
        function loadmap(latval,lngval) {
            // The location of Uluru
            const uluru = { lat: latval, lng: lngval };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("maplocator"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
 
