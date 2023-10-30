@extends('layouts.web')
@section('title','Dashboard')
@section('content')
<script type="text/javascript" src="{{asset('jquery.gmap.js')}}"></script>

<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            <aside class="col-md-4">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix">

                    <center>
                        <img src="{{Auth::user()->profilepic}}" class="img-responsive">
                        <b>{{Auth::user()->name}}</b>
                    </center>
                    @if(Auth::user()->role == 2)
                    @if(Auth::user()->verifadmin == 0)
                    <center><label class="label label-warning">Unverified</label></center>
                    <div class="alert alert-dismissible alert-warning">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b>Anda Belum Terverifikasi</b>
                        <p>Mohon lengkapi persyaratan agar akun anda dapat diverifikasi silahkan klik <a href="{{ url('setting/dokter') }}">disini</a> untuk melengkapi persyaratan, banyak benefit yang anda dapatkan jika sudah terverifikasi silahkan baca >keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">Klik Disini</a>.</p>
                    </div>
                    @else
                    <label class="label label-success">Verified</label>
                    @endif
                    @endif

                </div>


                <!-- Recent posts
							============================================= -->
                <div class="sidebar-widget light">
                    <center>
                        @if(Auth::user()->role == 2)
                        <a href="{{ url('dashbard/post/new') }}" class="btn btn-info">Buat Artikel</a>
                        @else
                        @endif
                        <a href="{{ url('konsultasi/baru') }}" class="btn btn-primary">Buat Pertanyan</a>
                        <a href="{{ url('setting') }}" class="btn btn-warning">Ubah Profil</a>
                        <a href="{{ url('message') }}" class="btn btn-danger">Kotak Pesan</a>
                    </center>

                </div>


                <!-- Archives
							============================================= -->
                <div class="sidebar-widget clearfix">


                </div>

                <div class="sidebar-widget clearfix">



                </div>

            </aside>

            <div class="col-md-8 blog-wrapper clearfix">

                <h2 class="bordered light">Timeline</h2>

                @foreach($allper as $a)
                <div class="row">
                    <div class="col-md-3">
                        <center>
                            <img src="{{$a->profilepic}}" style="width: 100px; height: 100px;" class="img-responsive img-circle">
                        </center>
                    </div>
                    <div class="col-md-9">
                        <h6>{{$a->name}}</h6>
                        @if($a->verifadmin == 1)
                        <label class="label label-success">Verified</label>
                        @else
                        <label class="label label-warning">Unverified</label>
                        @endif
                        <p>Alamat Praktek / Klinik : {{$a->alamat}}
                            @if(!is_null($a->kotname))
                            {{$a->kotname}}
                            @else
                            @endif</p>
                        <p>Bio : {{$a->bio}}<br>
                            Almamater : {{$a->lulusan}} ({{$a->tahunlulus}})</p>
                    </div>
                </div>
                @endforeach

                {{$alldok->links()}}




            </div>




        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
