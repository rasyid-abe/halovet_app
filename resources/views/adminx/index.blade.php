@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Dashboard</h3>
                    </div>
                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <h4>Ubah Gambar Index</h4>
                                <img id="blah" src="{{url('images/previewkonsul.png')}}" style="max-width: 20%; max-height: 20%;">
                                <br>
                                <form method="post" action="{{url('dashboard/changeimg')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                    <input type="file" id="inputprofilepic" name="profile" class="validate">
                                    <button type="submit" class="btn btn-md btn-primary">Upload</button>
                                    
                                </form>
                            </div>
                        </div>
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
                        
                    </div><!-- Main Wrapper -->
                    <div class="page-footer">
                        <p>Made with <i class="fa fa-heart"></i> by hadegawe</p>
                    </div>
                </div><!-- /Page Inner -->
                
@endsection