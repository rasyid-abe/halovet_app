@extends('layouts.web')
@section('title','Dashboard')
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
                            </center>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Archives
							============================================= -->




            <div id="target" class="col-md-8 blog-wrapper clearfix">
                @if(Auth::user()->role == 2)
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard#target')}}">Konsultasi</a></li>
                    <li><a href="{{ url('dashboard/pemeriksaan#target') }}">Ambulatoir</a></li>
                    <li class="active"><a href="{{ url('#')}}">Artikel Saya</a></li>
                    <li><a href="{{ url('dashboard/peliharaan')}}">Peliharaan Saya</a></li>
                    <li><a href="{{ url('setting/dokter') }}">Pengaturan Dokter</a></li>
                </ul>
                @else

                @endif

                <div class="height20"></div>

                <h2 class="text-center light"><span>Artikel Saya</span></h2>
                <div class="height20"></div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{ url('dashboard/post/new#target') }}" class="btn-default btn-outline hvr-shutter-out-horizontal make-question text-center" data-aos="fade-up" data-aos-duration="1500"><i class="fas fa-pencil-alt"></i> Tulis Artikel</a>
                    </div>
                </div>
                <div class="height20"></div>





                @foreach($allpost as $a)
                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-xs-2 col-sm-2 col-md-2 " style="max-width:86px; min-width:86px;">
                        <a href="{{ url('') }}"><img src="{{asset($a->artthumbnail)}}" class="img-responsive img-circle" style="width: 56px !important; height: 56px !important;"></a>

                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10">
                        <p class="marsot question-title"><a href="{{ url('') }}"><b>Judul: {{$a->artjudul}}</b></a></p>
                        <p class="marsot" style="font-size:14px;">Kategori: <b>{{$a->catname}}</b>
                        </p>
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {{strip_tags(substr($a->artisi,0,200))}}...
                        </div>
                    </div>
                </div>
                <div class="height20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="float: right;">
                            <a href="{{ url('dashboard/post/edit/'.$a->artid) }}" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{ url('artikel/'.$a->artslug) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                            <a class="btn btn-danger btn-sm" id="delete-btn" href="{{ url('adminix/artikel/delete/'.$a->artid) }}"><i class="fa fa-trash-o"></i> Hapus</a>
                        </div>
                    </div>
                </div>


                <hr>
                @endforeach

                {{$allpost->links()}}
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
