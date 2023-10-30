@extends('layouts.web')
@section('title','Input Lokasi Klinik')
@section('content')

<div id="sub-page-content" class="clearfix">
    <div class="container">
        <div class="row form-login-ya">
           <div class="col-md-4">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix ">
                    <div class="card-user-profile-container ">
                        <div class="card-user-profile-inner dropshadow">
                            <center>
                                <div class="card-user-profile-photo">
                                    <img src="{{asset(Auth::user()->profilepic)}}" class="img-responsive img-circle marbot" style="width: 70% !important; height: 70% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{Auth::user()->name}}</b>
                                </div>
                                @if(Auth::user()->role == 2)
                                @if(Auth::user()->verifadmin == 0)
                                <label style="font-weight: normal; font-size: 80%;" class="label label-warning">Unverified</label>
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close pull-right" style="min-width: 10px;" data-dismiss="alert">&times;</button>
                                    <h4 class="text-center">Peringatan</h4>
                                    <p>Anda belum terverifikasi. Mohon lengkapi persyaratan agar akun anda dapat diverifikasi. Silahkan klik <a href="{{ url('setting/dokter') }}" class="alert-link">di sini</a> untuk melengkapi persyaratan. Banyak benefit yang anda dapatkan jika sudah terverifikasi. Silahkan baca keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">di sini</a>.</p>
                                </div>
                                @else
                                <label class="label label-success">Verified</label>
                                @endif
                                <br>
                                @endif

                                <div class="title">Bio</div>
                                <div class="card-user-profile biography">{{Auth::user()->bio}}</div>
                                <div class="title">Email</div>
                                <div class="card-user-profile email">{{Auth::user()->email}}</div>
                                <div class="title">No. HP</div>
                                <div class="card-user-profile nohp">{{Auth::user()->nohp}}</div>
                                <div class="title">Alamat</div>
                                <div class="card-user-profile alamat">{{Auth::user()->alamat}}</div>
                                @if(Auth::user()->role == 2)
                                <div class="title">Almamater</div>
                                <div class="card-user-profile almamater">
                                    {{Auth::user()->lulusan}} ({{Auth::user()->tahunlulus}})
                                </div>
                                <div class="title">Alamat Klinik</div>
                                <div class="card-user-profile klinik">
                                    {{Auth::user()->klinik}}
                                </div>
                                @endif
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 blog=-wrapper clearfix">
                @if(Auth::user()->role == 2)
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard#target')}}">Dashboard</a></li>
                    <li class="active"><a href="{{ url('#')}}">Ubah Profil</a></li>
                </ul>
                @endif
                <div class="height20"></div>
                <h2 class="text-center light"><span>Input Lokasi Klinik</span></h2>
                <div class="height20"></div>
                <div class="dropshadow well">
                <form class="form-horizontal" action="{{ route('savelokasi') }}" method="post">
                    {{ csrf_field() }}
                    <fieldset>
                    <input type="text" name="lat" id='lat' hidden>
                    <input type="text" name="long" id="long" hidden>

                    <div id="alamat-klinik" class="form-group">
                      <div class="row">
                       <label class="col-md-2 control-label" for="textinput">Alamat Klinik Sekarang</label>
                        @if($cekklinik)
                        <div class="col-md-10">
                            <input type="text" name="alamat" value="{{ $alamat }}" class="form-control" hidden></div>
                        @else
                        <div class="col-md-10"><input type="text" name="alamat" id="" placeholder="Alamat Klinik" required></div>
                        @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 control-label" for="selectbasic">Provinsi Klinik</label>
                    <div class="col-md-10">
                    <select name="provinsi" id="provinsi">
                        <option value="none">--Provinsi--</option>
                    </select>
                    <input type="text" name="namaprov" id="namaprov" hidden>
                    </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 control-label" for="selectbasic">Kabupaten/Kota Klinik</label>
                    <div class="col-md-10">
                    <select name="kabupaten" id="kabupaten">
                        <option value="none">--Kabupaten/Kota--</option>
                    </select>
                    <input type="text" name="namakabu" id="namakabu" hidden>
                        </div></div></div>
                    
                    <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 control-label" for="selectbasic">Kecamatan Klinik</label>
                    <div class="col-md-10">
                    <select name="kecamatan" id="kecamatan">
                        <option value="none">--Kecamatan--</option>
                    </select>
                    <input type="text" name="namakeca" id="namakeca" hidden>
                        </div></div></div>
                    </fieldset>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                       <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close pull-right" style="min-width: 10px;" data-dismiss="alert">&times;</button>
                                    <h4 class="text-center">Tata cara</h4>
                                    <p>Masukkan daerah lokasi klinik pada search box dibawah. Kemudian beri pin untuk menandai lokasi tersebut adalah lokasi klinik anda dengan cara klik pada maps.</p>
                                </div>
                        <input id="pac-input" class="controls" type="text" placeholder="Masukkan daerah lokasi klinik...">
                    </div>
                </div>
                <div id="map"></div>
                <div class="height20"></div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                                        <button type="submit" class="btn btn-md btn-primary">Input Lokasi</button>
                    </div>
                </div>
                </form>
                <div class="height40"></div>
                </div>
                <script type="text/javascript">
                    var markers = [];

                    function initAutocomplete() {

                        //Call the province's names
                        namaprovinsi();

                        //throw the error message
                        @if(isset($message))
                        console.log('{!! $message !!}');
                        @endif

                        //conditional for existing location
                        @if($pinned != null)
                        var pinned = {
                            lat: parseFloat({!!$pinned['lat'] !!}),
                            lng: parseFloat({!!$pinned['long'] !!}),
                        };
                        var newCenter = new google.maps.LatLng(pinned);
                        @else
                        newCenter = null;
                        @endif

                        //init map            
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: -3.4171,
                                lng: 120.7330
                            },
                            zoom: 4,
                            mapTypeId: 'roadmap'
                        });

                        if (newCenter != null) {
                            map.setZoom(16);
                            map.setCenter(newCenter);
                            var marker = new google.maps.Marker({
                                position: newCenter,
                                map: map
                            });
                            markers.push(marker);
                        }

                        // Create the search box and link it to the UI element.          
                        var input = document.getElementById('pac-input');
                        var searchBox = new google.maps.places.SearchBox(input);
