@extends('layouts.web')
@section('title','Cari Dokter Hewan')
@section('content')



<div id="sub-page-content" class="clearfix">
    <div class="container">
        <div class="row form-login-ya">
            <div class="col-sm-8 col-sm-offset-2">
                <h1 id="title-map" class="text-center light"><span>Cari Lokasi Dokter</span></h1>
                <div class="height20"></div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input id="pac-input" class="controls" type="text" placeholder="Masukkan daerah yang ingin dicari...">
                    </div>
                </div>
                <div class="height20"></div>

                <div id="map"></div>
                <script>
                    // This example adds a search box to a map, using the Google Place Autocomplete
                    // feature. People can enter geographical searches. The search box will return a
                    // pick list containing a mix of places and predicted search terms.

                    // This example requires the Places library. Include the libraries=places
                    // parameter when you first load the API. For example:
                    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                    function initAutocomplete() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: -3.4171,
                                lng: 120.7330
                            },
                            zoom: 4,
                            mapTypeId: 'roadmap'
                        });

                        // Create the search box and link it to the UI element.
                        var input = document.getElementById('pac-input');
                        var searchBox = new google.maps.places.SearchBox(input);
//                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                        // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                        });

                        var markers = [];
                        // Listen for the event fired when the user selects a prediction and retrieve
                        // more details for that place.
                        searchBox.addListener('places_changed', function() {
                            var places = searchBox.getPlaces();

                            if (places.length == 0) {
                                return;
                            }

                            // Clear out the old markers.
                            markers.forEach(function(marker) {
                                marker.setMap(null);
                            });
                            markers = [];

                            // For each place, get the icon, name and location.
                            var bounds = new google.maps.LatLngBounds();
                            places.forEach(function(place) {
                                if (!place.geometry) {
                                    console.log("Returned place contains no geometry");
                                    return;
                                }

                                if (place.geometry.viewport) {
                                    // Only geocodes have viewport.
                                    bounds.union(place.geometry.viewport);
                                } else {
                                    bounds.extend(place.geometry.location);
                                }
                            });

                            var datauri = document.getElementById('pac-input').value;
                            console.log(datauri);
                            datauri = datauri.split(', ');
                            if (datauri.length >= 3) {
                                var lokasi = encodeURI(datauri[datauri.length - 3]);
                                var regency = 1;
                            } else if (datauri.length > 1) {
                                var lokasi = encodeURI(datauri[datauri.length - 2]);
                                var regency = 0;
                            } else {
                                lokasi = "";
                                regency = 0;
                            }

                            console.log(lokasi);

                            $.get("/carilokasi/request?lokasi=" + lokasi + "&regency=" + regency, function(data) {

                                $.each(data, function(index, value) {
                                    console.log(value);
                                    if (value['latitude'] != '' && value['longtitude'] != '') {
                                        // Set the coordonates of the new point
                                        var lati = parseFloat(value['latitude']);
                                        var long = parseFloat(value['longtitude']);
                                        var latLng = new google.maps.LatLng(lati, long);

                                        // Initialize the new marker
                                        var marker = (new google.maps.Marker({
                                            map: map,
                                            title: value.name,
                                            position: latLng
                                        }));

                                        var profilepic = "{{ asset(':alamat') }}"
                                        profilepic = profilepic.replace(':alamat', value.profilepic);

                                        var home = "{{ url('/user/:id') }}";
                                        home = home.replace(':id', value.id);
                                        var windowmarker = (
                                           
"<div class='row'>" +
    "<div class='col-sm-10'>" +
        "<div class='col-xs-2 col-sm-2 col-md-2 ' style='max-width:86px; min-width:86px;'>" +
            "<a href='#'><img src='" + profilepic + "' class='img-responsive img-circle marbot' style='width: 56px !important; height: 56px !important;'></a>" +
            "</div>" +
        "<div class='col-xs-8 col-sm-6 col-md-6'>" +
            "<p class='marsot question-title'><b>" + value.name + "</b></p>" +
            "<a href='" + home + "' style='text-transform: none;'>View Profile</a>" +
            "</div></div></div>"
                                        );

                                        var infowindow = new google.maps.InfoWindow({
                                            content: windowmarker
                                        });

                                        marker.addListener('click', function() {
                                            infowindow.open(map, marker);
                                        });

                                        markers.push(marker);
                                    }
                                });
                            });

                            map.fitBounds(bounds);
                        });
                    }

                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB-SkwLxdK8QlEUaht7jjwbAXPQxXNkG0&libraries=geometry,places&callback=initAutocomplete" async defer></script>

            </div>
        </div>
    </div>
</div>
@endsection