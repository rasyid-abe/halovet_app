@extends('layouts.web')
@section('title','Artikel Hewan - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix latest-news">

    <div class="container">
        
        <div class="row">
            <div class="col-md-8">
              
               <h1 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Artikel Kesehatan Hewan</span></h1>
               
                <div class="row">
                    @foreach($allposts as $p)
                    <div class="col-md-6">

                        <article class="blog-item dropshadow" data-aos="zoom-in-up" data-aos-duration="1500">
                            <div class="blog-thumbnail hvr-grow">
                                <a href="{{ url('artikel/'.$p->artslug) }}"><img alt="" src="{{ asset($p->artthumbnail) }}" style="height:250px !important;"></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="blog-title"><a href="{{ url('artikel/'.$p->artslug) }}">{{$p->artjudul}}</a></h4>
                                <p class="blog-meta">
                                {{date("d-m-Y", strtotime($p->artdate))}}
                                </p>
                                <p class="blog-meta">By: <a href="{{url('user/'.$p->artwriter)}}">{{$p->name}}</a> | Category: <a href="{{ url('kategori/'.$p->catslug) }}">{{$p->catname}}</a></p>
                                <p>{{ strip_tags(substr($p->artisi,0,150)) }}</p>

                                <a href="{{ url('artikel/'.$p->artslug) }}" class="btn btn-mini btn-default btn-rounded hvr-glow">Read more</a>
                            </div>
                        </article>
                    </div>


                    @endforeach

                    
                </div>
                <div class="text-center">{{ $allposts->links() }}</div>
            </div>

            @include('layouts.sidebar')

        </div>

    </div>

</div>

<!--end sub-page-content-->

@endsection
