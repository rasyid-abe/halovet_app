@extends('layouts.web')
@section('title',$vk->konsjudul.' - ')
@section('content')
@section('content')
@include('mceImageUpload::upload_form')

<script type="text/javascript" src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#editor',
        menubar: false,
        height: "300",
        plugins: [
            'autolink link lists pagebreak',
            'searchreplace wordcount insertdatetime nonbreaking',
            'image imagetools'
        ],
        toolbar: 'bold italic link image',
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        }
    });

</script>


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-8 blog-wrapper clearfix">
                <a href="{{ url('konsultasi') }}" data-aos="fade-right" data-aos-duration="1500"> <i class="fas fa-arrow-left"></i> Kembali ke daftar pertanyaan</a>
                <br>
                <br>
                <h2 class="light" data-aos="flip-left" data-aos-duration="1500">{{$vk->konsjudul}}</h2>
                <br>
                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-md-2 col-sm-2 col-xs-2" style="max-width:86px; min-width:86px;">

                        <a href="{{'user/'.$vk->id}}"><img src="{{asset($vk->profilepic)}}" class="img-responsive marbot img-circle" style="width: 56px !important; height: 56px !important;"> </a>

                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10">

                        {{--<p class="marsot"><b>{{$vk->konsjudul}}</b>--}}
                        <p class="marsot" style="font-size:14px;"><b>{{$vk->name}}</b>
                            <small class="visible-xs-block hidden-sm hidden-md hidden-lg">Diposting pada {{date("d-m-Y", strtotime($vk->konsdate))}}
                            </small>

                            <span class="hidden-xs"><small style="float: right;">Diposting pada {{date("d-m-Y", strtotime($vk->konsdate))}}
                                </small></span>
                        </p>

                        @if($vk->role == 1) <p class="marsot" style="font-size:14px;">Anggota</p>


                        @elseif($vk->role == 2)
                        <p class="marsot" style="font-size:14px;">Dokter / Veteriner</p>
                        @elseif($vk->role == 3)
                        <p class="marsot" style="font-size:14px;">Moderator</p>
                        @else
                        @endif
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {!! $vk->konsisi !!}
                            @if($vk->konswriter == Auth::id())
                            @if($vk->konsstatus == 2)
                            <a href="{{ url('konsultasi/'.$vk->konsslug.'/edit') }}" class="btn btn-sm btn-warning">Edit Post</a>
                            @else
                            <a href="{{ url('konsultasi/'.$vk->konsslug.'/edit') }}" class="btn btn-sm btn-warning btn-disabled">Edit Post</a>
                            @endif
                            @else
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <div class="share-post clearfix hidden-xs hidden-sm" data-aos="zoom-in-down" data-aos-duration="1500">
                    <label>Share this Post!</label>
                    <ul class="social-rounded">
                        <li data-aos="fade-up" data-aos-duration="1500"><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
                        <li data-aos="fade-up" data-aos-duration="1500"><a href="https://twitter.com/home?status={{$vk->konsjudul}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
                        <li data-aos="fade-up" data-aos-duration="1500"><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>


                    </ul>
                </div>



                @php
                $count = count($vj);
                @endphp


                @if($count > 0)
                @foreach($vj as $j)
                <div class="row" id="{{$j->jawid}}" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-md-2 col-sm-2 col-xs-2" style="max-width:86px; min-width:86px">
                        <a href="{{'user/'.$j->id}}"><img src="{{asset($j->profilepic)}}" class="img-responsive img-circle marbot" style="width: 56px !important; height: 56px !important;">
                        </a>
                        {{--@if($j->role == 2)
                                <span class="label label-success">Verified</span>
                                <span class="label label-primary">Doctor / Veteriner</span>
                                @else
                                @endif--}}

                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10 col-md-10">
                        <p class="marsot" style="font-size:14px;"><b>{{$j->name}}</b>
                            <small class="visible-xs-block hidden-sm hidden-md hidden-lg">Diposting pada {{date("d-m-Y", strtotime($j->jawdate))}}
                            </small>

                            <span class="hidden-xs"><small style="float: right;">Diposting pada {{date("d-m-Y", strtotime($j->jawdate))}}
                                </small></span>
                        </p>

                        @if($j->role == 1) <p class="marsot" style="font-size:14px;">Anggota</p>


                        @elseif($j->role == 2)
                        <p class="marsot" style="font-size:14px;">Dokter / Veteriner</p>
                        @elseif($j->role == 3)
                        <p class="marsot" style="font-size:14px;">Moderator</p>
                        @else
                        @endif
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {!! $j->jawisi !!}

                            @if($j->jawwriter == Auth::id())
                            <a href="{{ url('editbalasan/'.$j->jawid) }}" class="btn btn-sm btn-warning">Edit Jawaban</a>
                            @else
                            @endif
                        </div>
                    </div>
                </div>




                <hr>
                @endforeach
                @else
                <h4>Belum ada jawaban :(</h4>
                @endif
                {{ $vj->links() }}
                <br>
                @if(Auth::check())
                @if($vk->konstatus == 2 OR $vk->konstatus == 3)
                <center>
                    <h5>Diskusi ini telah ditutup karena telah terjawab oleh dokter hewan</h5>
                    <br>
                    <a href="{{ url('konsultasi/baru') }}" class="btn btn-md btn-primary">Buat Pertanyaan Baru</a>
                </center>
                @else
                <h5>Balas diskusi ini !</h5>
                <form method="post" action="{{ url('balas/'.$vk->konsslug) }}">
                    {{csrf_Field()}}
                    <textarea class="editor" id="editor" name="jawisi" style="height: 400px !important; width: 100%;"></textarea>
                    <input type="hidden" name="jawthread" value="{{$vk->konsid}}">
                    <input type="hidden" name="slugthread" value="{{$vk->konsslug}}">
                    <br>
                    <button class="btn btn-primary btn-md" type="submit">Balas</button>
                </form>
                @endif
                @else
                <center>
                    <h5>Silahkan <a href="{{ url('login') }}">Login</a> untuk membalas diskusi</h5>
                </center>
                @endif

                <br><br><br><br>
                <h2 class="light">Pertanyaan <span>Terbaru</span></h2>
                <br>
                
                @if(count($rk) > 0)
                @foreach($rk as $r)
                
                <div class="row" data-aos="fade-right" data-aos-duration="1500">
                    <div class="col-xs-2 col-sm-2 col-md-2 " style="max-width:86px; min-width:86px;">
                        <a href="{{ url('konsultasi/'.$r->konsslug) }}"><img src="{{asset($r->profilepic)}}" class="img-responsive img-circle marbot" style="width: 56px !important; height: 56px !important;"></a>
                        {{--<p class="marsot">{{$r->name}}</p>--}}

                        {{--@if($r->role == 1)

                            @elseif($r->role == 2)
                            <span class="label label-primary">Doctor / Veteriner</span>
                            @elseif($r->role == 3)
                            <span class="label label-primary">Moderator</span>
                            @else
                            @endif--}}
                    </div>
                    <div class="col-xs-8 col-sm-10 col-md-10">
                        <p class="marsot question-title"><a href="{{ url('konsultasi/'.$r->konsslug) }}"><b>{{$r->konsjudul}}</b></a></p>
                        <p class="marsot" style="font-size:14px;">Oleh: <b>{{$r->name}}</b>
                            <small class="visible-xs-block hidden-sm hidden-md hidden-lg">Diposting pada {{date("d-m-Y", strtotime($r->konsdate))}}
                            </small>

                            <span class="hidden-xs"><small style="float: right;">Diposting pada {{date("d-m-Y", strtotime($r->konsdate))}}
                                </small></span>
                        </p>
                        @if($r->konstatus == 1)
                        @else
                        <img src="{{asset('icon/checked.svg')}}" alt="" style="width:14px; height:14px;">
                        <span class="label label-success" style="font-weight:normal !important;">Sudah dibalas oleh Dokter</span>
                        @endif
                    </div>
                </div>
                <div class="row" data-aos="fade-left" data-aos-duration="1500">
                    <div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12" style="margin-left: 0px !important;">
                        <div class="jawaban">
                            {{strip_tags(substr($r->konsisi,0,200))}}...
                        </div>
                        <a href="{{ url('konsultasi/'.$r->konsslug) }}" style="float: right !important;" class="btn btn-mini btn-default btn-rounded hvr-glow">Baca Lebih Lanjut</a>
                    </div>
                </div>
                <hr>
                @endforeach
                @else
                @endif


            </div><!-- row wrap 9 -->


            @include('layouts.sidebar')
        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
