@extends('layouts.web')
@section('title','Dashboard - ')
@section('content')
<script type="text/javascript" src="{{asset('jquery.gmap.js')}}"></script>

<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
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
                                    {{$show->lulusan}} ({{$show->tahunlulus}})
                                </div>
                                <div class="title">Alamat Klinik</div>
                                <div class="card-user-profile klinik">
                                    {{Auth::user()->klinik}}
                                </div>
                                @endif
                                <div class="col-md-12" data-aos="fade-up" data-aos-duration="1500">
                                    <a href="{{ url('setting#target') }}" target="_blank" class="btn btn-lg btn-primary rounded-border" style="text-transform:none;">Ubah Profil</a>
                                    <div class="height20"></div>
                                    @if(Auth::user()->role == 2)
                                     @if(Auth::user()->verifadmin == 1)
                                    <a href="{{ url('/taglokasi') }}" target="_blank" class="btn btn-lg btn-warning rounded-border" style="text-transform:none;">Input Lokasi Klinik</a>
                                    @endif
                                    @endif
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-8 blog-wrapper clearfix">
                @if(Auth::user()->role == 2)
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">Konsultasi</a></li>
                    <li><a href="{{ url('dashboard/pemeriksaan#target') }}">Ambulatoir</a></li>
                    <li><a href="{{ url('dashboard/post#target')}}">Artikel Saya</a></li>
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                    <li><a href="{{ url('setting/dokter#target') }}">Pengaturan Dokter</a></li>
                </ul>
                @else
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">Pertanyaan Saya</a></li>
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                </ul>
                @endif


                <div class="height40"></div>


                @if(Auth::user()->role == 2)
                @foreach($timeline as $k)

                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-xs-2 col-sm-2 col-md-2 " style="max-width:86px; min-width:86px;">
                        <a href="{{ url('konsultasi/'.$k->konsslug) }}"><img src="{{asset($k->profilepic)}}" class="img-responsive img-circle marbot" style="width: 56px !important; height: 56px !important;"></a>

                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10">
                        <p class="marsot question-title"><a href="{{ url('konsultasi/'.$k->konsslug) }}"><b>{{$k->konsjudul}}</b></a></p>
                        <p class="marsot" style="font-size:14px;">Oleh: <b>{{$k->name}}</b>
                            <small class="visible-xs-block hidden-sm hidden-md hidden-lg">Diposting pada {{date("d-m-Y", strtotime($k->konsdate))}}
                            </small>

                            <span class="hidden-xs"><small style="float: right;">Diposting pada {{date("d-m-Y", strtotime($k->konsdate))}}
                                </small></span>
                        </p>
                        @if($k->konstatus == 1)
                        @else
                        <img src="{{asset('icon/checked.svg')}}" alt="" style="width:14px; height:14px;">
                        <span class="label label-success" style="font-weight:normal !important;">Sudah dibalas oleh Dokter</span>
                        @endif
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {{strip_tags(substr($k->konsisi,0,200))}}...
                        </div>
                        <div class="height20"></div>
                        <a href="{{ url('konsultasi/'.$k->konsslug) }}" style="float: right !important;" class="btn btn-mini btn-default btn-rounded hvr-glow">Baca Lebih Lanjut</a>
                    </div>
                </div>

                <hr>
                @endforeach

                {{$timeline->links()}}

                @else

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{ url('konsultasi/baru') }}" class="btn-default btn-outline hvr-shutter-out-horizontal make-question text-center" data-aos="fade-up" data-aos-duration="1500"><i class="fas fa-pencil-alt"></i> Buat Pertanyaan</a>
                    </div>
                </div>
                <div class="height40"></div>

                @foreach($timeline as $uks)
                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-xs-2 col-sm-2 col-md-2 " style="max-width:86px; min-width:86px;">
                        <a href="{{ url('konsultasi/'.$uks->konsslug) }}"><img src="{{ asset($uks->profilepic)}}" class="img-responsive img-circle marbot" style="width: 56px !important; height: 56px !important;"></a>

                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10">
                        <p class="marsot question-title"><a href="{{ url('konsultasi/'.$uks->konsslug) }}"><b>{{$uks->konsjudul}}</b></a></p>
                        <p class="marsot" style="font-size:14px;">Oleh: <b>{{$uks->name}}</b>
                            <small class="visible-xs-block hidden-sm hidden-md hidden-lg">Diposting pada {{date("d-m-Y", strtotime($uks->konsdate))}}
                            </small>

                            <span class="hidden-xs"><small style="float: right;">Diposting pada {{date("d-m-Y", strtotime($uks->konsdate))}}
                                </small></span>
                        </p>
                        @if($uks->konstatus == 1)
                        @else
                        <img src="{{asset('icon/checked.svg')}}" alt="" style="width:14px; height:14px;">
                        <span class="label label-success" style="font-weight:normal !important;">Sudah dibalas oleh Dokter</span>
                        @endif
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {{strip_tags(substr($uks->konsisi,0,200))}}...
                        </div>
                        <div class="height20"></div>
                        <a href="{{ url('konsultasi/'.$uks->konsslug) }}" style="float: right !important;" class="btn btn-mini btn-default btn-rounded hvr-glow">Baca Lebih Lanjut</a>
                    </div>
                </div>
                <hr>
                @endforeach
                {{$timeline->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

<!--end sub-page-content-->


@endsection
