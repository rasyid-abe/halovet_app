
@extends('layouts.admin')
@section('title','Tambah Lowongan Pekerjaan -')
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
                 <a href="{{ url('adminix/loker/') }}" class="btn btn-md btn-primary">Kembali ke Daftar Lowongan</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Tambah Lowongan Pekerjaan</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Lowongan Baru</h4>
                                </div>
                                <div class="panel-body">
                                     <form class="form-horizontal" method="post" action="{{ url('adminix/loker/new/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Judul Lowongan Pekerjaan</label>  
  <div class="col-md-10">
  <input id="textinput" name="lokjudul" placeholder="masukan judul" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Perusahaan / Instansi / Institusi</label>  
  <div class="col-md-10">
  <input id="textinput" name="lokperus" placeholder="masukan nama perusahaan" class="form-control" type="text">
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Penjelasan Lowongan Pekerjaan</label>  
  <div class="col-md-10">
 <textarea name="lokisi" id="editor" class="editor">
</textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Kontak / Alamat Lowongan</label>  
  <div class="col-md-10">
 <textarea name="lokkontak" style="width: 100%; height: 200px;">
</textarea>
  </div>
</div>

<div class="form-group">
<label class="control-label col-md-2" for="profile">Gambar Thumbnail </label>
<div class="col-md-10">
<img src="" id="blah" style="max-width:700px;max-height:300px;" />

<input type="file" id="inputprofilepic" name="lokphoto" class="validate" >
</div>
</div>
<div class="form-group">
<div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Buat</button>
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