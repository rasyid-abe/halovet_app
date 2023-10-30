@extends('layouts.admin')
@section('title','Kategori Baru')
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
                 <a href="{{ url('adminix/artikel/kategori') }}" class="btn btn-md btn-primary">Kembali ke Daftar Kategori</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Buat Kategori Baru</h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Kategori Baru</h4>
                                </div>
                                <div class="panel-body">
                                     <form class="form-horizontal" method="post" action="{{ url('adminix/artikel/kategori/new/save') }}"  enctype="multipart/form-data">
                              {{ csrf_field() }}

<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Nama Kategori</label>  
  <div class="col-md-10">
  <input id="textinput" name="catname" placeholder="masukan nama kategori" class="form-control" type="text">
  </div>
</div>

<div class="form-group">
<div class="col-md-4">
    <button id="singlebutton" name="submit" class="btn btn-md btn-primary">Buat</button>
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