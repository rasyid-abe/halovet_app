@extends('layouts.web')
@section('title','Dashboard')
@section('content')
<script type="text/javascript" src="{{asset('jquery.gmap.js')}}"></script>

<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            <aside class="col-md-3">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix">

                    <center>
                        <img src="{{Auth::user()->profilepic}}" class="img-responsive" style="width: 70%; height: 70%;">
                        <b>{{Auth::user()->name}}</b>
                    </center>
                    @if(Auth::user()->role == 2)
                    @if(Auth::user()->verifadmin == 0)
                    <center><label class="label label-warning">Unverified</label></center>
                    <div class="alert alert-dismissible alert-warning">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Peringatan</h4>
                        <p>Anda belum terverifikasi. Mohon lengkapi persyaratan agar akun anda dapat diverifikasi silahkan klik <a href="{{ url('setting/dokter') }}">disini</a> untuk melengkapi persyaratan, banyak benefit yang anda dapatkan jika sudah terverifikasi silahkan baca >keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">Klik Disini</a>.</p>
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
                    </center>

                </div>


                <!-- Archives
							============================================= -->
                <div class="sidebar-widget clearfix">
                    <ul class="tags">
                        @foreach($randpen as $rp)
                        <li><a href="{{ url($rp->penslug) }}">{{$rp->pennama}}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-widget clearfix">



                </div>

            </aside>

            <div class="col-md-9 blog-wrapper clearfix">

                <h2 class="bordered light">Timeline</h2>

                @foreach($timeline as $k)
                <div class="row marbot">
                    <div class="col-md-2">
                        <center>
                            <img src="{{asset($k->profilepic)}}" class="img-responsive img-circle marbot" style="width: 100px; height: 100px;">
                            <p class="marsot">{{$k->name}}</p>

                            @if($k->role == 1)

                            @elseif($k->role == 2)
                            <span class="label label-primary">Doctor / Veteriner</span>
                            @elseif($k->role == 3)
                            <span class="label label-primary">Moderator</span>
                            @else
                            @endif
                        </center>
                    </div>
                    <div class="col-md-10">
                        <a href="#">

                            <p class="marsot"><a href="{{ url('konsultasi/'.$k->konsslug) }}"><b>{{$k->konsjudul}}</b></a> <small style="float: right;">Diposting pada {{$k->konsdate}}</small></p>
                        </a>

                        <div class="jawaban">
                            {{strip_tags(substr($k->konsisi,0,200))}}</div>
                        <div class="action">
                            @if($k->konstatus == 1)
                            <span class="label label-default">Belum ada balasan</span>
                            @else
                            <span class="label label-success">Sudah dibalas oleh Dokter</span>
                            @endif

                        </div>
                        <a href="{{ url('konsultasi/'.$k->konsslug) }}" style="float: right !important;" class="btn btn-sm btn-info">Baca Lebih Lanjut</a>
                    </div>
                </div>

                <hr>
                @endforeach


                {{$timeline->links()}}




            </div>




        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
