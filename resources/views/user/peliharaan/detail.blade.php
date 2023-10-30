@extends('layouts.web')
@section('title',$detailpet->petname.' - ')
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

            <div class="col-md-8 blog-wrapper clearfix">

                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Detail Peliharaan</a></li>
                </ul>
                <div class="height40"></div>


                <h2 class="text-center light">Detail Informasi <span>{{$detailpet->petname}}</span></h2>

                <div class="height40"></div>

                <div class="sidebar-widget clearfix ">
                    <div class="card-user-profile-container ">
                        <div class="card-user-profile-inner dropshadow">
                            <center>
                                <div class="card-user-profile-photo">
                                    <img src="{{ asset($detailpet->petphoto) }}" class="img-responsive img-circle marbot" style="width: 40% !important; height: 40% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{$detailpet->petname}}
                                        @if($detailpet->petsex == 1)
                                        <img src="{{ url('icon/male.png') }}" width="24" height="24">
                                        @else
                                        <img src="{{ url('icon/female.png') }}" width="24" height="24">
                                        @endif</b>
                                </div>
                                <label class="label label-primary">Pet Code : {{$detailpet->petcode}}</label>
                                <br>
                                <i>Gunakan Pet Code ini di jaringan dokter Hallovet untuk mendapatkan benefit</i>
                            </center>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="title">Warna Hewan</div>
                                    <div class="card-user-profile warna">{{$detailpet->petcolor}}</div>
                                    <div class="title">Breed</div>
                                    <div class="card-user-profile warna">{{$detailpet->petbreed}}</div>
                                    <div class="title">Jenis Hewan</div>
                                    <div class="card-user-profile tipe">@if($detailpet->pettype == 1)
                                        Mamalia - {{$detailpet->petdetail}}
                                        @elseif($detailpet->pettype == 2)
                                        Reptil - {{$detailpet->petdetail}}
                                        @elseif($detailpet->pettype == 3)
                                        Unggas - {{$detailpet->petdetail}}
                                        @elseif($detailpet->pettype == 4)
                                        Amfibi - {{$detailpet->petdetail}}
                                        @else
                                        Lainnya - {{$detailpet->petdetail}}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="title blog-item">Status</div>
                                    <div class="card-user-profile vaksin">@if($detailpet->petvaksin == 1)
                                        @else
                                        Belum / Tidak Vaksin
                                        @endif
                                        Sudah Vaksin
                                    </div>
                                    <div class="title">Pet Age</div>
                                    <div class="card-user-profile warna">@php $a = floor((time() - strtotime('1986-09-16')) / 31556926);
                                     echo $a; @endphp</div>
                                    <div class="title">Ciri Hewan</div>
                                    <div class="card-user-profile ciri">{{$detailpet->petciri}}</div>
                                </div>
                                <div class="col-md-12" style="margin-top: 1em;">
                                    <h5>Riwayat Pemeriksaan Dokter</h5>
                                    <table class="table">
                                            <thead>
                                              <tr>
                                              <th scope="col">Kode Pemeriksaan</th>
                                                <th scope="col">Anamnesa</th>
                                                <th scope="col">Dokter Pemeriksa</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($per as $p)
                                              <tr>
                                                <th scope="row">{{$p->percode}}</th>
                                                <td>{{$p->peranamnesa}}k</td>
                                                <td>{{$p->name}}</td>
                                                <td>{{$p->pertanggal}}</td>
                                                <td><a href="{{url('pemeriksaan/detail/'.$p->perid)}}" class="btn-sm btn-warning">Detail</a></td>
                                              </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
