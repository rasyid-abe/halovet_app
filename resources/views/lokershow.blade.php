@extends('layouts.web')
@section('title',$lkshow->lokjudul.' - ')
@section('content')



<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            @php
            $datelama = $lkshow->lokerdate;
            $datebaru = date("d-m-Y", strtotime($datelama));
            if($datebaru == "01-01-1970")
            {
            $datebaru = "";
            }
            else
            {
            $datebaru = "| ".date("d-m-Y", strtotime($datelama));
            }
            @endphp

            <div class="col-md-8 blog-wrapper clearfix">

                <h2 class="bordered light">{{$lkshow->lokjudul}}</h2>
                <p>Oleh {{$lkshow->lokperus}} {{$datebaru}}</p>

                <ul class="social-rounded">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/home?status=%5BLOWONGAN%20KERJA%5D%20{{$lkshow->lokjudul}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>
                </ul>

                <article class="blog-item blog-full-width blog-detail">

                    <div class="blog-thumbnail">
                        <img alt="" src="{{asset($lkshow->lokimg)}}" class="img-responsive img-fluid">
                    </div>

                    <div class="blog-content">
                        {!! $lkshow->lokisi !!}

                        <br>
                        <br>

                        <p><b>KONTAK :</b></p>
                        {{$lkshow->lokkontak}}
                    </div>


                    <div class="share-post clearfix">
                        <label>Share this Post!</label>
                        <ul class="social-rounded">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/home?status=%5BLOWONGAN%20KERJA%5D%20{{$lkshow->lokjudul}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>

                </article>





            </div>


            @include('layouts.sidebar')
        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
