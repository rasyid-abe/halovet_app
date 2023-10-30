@extends('layouts.web')
@section('title','Pemeriksaan No : '.$dp->percode.' - ')
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

            <div class="col-md-8 blog-wrapper clearfix ">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard/pemeriksaan#target')}}">Ambulatoir</a></li>
                    <li class="active"><a href="{{ url('#')}}"><span>Detail Pemeriksaan</span></a></li>
                </ul>
                <div class="height20"></div>

                <h2 class="text-center light">Detail Pemeriksaan</h2>
                <div class="height40"></div>

                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Tanggal :</b> {{$dp->pertanggal}}</h5>
                    </div>
                    <div class="col-md-6">
                        <h5><b>Kode Pemeriksaan :</b> {{$dp->percode}}</h5>
                    </div>
                </div>
                <div class="height20"></div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Kode Hewan :</b> {{$dp->perpetid}}</p>
                        <p><b>Anamnesa :</b> {{$dp->peranamnesa}}</p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Pemeriksaan Umum :</b> {{$dp->perumum}}</p>
                        <p><b>Pengobatan / Tindakan :</b> {{$dp->pengobatan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="float: right;">
                            <a href="{{ url('dashboard/pemeriksaan/edit/'.$dp->percode) }}" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{ url('dashboard/pemeriksaan/detail/'.$dp->percode) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                            <a class="btn btn-danger btn-sm" id="delete-btn" href="{{ url('dashboard/pemeriksaan/delete/'.$dp->percode) }}"><i class="fa fa-trash-o"></i> Hapus</a>
                        </div>
                    </div>
                </div>



                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.btn-danger').on('click', function(e) {
                            e.preventDefault(); //cancel default action

                            //Recuperate href value
                            var href = $(this).attr('href');
                            var message = $(this).data('confirm');

                            //pop up
                            swal({
                                    title: "Anda Yakin?",
                                    text: "Anda akan menghapus Ambulatoir ini, anda yakin?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        swal("Baik, Ambulatoir ini akan dihapus", {
                                            icon: "success",
                                        });
                                        window.location.href = href;
                                    } else {
                                        icon: "fail",
                                        swal("Okay, Ambulatoir tidak dihapus");
                                    }
                                });
                        });
                    });

                </script>
            </div>
        </div>
    </div>



</div>
<!--end sub-page-content-->


@endsection
