@extends('layouts.web')
@section('title','Kategori Artikel - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">
        <h2 class="bordered light">Kategori Artikel</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="row blog-wrapper">
                    @foreach($allcate as $ac)
                    <div class="col-md-3">
                        <a href="{{url('kategori/'.$ac->catslug)}}" class="btn btn-primary btn-md">{{$ac->catname}}</a>
                        <br>
                        <br>
                        <br>
                    </div>
                    @endforeach
                    {{ $allcate->links() }}
                </div>
            </div>
            @include('layouts.sidebar')
        </div>

    </div>

</div>


<!--end sub-page-content-->

@endsection
