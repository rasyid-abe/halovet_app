@extends('layouts.admin')
@section('title','Ubah Pengguna')
@section('content')
@section('js')
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
@endsection
 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/user') }}" class="btn btn-md btn-primary">Kembali ke Daftar Pengguna</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah Profile {{$edits->name}}</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">User Profile</h4>
                                </div>
                                <div class="panel-body">
                                     <form class="form-horizontal" method="post" action="{{ url('adminix/user/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Nama Lengkap</label>  
  <div class="col-md-10">
  <input id="textinput" name="nama" value="{{$edits->name}}" class="form-control" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">No HP</label>  
  <div class="col-md-10">
  <input id="textinput" name="nohp" value="{{$edits->nohp}}" class="form-control" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Alamat</label>  
  <div class="col-md-10">
  <input id="textinput" name="alamat" value="{{$edits->alamat}}" class="form-control" type="text">
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="textarea">Bio</label>
  <div class="col-md-10">                     
    <textarea class="form-control" id="textarea" name="bio"> {{$edits->bio}}</textarea>
  </div>
</div>
                   
<div class="form-group">
<label class="control-label col-md-2" for="profile">Profile Picture </label>
<div class="col-md-10">
<img src="{{ url($edits->profilepic)}}" id="blah" style="max-width:200px;max-height:200px;" class="img-circle img-responsive" />

<input type="file" id="inputprofilepic" name="profile" class="validate" >
</div>
</div>
<!-- Button -->
<input type="hidden" name="userid" value="{{$edits->id}}">
<div class="form-group">
<div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-md btn-primary">Ubah</button>
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
               
                
            </div><!-- /Page Content -->
@endsection