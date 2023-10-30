
@extends('layouts.admin')
@section('title','Ubah '.$aep->petname.' - ')
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
                 <a href="{{ url('adminix/penyakit/') }}" class="btn btn-md btn-primary">Kembali ke Daftar Penyakit</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah {{$aep->pennama}}</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Ubah {{$aep->pennama}}</h4>
                                </div>
                                <div class="panel-body">
                                      <form class="form-horizontal" method="post" action="{{ url('adminix/peliharaan/edit/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>
<input type="hidden" name="petid" value="{{$aep->petid}}">
<div class="row">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Nama Hewan Peliharaan</label>  
  <div class="col-md-5 col-sm-12">
  <input id="textinput" name="petname" value="{{$aep->petname}}" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Jenis Hewan</label>  
  <div class="col-md-5 col-sm-12">
  <select id="pettype" name="pettype" class="form-control">

      <option value="{{$aep->pettype}}" selected>@if($aep->pettype == 1)
--> Mamalia
@elseif($aep->pettype == 2)
--> Reptil
@elseif($aep->pettype == 3)
--> Unggas
@elseif($aep->pettype == 4)
--> Amfibi
@else
--> Tidak terklasifikasi
@endif</option>

      <option value="1">Mamalia</option>
      <option value="2">Reptil</option>
      <option value="3">Unggas</option>
      <option value="4">Amfibi</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Warna Hewan</label>  
  <div class="col-md-5 col-sm-12">
  <input id="textinput" name="petcolor" value="{{$aep->petcolor}}" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Jenis Kelamin Hewan</label>  
   <div class="col-md-5 col-sm-12">
  <select id="petsex" name="petsex" class="form-control">

      <option value="{{$aep->petsex}}" selected>
      @if($aep->petsex == 1)
      --> Jantan
      @else
      --> Betina
      @endif</option>
      <option value="1">Jantan</option>
      <option value="2">Betina</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Status Vaksin</label>  
  <div class="col-md-5 col-sm-12">
  <select id="selectbasic" name="petvaksin" class="form-control">
  <option value="{{$aep->petvaksin}}" selected>
    @if($aep->petvaksin == 1)
    --> Belum / Tidak Vaksin
@else
--> Sudah Vaksin
@endif

  </option>
      <option value="1">Belum Vaksin</option>
      <option value="2">Sudah Vaksin</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Ciri Hewan Peliharaan</label>  
  <div class="col-md-10 col-sm-12 ">
 <textarea name="petciri" style="width: 90%; height: 200px;" >
 {{$aep->petciri}}
</textarea>
  </div>
</div>
<div class="form-group">
<label class="control-label col-md-2" for="profile">Gambar Thumbnail </label>
<div class="col-md-10">
<img src="{{ asset($aep->petphoto) }}" id="blah" width="150" height="150" />

<input type="file" id="inputprofilepic" name="petphoto" class="validate" >
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