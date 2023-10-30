@extends('layouts.web')
@section('title','Pemeriksaan '.$eper->percode.' - ')
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
        height: 300,
        autoresize_min_height: 300,
        autoresize_max_height: 600,

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
                    <li><a href="{{ url('dashboard/pemeriksaan#target')}}">Ambulatoir</a></li>
                    <li class="active"><a href="{{ url('#')}}">Sunting Ambulatoir</a></li>
                </ul>


                <div class="height20"></div>
                <h2 class="light text-center" data-aos="flip-left" data-aos-duration="1500">Sunting Pemeriksaan <span>{{$eper->percode}}</span></h2>

                <div class="height20"></div>


                <form method="post" action="{{ url('dashboard/pemeriksaan/update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <input type="hidden" name="percode" value="{{$eper->percode}}">
                        <div class="row">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Kode Hewan</label>
                                <div class="col-md-10 col-sm-12">
                                    <input id="textinput" name="petid" value="{{$eper->perpetid}}" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Anamnesa</label>
                                <div class="col-md-10 col-sm-12 ">
                                    <textarea name="peranamnesa">
 {{$eper->peranamnesa}}
</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Pemeriksaan Umum</label>
                                <div class="col-md-10 col-sm-12 ">
                                    <textarea name="perumum">
 {{$eper->perumum}}
</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Pemeriksaan Khusus</label>
                                <div class="col-md-10 col-sm-12 ">
                                    <textarea name="perkhusus">
 {{$eper->perkhusus}}
</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Pengobatan / Tindakan</label>
                                <div class="col-md-10 col-sm-12 ">
                                    <textarea name="pengobatan">
 {{$eper->pengobatan}}
</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
