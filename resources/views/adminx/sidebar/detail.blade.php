@extends('layouts.admin')
@section('title','Halaman '.$dp->pagejudul)
@section('content')

 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/page') }}" class="btn btn-md btn-primary">Kembali ke Daftar Page</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header"></h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Halaman {{$dp->pagejudul}}</h4>
                                </div>
                                <div class="panel-body">
                                   <h2>{{$dp->pagejudul}}</h2>
                                  
                                   <br>
                                   <img src="{{ asset($dp->pageimg) }}" class="img-responsive img-fluid">
                                   <br>
                                   {!! $dp->pagedesc !!}
                                   <br>
                                    <a href="{{ url('adminix/page/edit/'.$dp->pageid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i> Edit</a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/page/delete/'.$dp->pageid) }}"><i class="fa fa-trash"></i> Delete</button> 
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
            text: "Anda akan menghapus Page ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Page akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Page tidak dihapus");
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