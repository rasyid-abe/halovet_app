@extends('layouts.web')
@section('title',$show->artjudul.' - ')
@section('content')



<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-8 blog-wrapper clearfix">

                <h2 data-aos="flip-left" data-aos-duration="1500" class="bordered light">{{$show->artjudul}}</h2>
                <p>Oleh <a href="{{ url('user/'.$show->artwriter) }}">{{$show->name}}</a> pada {{date("d-m-Y", strtotime($show->artdate))}}
                 | <a href="{{ url('kategori/'.$show->catslug) }}">{{$show->catname}}</a></p>

                <ul data-aos="fade-right" data-aos-duration="1500" class="social-rounded">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/home?status={{$show->artjudul}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>
                </ul>

                <article class="blog-item blog-full-width blog-detail">

                    <div class="blog-thumbnail" data-aos="zoom-out-up" data-aos-duration="1500">
                        <img alt="" src="{{asset($show->artthumbnail)}}">
                    </div>

                    <div class="blog-content" data-aos="zoom-in-up" data-aos-duration="1500">
                        {!! $show->artisi !!}
                    </div>
                    <br>
                    {!! $ad->afterarticle !!}
                    <br>
                    <div class="share-post clearfix">
                        <label>Share this Post!</label>
                        <ul class="social-rounded">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/home?status={{$show->artjudul}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>

                </article>



                <h2 class="bordered light">Responses <span>5</span></h2>




            </div>


            @include('layouts.sidebar')
        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
