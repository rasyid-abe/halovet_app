@extends('layouts.web')
@section('title','')
@section('content')



<!-- Main Banner
		============================================= -->
<section id="slider" class="tp-banner-container index-rev-slider clearfix">

    <div class="tp-banner">

        <ul>
            @foreach($slider as $s)
            <!-- Fade
					============================================= -->
            <li data-transition="fade" data-slotamount="10" data-thumb="">
                <img src="{{asset($s->slidbg)}}" alt="image" />
                @if(!is_null($s->slidimg))
                <div class="caption lfr" data-x="770" data-y="100" data-speed="1500" data-start="900" data-easing="easeOutExpo">
                    <img src="{{asset($s->slidimg)}}" alt="" />
                </div>
                @else
                @endif
                @if(!is_null($s->slidjudul))
                <div class="caption sft big_white" data-x="0" data-y="265" data-speed="1000" data-start="1700" data-easing="easeOutExpo">
                    <strong>{{$s->slidjudul}}</strong>
                </div>
                @else
                @endif
                @if(!is_null($s->sliddesc))
                <div class="caption sfr medium_grey" data-x="0" data-y="340" data-speed="1000" data-start="2500" data-easing="easeOutExpo">
                    <?php  
                    
                    $edited = $s->sliddesc;
                    $edited = substr($edited, 3, strlen($edited)-7);
                    
                    ?>

                    {{$edited}}


                </div>
                @else
                @endif
                @endforeach
            </li>




        </ul>

    </div>

</section>
<!-- Latest News
		============================================= -->
<section class="latest-news" id="artikel">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h1 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Artikel Terbaru</span></h1>

                <div class="row">
                    @foreach($latesta as $a)
                    <div class="col-md-4">
                        <article class="blog-item  dropshadow" data-aos="zoom-in" data-aos-duration="1500">
                            <div class="blog-thumbnail hvr-grow">
                                <a href="{{ url('artikel/'.$a->artslug) }}"><img alt="" src="{{asset($a->artthumbnail)}}" style="height:250px !important;"></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{ url('artikel/'.$a->artslug) }}">{{$a->artjudul}}</a></h4>
                                <p class="blog-meta">{{date("d-m-Y", strtotime($a->artdate))}}</p>

                                <p class="blog-meta">By: <a href="{{ url('user/'.$a->id) }}">{{$a->name}}</a> | <a href="{{ url('kategori/'.$a->catslug) }}">{{$a->catname}}</a></p>
                                <p>{{strip_tags(substr($a->artisi,0,150))}}.....</p>
                                <a href="{{ url('artikel/'.$a->artslug) }}" class="btn btn-mini btn-rounded hvr-glow rounded-border">Read more</a>
                            </div>
                        </article>
                    </div>

                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12" data-aos="fade-up" data-aos-duration="1500">
                        <center><a href="{{ url('artikel') }}" class="btn btn-lg btn-primary rounded-border">Baca Artikel Lainnya</a></center>
                    </div>
                </div>
            </div>



        </div>

    </div>

</section>

<!-- About
		============================================= -->
<section class="latest-news" id="penyakit">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="light text-center" data-aos="flip-right" data-aos-duration="1500"><span>KENALI PENYAKIT HEWAN</span></h1>
                {{--<p class="lead">Kenali penyakit hewan peliharaan anda, lihat ribuan informasi mengenai penyakit hewan peliharaan di Hallovet.</p>--}}
                <div class="row">

                    @foreach($latestp as $p)
                    <div class="col-md-4">
                        <article class="blog-item dropshadow rounded-border" data-aos="flip-left" data-aos-duration="1500">
                            <div class="blog-thumbnail hvr-grow">
                                <a href="{{ url('penyakit/'.$p->penslug) }}"><img alt="" src="{{asset($p->penthumb)}}" style="height:250px !important;"></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{ url('penyakit/'.$p->penslug) }}">{{$p->pennama}}</a></h4>
                                <p>{{strip_tags(substr($p->penisi,0,150))}}.....</p>
                                <a href="{{ url('penyakit/'.$p->penslug) }}" class="btn btn-mini btn-rounded hvr-glow rounded-border">Read more</a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12" data-aos="fade-up" data-aos-duration="1500">
                        <center><a href="{{ url('penyakit') }}" class="btn btn-lg btn-primary rounded-border">Kenali Penyakit Hewan Lainnya</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<!-- Appointment
		============================================= -->
<section class="latest-news" id="konsultasi">

    <div class="container">
   
            <h1 data-aos="flip-left" data-aos-duration="1500" class="light text-center"><span>Konsultasi dengan dokter hewan</span></h1>

        <div class="row" style="margin:10px;">
            <div class="col-md-12">
                <div class="clearfix">
                    <div class="row no-gutters dropshadow rounded-border" data-aos="zoom-in-up" data-aos-duration="1500">
                        @foreach($kindex as $k)
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <center>
                                    <img src="{{ asset($k->profilepic) }}" style="width: 50px; height: 50px !important;" class="img-responsive img-circle">
                                    <b>{{$k->name}}</b>
                                </center>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ url('konsultasi/'.$k->konsslug) }}">{{$k->konsjudul}}</a>
                                <br>
                                <p>{{strip_tags(substr($k->konsisi,0,100))}}....</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br>
                    <center>
                        <a href="{{ url('konsultasi/baru') }}" class="btn btn-md btn-primary rounded-border" data-aos="fade-up" data-aos-duration="1500">Buat Pertanyaan Baru</a>
                        <a href="{{ url('konsultasi') }}" class="btn btn-md btn-info rounded-border" data-aos="fade-up" data-aos-duration="1500">Lihat Diskusi Lainnya</a>
                    </center>

                </div>

            </div>

        </div>
    </div>
</section>



@endsection



@section('js')
<script>
    (function() {

        // Revolution slider
        var revapi;
        revapi = jQuery('.tp-banner').revolution({
            delay: 9000,
            startwidth: 1170,
            startheight: 682,
            hideThumbs: 200,
            fullWidth: "on",
            forceFullWidth: "on"
        });

    })();

</script>

@endsection
