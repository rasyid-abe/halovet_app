@extends('layouts.admin')
@section('title','Artikel '.$da->artjudul)
@section('content')

 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/artikel') }}" class="btn btn-md btn-primary">Kembali ke Daftar Artikel</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header"></h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Artikel {{$da->artjudul}}</h4>
                                </div>
                                <div class="panel-body">
                                   <h2>{{$da->artjudul}}</h2>
                                   <p>Ditulis oleh {{$da->name}} pada {{$da->artdate}} &bull; {{$da->catname}}</p>
                                   <br>
                                   <img src="{{ asset($da->artthumbnail) }}">
                                   <br>
                                   {!! $da->artisi !!}
                                   <br>
                                    <a href="{{ url('adminix/artikel/edit/'.$da->artid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i> Edit</a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/artikel/delete/'.$da->artid) }}"><i class="fa fa-trash"></i> Delete</button> 
<script type="text/javascript">
    $(document).ready(function(){
    $('#delete-btn').on('click', function(e){
        e.preventDefault(); //cancel default action

        //Recuperate href value
        var href = $(this).attr('href');
        var message = $(this).data('confirm');

        //pop up
        swal({
            title: "Anda Yakin?",
            text: "Anda akan menghapus Artikel ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Dokter akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, artikel tidak dihapus");
          }
        });
    });
});
</script>
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