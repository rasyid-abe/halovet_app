@extends('layouts.web')
@section('title','Edit Artikel '.$ea->artjudul.'-')
@section('content')
@include('mceImageUpload::upload_form')
@section('js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#editor',
        menubar: false,
        autoresize_overflow_padding: 50,
        theme_advanced_resizing: true,
        width: '100%',
        height: 400,
        autoresize_min_height: 400,
        autoresize_max_height: 800,

        plugins: [
            'advlist autolink link lists charmap preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking',
            'save table contextmenu paste textcolor image imagetools autoresize'
        ],
        toolbar: 'styleselect bold italic | alignleft aligncenter | bullist link image',
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        }
    });
    $(window).resize(function() {
        setTimeout(function() {
            $j('.mceEditor').css('width', '100%').css('minHeight', '240px');
            $j('.mceLayout').css('width', '100%').css('minHeight', '240px');
            $j('.mceIframeContainer').css('width', '100%').css('minHeight', '240px');
            $j('#' + ['editor'] + '_ifr').css('width', '100%').css('minHeight', '240px');
        }, 500)
    });

</script>

@endsection


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            <div class="col-md-4">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix ">
                    <div class="card-user-profile-container ">
                        <div class="card-user-profile-inner dropshadow">
                            <center>
                                <div class="card-user-profile-photo">
                                    <img src="{{asset(Auth::user()->profilepic)}}" class="img-responsive img-circle marbot" style="width: 70% !important; height: 70% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{Auth::user()->name}}</b>
                                </div>
                                @if(Auth::user()->role == 2)
                                @if(Auth::user()->verifadmin == 0)
                                <label style="font-weight: normal; font-size: 80%;" class="label label-warning">Unverified</label>
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close pull-right" style="min-width: 10px;" data-dismiss="alert">&times;</button>
                                    <h4 class="text-center">Peringatan</h4>
                                    <p>Anda belum terverifikasi. Mohon lengkapi persyaratan agar akun anda dapat diverifikasi. Silahkan klik <a href="{{ url('setting/dokter') }}" class="alert-link">di sini</a> untuk melengkapi persyaratan. Banyak benefit yang anda dapatkan jika sudah terverifikasi. Silahkan baca keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">di sini</a>.</p>
                                </div>
                                @else
                                <label class="label label-success">Verified</label>
                                @endif
                                <br>
                                @endif
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 blog-wrapper clearfix" id="target">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard/post#target')}}">Artikel Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Sunting Artikel</a></li>
                </ul>

                <div class="height20"></div>

                <h2 class="text-center light" data-aos="flip-left" data-aos-duration="1500">Sunting Artikel <span>{{$ea->artjudul}}</span></h2>
                <div class="height20"></div>

                <form method="post" action="{{ url('dashboard/post/update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <fieldset>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="textinput">Judul Artikel</label>
                            <div class="col-md-10 col-sm-12">
                                <input id="textinput" name="judul" value="{{$ea->artjudul}}" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="textinput">Kategori</label>
                            <div class="col-md-10 col-sm-12">
                                <select class="form-control" name="catid">
                                    <option value="{{$ea->artcat}}">{{$ea->catname}}</option>
                                    @foreach($allcat as $cat)
                                    <option value="{{$cat->catid}}">{{$cat->catname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="artid" value="{{$ea->artid}}">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="textinput">Isi Artikel</label>
                            <div class="col-md-10 col-sm-12 ">
                                <textarea name="isi" id="editor">
 {!! $ea->artisi !!}
</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="profile">Gambar Thumbnail </label>
                            <div class="col-md-10">
                                <img src="{{ asset($ea->artthumbnail) }}" id="blah" style="max-width:700px;max-height:300px;" />

                                <input type="file" id="inputprofilepic" name="profile" class="validate">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Edit Artikel</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <script type="text/javascript">
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#blah').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#inputprofilepic").change(function() {
                        readURL(this);
                    });

                </script>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
