@extends('layouts.admin')
@section('title','Artikel -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Artikel</h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <a href="{{ url('adminix/artikel/new') }}" class="btn btn-primary btn-md">Buat Artikel Baru</a>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Artikel yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="25%">Judul</th>
                                                    <th width="35%">Ringkasan Isi</th>
                                                    <th width="10%">Kategori</th>
                                                    <th width="10%">Penulis</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allpost as $a)
                                                <tr>
                                                    <th scope="row">{{$a->artjudul}}</th>
                                                    <td>{!! strip_tags(substr($a->artisi,0,350))!!}</td>
                                                    <td>{{$a->catname}}</td>
                                                    <td>{{$a->name}}</td>
                                                    <td>
                                                        <a href="{{ url('adminix/artikel/edit/'.$a->artid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('adminix/artikel/detail/'.$a->artid) }}" class="btn btn-warning btn-md"><i class="fa fa-eye"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/artikel/delete/'.$a->artid) }}"><i class="fa fa-trash"></i></button> 
                                                    </td>
                                       
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        </div><!-- Row -->
<script type="text/javascript">
    $(document).ready(function(){
    $('.btn-danger').on('click', function(e){
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
                       
                        
                    </div><!-- Main Wrapper -->
                    <div class="page-footer">
                        <p>Made with <i class="fa fa-heart"></i> by hadegawe</p>
                    </div>
                </div><!-- /Page Inner -->
                
@endsection