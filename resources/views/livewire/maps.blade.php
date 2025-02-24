<div wire:ignore>
    <div id="map" style="height: 500px; width: 100%;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>

    <script>
        
        // document.addEventListener('livewire:load', function () {
        //     Livewire.on('refreshMap', function () {
        //         initMap();
        //     });

        //     initMap(); // Ensure it initializes on first load
        // });

         document.addEventListener("DOMContentLoaded", function () {
            initMap();
        });
        
        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        var userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: userLocation,
                            zoom: 18
                        });

                        new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "You are here"
                        });
                    },
                    function () {
                        alert("Geolocation failed. Please allow location access.");
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</div>
