@extends('layouts.web')
@section('title',$show->name. ' - ')
@section('content')

@if (notify()->ready())
<script type="text/javascript">
    swal({
        title: "{!! notify()->message() !!}",
        text: "{!! notify()->option('text') !!}",
        icon: "{{ notify()->type() }}",
        //        if(notify() - > option('timer'))
        //        timer: {
        //            {
        //                notify() - > option('timer')
        //            }
        //        },
        //        showConfirmButton: false
        //        endif
    });

</script>
@endif
<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="no-padding-bottom clearfix">
    <div class="container big-font">


        <div class="col-md-8 col-md-offset-2">
            <div class="sidebar-widget clearfix ">
                <div class="card-user-profile-container ">
                    <div class="card-user-profile-inner dropshadow">

                        <h1 class="light text-center"><span>Informasi Pengguna</span></h1>
                        <div class="height40"></div>
                        <center>
                            <div class="card-user-profile-photo">
                                <img src="{{ asset($show->profilepic) }}" class="img-responsive img-circle marbot" style="width: 60% !important; height: 60% !important; ">
                            </div>
                            <div class="card-user-profile name">
                                <p style="font-size:130%;"><b>{{$show->name}}</b></p>
                            </div>
                            @if($show->role == 2)
                            @if($show->verifadmin == 0)
                            <label style="font-weight: normal; font-size: 80%;" class="label label-warning">Unverified</label>
                            <br>
                            @else
                            <label class="label label-success">Verified</label>
                            @endif
                            <br>
                            @endif
                            @if($show->role == 2)

                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="title">Bio</div>
                                    <div class="card-user-profile biography">{{$show->bio}}</div>
                                </div>
                            </div>
                            <div class="height20"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title">Email</div>
                                    <div class="card-user-profile email"><a href="mailto:{{$show->email}}">{{$show->email}}</a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title">No. HP</div>
                                    <div style="margin-bottom: 25px;" class="card-user-profile nohp"><a href="https://wa.me/{{$number}}">{{$show->nohp}}</a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title">Almamater</div>
                                    <div class="card-user-profile almamater">
                                        {{$show->lulusan}} ({{$show->tahunlulus}})
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title">Alamat</div>
                                    <div class="card-user-profile alamat">{{$show->alamat}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="title">Lokasi Klinik</div>
                                    <div class="card-user-profile klinik">
                                        {{$show->klinik}}
                                    </div>
                                    <div id="map"></div>
                                </div>
                            </div>

                            @else
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="title">Bio</div>
                                    <div class="card-user-profile biography">{{$show->bio}}</div>
                                </div>
                            </div>
                            @endif
                            
                            {{--@endif
                                @if(Auth::user()->role == 2)--}}
                            @if((Auth::user()) !== null)    
                                @if(Auth::user()->role == 2)
                            <div class="height20"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title">Email</div>
                                    <div class="card-user-profile email"><a href="mailto:{{$show->email}}">{{$show->email}}</a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title">No. HP</div>
                                    <div style="margin-bottom: 25px;" class="card-user-profile nohp"><a href="https://wa.me/{{$number}}">{{$show->nohp}}</a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="title">Alamat</div>
                                    <div class="card-user-profile alamat">{{$show->alamat}}</div>
                                </div>
                            </div>
                                @endif
                            @endif    
                            
                        </center>
                    </div>
                </div>
            </div>
        </div>

        <!--end sub-page-content-->
        @if(isset($lokasi))
        <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            function initAutocomplete() {
                center = {
                    lat: {!!$lokasi -> latitude!!},
                    lng: {!!$lokasi -> longtitude!!}
                }

                var map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });

                var marker = new google.maps.Marker({
                    position: center,
                    map: map
                });
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt6W1sdAMdssDXZPhq2-WLsNYPCPwjlYA&libraries=geometry,places&callback=initAutocomplete" async defer>
        </script>
        @endif

        @endsection
