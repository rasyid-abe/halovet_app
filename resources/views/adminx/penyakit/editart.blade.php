
@extends('layouts.admin')
@section('title','Edit Artikel')
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
                 <a href="{{ url('adminix/artikel/kategori') }}" class="btn btn-md btn-primary">Kembali ke Daftar Artikel</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah Artikel {{$ea->artjudul}}</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Ubah Artikel</h4>
                                </div>
                                <div class="panel-body">
                                     <form class="form-horizontal" method="post" action="{{ url('adminix/artikel/edit/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Judul Artikel</label>  
  <div class="col-md-10">
  <input id="textinput" name="judul" value="{{$ea->artjudul}}" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Kategori Artikel</label>  
  <div class="col-md-6">
   <select style="margin-bottom:15px;" class="form-control" name="catid">
   <option value="{{$ea->artcat}}"> --> {{$ea->catname}}</option>
   @foreach($allcat as $cat)
     <option value="{{$cat->catid}}">{{$cat->catname}}</option>
	 @endforeach
      </select>
                                               
  </div>
</div>

<input type="hidden" name="artid" value="{{$ea->artid}}">

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Isi Artikel</label>  
  <div class="col-md-10">
 <textarea name="isi" id="editor">
 {!! $ea->artisi !!}
</textarea>
  </div>
</div>
<div class="form-group">
<label class="control-label col-md-2" for="profile">Gambar Thumbnail </label>
<div class="col-md-10">
<img src="{{ url($ea->artthumbnail)}}" id="blah" />

<input type="file" id="inputprofilepic" name="profile" class="validate" >
</div>
</div>

<div class="form-group">
<div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Ubah</button>
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