//                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


                        // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                        });

                        //Some functions for click, add marker, and delete the marker
                        map.addListener('click', function(event) {
                            if (markers.length > 0) {
                                for (var i = 0; i < markers.length; i++) {
                                    markers[i].setMap(null);
                                }
                                markers = [];
                            }

                            var marker = new google.maps.Marker({
                                position: event.latLng,
                                map: map
                            });
                            markers.push(marker);

                            document.getElementById('lat').value = event.latLng.lat();
                            document.getElementById('long').value = event.latLng.lng();
                        });


                        // Listen for the event fired when the user selects a prediction and retrieve
                        // more details for that place.
                        searchBox.addListener('places_changed', function() {
                            var places = searchBox.getPlaces();

                            if (places.length == 0) {
                                return;
                            }

                            document.getElementById('lat').value;
                            document.getElementById('long').value;

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
                            map.fitBounds(bounds);
                        });
                    }

                    //Jquery to add listener for change selected tag
                    $("#provinsi").change(function() {
                        $('#kabupaten').html("<option value='none'>--Kabupaten/Kota--</option>");
                        $('#kecamatan').html("<option value='none'>--Kecamatan--</option>");

                        str = $('#provinsi').val();
                        if (str != "none") {
                            id = $('#provinsi').val();
                            nama = $('select[name=provinsi]').find('option[value="' + id + '"]').text();
                            $('#namaprov').val(nama);
                            namakota(id);
                        }
                    });

                    $("#kabupaten").change(function() {
                        $('#kecamatan').html("<option value='none'>--Kecamatan--</option>");

                        str = $('#kabupaten').val();
                        if (str != "none") {
                            id_prov = $('#provinsi').val();
                            id_kabu = $('#kabupaten').val();
                            nama = $('select[name=kabupaten]').find('option[value="' + id_kabu + '"]').text();
                            $('#namakabu').val(nama);
                            namakecamatan(id_kabu);
                        }
                    });

                    $("#kecamatan").change(function() {
                        id_keca = $('#kecamatan').val();
                        nama = $('select[name=kecamatan]').find('option[value="' + id_keca + '"]').text();
                        $('#namakeca').val(nama);
                    });

                    // Functions for calling the name of province, city, kecamatan

                    function namaprovinsi() {
                        $.get("{{route('cariprovinsi')}}", function(data) {
                            $.each(data, function(index, value) {
                                $('#provinsi').append("<option value='" + value.id + "'>" + value.provname + "</option>");
                            });
                        });
                    }

                    function namakota(id_prov) {
                        $.get("{{route('carikota')}}?id=" + id_prov, function(data) {
                            $.each(data, function(index, value) {
                                $('#kabupaten').append("<option value='" + value.kotid + "'>" + value.kotname + "</option>");
                            });
                        });
                    }

                    function namakecamatan(id_kabu) {
                        $.get("{{route('carikecamatan')}}?id=" + id_kabu, function(
                            data) {               
                            $.each(data, function(index, value) {
                                $('#kecamatan').append("<option value='" + value.id + "'>" + value.kecname + "</option>");
                            });
                        });
                    }

                    //change p's tag into input's tag
                    $('#ubah').click(function() {
                        alamatlama = $('#alamatlama').html();
                        $('#alamat-klinik').html(
                            "<input type='text' name='alamat' value='" + alamatlama + "' placeholder='Alamat Praktik' required>"
                        );
                    });

                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt6W1sdAMdssDXZPhq2-WLsNYPCPwjlYA&libraries=geometry,places&callback=initAutocomplete" async defer></script>

            </div>
        </div>
    </div>
</div>
@endsection
