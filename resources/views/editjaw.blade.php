@extends('layouts.web')
@section('title','Ubah Balasan - ')
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
                <h2 class="text-center light"><span>Preview</span></h2>
                <div id="live-preview-form">
                </div>
                <div id="lp-message"></div>

                <br>
                <br>

                <h2 class="light text-center"><span>Ubah</span> Jawaban</h2>
                <form method="post" action="{{ url('editbalasan/'.$ej->jawid.'/save') }}">
                    {{ csrf_field() }}


                    <!-- Textarea -->
                    <div class="form-group clearfix" style="margin-bottom: 10px;">
                        <label class="col-md-2 control-label" for="textarea">Isi Pertanyaan</label>
                        <div class="col-md-10">
                            <input type="hidden" name="jawid" value="{{$ej->jawid}}">
                            <textarea class="form-control" name="jawisi" id="editor">
    	                        {!! $ej->jawisi !!}
                            </textarea>
                        </div>
                    </div>
                    <br>
                    <br>
                    <!-- Button -->
                    <div class="form-group cleafix">
                        <label class="col-md-2 control-label" for="singlebutton"></label>
                        <div class="col-md-10">
                            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Ubah Jawaban</button>
                        </div>
                    </div>

                </form>

                <br>


            </div>


            @include('layouts.sidebar')

        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
