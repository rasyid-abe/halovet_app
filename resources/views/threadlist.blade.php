@extends('layouts.web')
@section('title','Konsultasi Dengan Dokter Hewan - ')
@section('content')



<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-8 blog-wrapper clearfix">

                <h2 class="light text-center" data-aos="flip-left" data-aos-duration="1500">Tanya <span>Dokter</span></h2>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{ url('konsultasi/baru') }}" class="btn-default btn-outline hvr-shutter-out-horizontal make-question text-center" data-aos="fade-up" data-aos-duration="1500"><i class="fas fa-pencil-alt"></i> Buat Pertanyaan</a>
                    </div>
                </div>
                <br>
                <br>
                <h3 class="light" data-aos="flip-left" data-aos-duration="1500">Pertanyaan <span>Terbaru</span></h3>
                <br>
                @foreach($kindex as $k)

                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-xs-2 col-sm-2 col-md-2 " style="max-width:86px; min-width:86px;">
                        <a href="{{ url('konsultasi/'.$k->konsslug) }}"><img src="{{asset($k->profilepic)}}" class="img-responsive img-circle marbot" style="width: 56px !important; height: 56px !important;"></a>
                        {{--<p class="marsot">{{$k->name}}</p>--}}

                        {{--@if($k->role == 1)

                            @elseif($k->role == 2)
                            <span class="label label-primary">Doctor / Veteriner</span>
                            @elseif($k->role == 3)
                            <span class="label label-primary">Moderator</span>
                            @else
                            @endif--}}
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
                        <br>
                        <a href="{{ url('konsultasi/'.$k->konsslug) }}" style="float: right !important;" class="btn btn-mini btn-default btn-rounded hvr-glow">Baca Lebih Lanjut</a>
                    </div>
                </div>
                <hr>
                @endforeach

                <br>
                <div class="text-center">{{$kindex->links()}}
                </div>

            </div>


            @include('layouts.sidebar')




        </div>


    </div>
</div>
<!--end sub-page-content-->


@endsection
