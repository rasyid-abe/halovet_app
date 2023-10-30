@extends('layouts.web')
@section('title','Buat Pertanyaan Baru -')
@section('content')
@include('mceImageUpload::upload_form')
<script type="text/javascript" src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#editor',
        theme: 'modern',
        menubar: false,
        setup: function(ed) {
            ed.on("keyup", function() {
                $('#lp-message').html(tinymce.activeEditor.getContent());
            });
        },
        height: "400",
        plugins: [
            'advlist autolink link lists ',
            'wordcount ',
            ' image imagetools'
        ],
        toolbar: 'bold italic link image',
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        }
    });

</script>


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-8 blog-wrapper clearfix">

                <h2 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Preview</span></h2>
                <div id="live-preview-form">
                </div>
                <div id="lp-message"></div>

                <br>
                <br>
                <h2 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Buat Pertanyaan</span></h2>
                <div class="height20"></div>
                <form method="post" action="{{ url('konsultasi/baru/save') }}">
                    {{ csrf_field() }}
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="textinput">Judul</label>
                        <div class="col-md-10">
                            <input id="textinput" name="konsjudul" class="form-control input-lg" type="text" style="width: 100%;">

                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="selectbasic">Kategori</label>
                        <div class="col-md-10">
                            <select id="selectbasic" name="koncatid" class="form-control">
                                @foreach($kc as $k)
                                <option value="{{$k->koncatid}}">{{$k->koncatjudul}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group clearfix" style="margin-bottom: 10px;">
                        <label class="col-md-2 control-label" for="textarea">Isi Pertanyaan</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="konsisi" id="editor"></textarea>
                        </div>
                    </div>
                    <div class="height20"></div>
                    <!-- Button -->
                    <div class="form-group cleafix">
                        <label class="col-md-2 control-label" for="singlebutton"></label>
                        <div class="col-md-10">
                            <button id="singlebutton" name="singlebutton" class="btn btn-primary hvr-glow">Buat Pertanyaan</button>
                        </div>
                    </div>



                </form>

                <div class="height40"></div>


            </div>


            @include('layouts.sidebar')

        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
