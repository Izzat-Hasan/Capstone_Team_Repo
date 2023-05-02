<?php require APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html>
  <head>
  <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #484848;
      }
      #zipcode-form {
        color:#fff;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 10px;
      }
      #zipcode-form label {
        margin-right: 10px;
      }
      #zipcode {
        padding: 5px 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 5px;
      }
      #zipcode-form button {
        padding: 5px 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #484848; /* Change background color to grey */
        color: white;
        cursor: pointer;
        margin-left: 10px;
        transition: background-color 0.5s; /* Add a transition effect */
      }
      #zipcode-form button:hover {
        background-color: #696969; /* Change background color on hover */
      }
      #map-container {
        height: 750px;
        width: 100%;
      }
      #map {
        height: 100%;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <form id="zipcode-form">
      <label for="zipcode">Enter Zip Code:</label>
      <input type="text" id="zipcode" name="zipcode" required>
      <button type="submit">Search</button>
    </form>
    <div id="map-container">
      <div id="map"></div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkfhsssD43_leiFj6Wd2i4Cm8FXNqJd9A&libraries=places"></script>
    <script>
      // Initializes the map
      var map;
      function initMap() {
        // Default map center
        var defaultCenter = { lat: 37.7749, lng: -122.4194 }; // Default center to San Francisco

        // Use user's geolocation if available
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            defaultCenter = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            map.setCenter(defaultCenter);
          });
        }

        map = new google.maps.Map(document.getElementById('map'), {
          center: defaultCenter,
          zoom: 12
        });

        document.getElementById('zipcode-form').addEventListener('submit', function(event) {
          event.preventDefault();
          var zipcode = document.getElementById('zipcode').value;
          searchByZipcode(zipcode);
        });
      }

      function searchByZipcode(zipcode) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': zipcode }, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            var pos = {
              lat: results[0].geometry.location.lat(),
              lng: results[0].geometry.location.lng()
            };
            map.setCenter(pos);

            // Create a PlacesService object to use the Places API
            var service = new google.maps.places.PlacesService(map);

            // Search for homeless shelters in the specified zip code
            service.nearbySearch({
              location: pos,
              radius: 5000, // 5km radius as an example
              type: ['church']
            }, callback);
          } else {
            alert('Error: Geocode was not successful for the following reason: ' + status);
          }
        });
      }

      // Callback function to handle the results from the PlacesService nearbySearch request
      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            // Create a marker for each shelter and add it to the map
            var marker = new google.maps.Marker({
              position: results[i].geometry.location,
              map: map
            });

            // Create an info window for each marker that displays additional information about the shelter
            var infoWindow = new google.maps.InfoWindow({
              content: '<h3>' + results[i].name + '</h3>' +
                       '<p><strong>Address:</strong> ' + results[i].vicinity + '</p>' +
                       '<p><strong>Rating:</strong> ' + (results[i].rating || 'N/A') + '</p>'
            });

            // Add a click event listener to the marker to display the info window
            addInfoWindowClickListener(marker, infoWindow);
          }
        }
      }

      //
      // Function to handle the click event listener for each marker
      function addInfoWindowClickListener(marker, infoWindow) {
        marker.addListener('click', function() {
          infoWindow.open(map, marker);
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkfhsssD43_leiFj6Wd2i4Cm8FXNqJd9A&libraries=places&callback=initMap"></script>
  </body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>

