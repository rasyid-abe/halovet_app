
@extends('layouts.admin')
@section('title','Ubah '.$edper->percode.' - ')
@section('content')
@include('mceImageUpload::upload_form')
@section('js')

<script type="text/javascript" src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
            <script type="text/javascript">
  tinymce.init({
    selector: '#editor',
 theme: 'modern',
 menubar:false,
 height : "400",
    plugins: [
      'advlist autolink link lists charmap preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking',
      'save table contextmenu paste textcolor image imagetools'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullpage | forecolor backcolor image',
    relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        }
  });

</script>




@endsection
 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/pemeriksaan/') }}" class="btn btn-md btn-primary">Kembali ke Daftar Pemeriksaan</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah {{$edper->petcode}}</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Ubah {{$edper->petcode}}</h4>
                                </div>
                                <div class="panel-body">
                                      <form class="form-horizontal" method="post" action="{{ url('adminix/pemeriksaan/edit/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>
<input type="hidden" name="percode" value="{{$edper->percode}}">
<div class="row">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">No / Kode Hewan</label>  
  <div class="col-md-5 col-sm-12">
  <input id="textinput" name="petid" value="{{$edper->perpetid}}" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Anamnesa</label>  
  <div class="col-md-10 col-sm-12 ">
 <textarea name="peranamnesa" style="width: 100%; height: 200px;">
 {{$edper->peranamnesa}}
</textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Pemeriksaan Umum</label>  
  <div class="col-md-10 col-sm-12 ">
 <textarea name="perumum" style="width: 100%; height: 200px;">
 {{$edper->perumum}}
</textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Pemeriksaan Khusus</label>  
  <div class="col-md-10 col-sm-12 ">
 <textarea name="perkhusus" style="width: 100%; height: 200px;">
 {{$edper->perkhusus}}
</textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Pengobatan / Tindakan</label>  
  <div class="col-md-10 col-sm-12 ">
 <textarea name="pengobatan" style="width: 100%; height: 200px;">
 {{$edper->pengobatan}}
</textarea>
  </div>
</div>

<div class="form-group">
<div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Ubah</button>
    </div>
</div>
</div>
</fieldset>
</form>

                                   
                                </div>
                            </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
                <div class="page-footer">
                    <p>Made with <i class="fa fa-heart"></i> by Hadegawe</p>
                </div>

                
                </div><!-- /Page Inner -->
                     <script type="text/javascript">

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputprofilepic").change(function () {
        readURL(this);
    });

</script>
                
            </div><!-- /Page Content -->
@endsection