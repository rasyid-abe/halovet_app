@extends('layouts.web')
@section('title','Artikel '.$findslug->catname.' - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">
        <h2 class="bordered light">Artikel <span>{{$findslug->catname}}</span></h2>
        <div class="row">
            <div class="col-md-8">
                <div class="row blog-wrapper">
                    @foreach($a as $s)
                    <div class="col-md-6 clearfix">

                        <article class="blog-item blog-full-width">

                            <div class="blog-thumbnail">
                                <img alt="" src="{{ asset($s->artthumbnail) }}">
                            </div>

                            <h4 class="blog-title"><a href="{{ url('artikel/'.$s->artslug) }}">{{$s->artjudul}}</a></h4>
                            <p class="blog-meta">By: <a href="{{url('user/'.$s->artwriter)}}">{{$s->name}}</a> | Category: <a href="{{ url('kategori/'.$s->artslug) }}">{{$s->catname}}</a> {{$s->artdate}}</p>
                            <p>{{ strip_tags(substr($s->artisi,0,200)) }}</p>

                            <a href="{{ url('artikel/'.$s->artslug) }}" class="btn btn-default btn-mini btn-rounded">READ MORE</a>

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
