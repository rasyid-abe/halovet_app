@extends('layouts.web')
@section('title','Daftar Penyakit Hewan Peliharaan - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix latest-news">

    <div class="container">
        <h1 class="text-center light" data-aos="flip-right" data-aos-duration="1500">Daftar <span>Penyakit</span> Hewan Peliharaan</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="row blog-wrapper">
                    @foreach($allpen as $ap)
                    <div class="col-md-6">
                        <article class="blog-item dropshadow rounded-border" data-aos="flip-left" data-aos-duration="1500">
                            <div class="blog-thumbnail hvr-grow">
                                <a href="{{ url('penyakit/'.$ap->penslug) }}"><img alt="" src="{{asset($ap->penthumb)}}" style="height:250px !important;"></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{ url('penyakit/'.$ap->penslug) }}">{{$ap->pennama}}</a></h4>
                                <p>{{strip_tags(substr($ap->penisi,0,150))}}.....</p>
                                <a href="{{ url('penyakit/'.$ap->penslug) }}" class="btn btn-mini btn-rounded hvr-glow rounded-border">Read more</a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            @include('layouts.sidebar')
        </div>

    </div>

</div>


<!--end sub-page-content-->

@endsection
