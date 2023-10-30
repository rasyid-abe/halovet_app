@extends('layouts.web')
@section('title','Hewan Peliharaan Saya - ')
@section('content')
<script type="text/javascript" src="{{asset('jquery.gmap.js')}}"></script>
<!-- Sub Page Content ============================================= -->
<div id="sub-page-content" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Categories Widget ============================================= -->
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
            <div id="target" class="col-md-8 blog-wrapper clearfix">
                @if(Auth::user()->role == 2)
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard#target')}}">Konsultasi</a></li>
                    <li><a href="{{ url('dashboard/pemeriksaan#target') }}">Ambulatoir</a></li>
                    <li><a href="{{ url('dashboard/post#target')}}">Artikel Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Peliharaan Saya</a></li>
                    <li><a href="{{ url('setting/dokter') }}">Pengaturan Dokter</a></li>
                </ul>
                @else
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard#target')}}">Pertanyaan Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Peliharaan Saya</a></li>
                </ul>
                @endif
                <div class="height20"></div>

                <h3 class="light text-center"><span>Hewan Peliharaan Saya</span></h3>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{ url('dashboard/peliharaan/new#target') }}" class="btn-default btn-outline hvr-shutter-out-horizontal make-question text-center" data-aos="fade-up" data-aos-duration="1500"><i class="fas fa-plus"></i> Tambah Peliharaan</a>
                    </div>
                </div>
                <div class="height40"></div>
                <div class="row marbot">
                    @foreach($mypet as $k)
                    <div class="col-md-6">
                        <div class="dropshadow card-user-profile-container blog-item">
                            <div class="card-user-profile-inner ">
                                <center>
                                    <div class="card-user-profile-photo">
                                        <img src="{{asset($k->petphoto)}}" class="img-responsive img-circle marbot" style="width: 50%; height: 50%;">
                                    </div>
                                    <div class="card-user-profile name">
                                        <b>{{$k->petname}}
                                            @if($k->petsex == 1)
                                            <img src="{{ url('icon/male.png') }}" width="24" height="24">
                                            @else
                                            <img src="{{ url('icon/female.png') }}" width="24" height="24">
                                            @endif
                                        </b>
                                    </div>
                                    <label class="label label-primary">Pet Code : {{$k->petcode}}</label>
                                    <br>
                                    <br>
                                    <div class="title">Breed</div>
                                    <div class="card-user-profile warna">{{$k->petbreed}}</div>
                                    <div class="title">Pet Age</div>
                                    <div class="card-user-profile warna">@php $a = floor((time() - strtotime('.$k->petage.')) / 31556926);
                                     echo $a; @endphp</div>
                                    <div class="title">Warna Hewan</div>
                                    <div class="card-user-profile warna">{{$k->petcolor}}</div>
                                    <div class="title">Berat Hewan</div>
                                    <div class="card-user-profile warna">{{$k->petweight}} Kg</div>
                                    <div class="title">Jenis Hewan</div>
                                    <div class="card-user-profile warna">@if($k->pettype == 1)
                                        Mamalia - {{$k->petdetail}}
                                        @elseif($k->pettype == 2)
                                        Reptil - {{$k->petdetail}}
                                        @elseif($k->pettype == 3)
                                        Unggas - {{$k->petdetail}}
                                        @elseif($k->pettype == 4)
                                        Amfibi - {{$k->petdetail}}
                                        @else
                                        Lainnya - {{$k->petdetail}}
                                        @endif
                                    </div>
                                    <div class="title">Status</div>
                                    <div class="card-user-profile warna">@if($k->petvaksin == 1)
                                    Sudah Vaksin
                                        @else
                                        Belum / Tidak Vaksin
                                        @endif
                                    </div>
                                    <div class="title">Ciri Hewan</div>
                                    <div class="card-user-profile warna">{{$k->petciri}}</div>
                                    <a href="{{ url('dashboard/peliharaan/detail/'.$k->petcode) }}" class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ url('dashboard/peliharaan/edit/'.$k->petcode) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ url('dashboard/peliharaan/delete/'.$k->petcode) }}" class="btn btn-sm btn-danger">Delete</a>
                                    <a href="{{ url('dashboard/peliharaan/transfer/'.$k->petcode) }}" class="btn btn-sm btn-primary">Transfer</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{$mypet->links()}}
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
