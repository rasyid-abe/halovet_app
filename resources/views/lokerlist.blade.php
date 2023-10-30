@extends('layouts.web')
@section('title','Lowongan Pekerjaan - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix latest-news">

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h1 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Lowongan Pekerjaan</span></h1>
                <div class="row">
                    @foreach($lki as $p)
                    <div class="col-md-6">

                        <article class="blog-item dropshadow" data-aos="zoom-in-up" data-aos-duration="1500">

                            <div class="blog-thumbnail hvr-grow">
                                <a href="{{ url('karir/'.$p->lokslug) }}"> <img alt="" src="{{ asset($p->lokimg) }}" class="img-responsive img-fluid" style="height:250px !important;"></a>
                            </div>
                            @php
                            $datelama = $p->lokerdate;
                            $datebaru = date("d-m-Y", strtotime($datelama));
                            if($datebaru == "01-01-1970")
                            {
                            $datebaru = "";
                            }
                            else
                            {
                            $datebaru = date("d-m-Y", strtotime($datelama));
                            }
                            @endphp
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{ url('karir/'.$p->lokslug) }}">{{$p->lokjudul}}</a></h4>
                                <p class="blog-meta">Perusahaan / Institusi : {{$p->lokperus}} </p>
                                <p>{{$datebaru}} </p>
                                <p>{{ strip_tags(substr($p->lokisi,0,200)) }}</p>

                                <a href="{{ url('karir/'.$p->lokslug) }}" class="btn btn-mini btn-default btn-rounded hvr-glow">Read more</a>
                            </div>
                        </article>
                    </div>




                    @endforeach

                </div>
                <div class="text-center" data-aos="" data-aos-duration="1500">{{ $lki->links() }}</div>
            </div>

            @include('layouts.sidebar')

        </div>

    </div>

</div>

<!--end sub-page-content-->

@endsection
