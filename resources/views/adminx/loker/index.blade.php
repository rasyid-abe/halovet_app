@extends('layouts.admin')
@section('title','Lowongan Pekerjaan -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Lowongan Pekerjaan</h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <a href="{{ url('adminix/loker/new') }}" class="btn btn-primary btn-md">Tambah Lowongan Pekerjaan</a>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Lowongan yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th width="15%">Gambar</th>
                                                    <th width="15%">Judul</th>
                                                     <th width="15%">Perusahaan</th>
                                                    <th width="25%">Isi</th>
                                                     <th width="15%">Kontak</th>
                                                    <th width="15%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lkmin as $p)
                                                <tr>
                                                    <th scope="row"><img src="{{ asset($p->lokimg) }}" class="img-responsive img-fluid" width="100" height="100"></th>
                                                     <td>{{$p->lokjudul}}</td>
                                                      <td>{{$p->lokperus}}</td>
                                                    <td>{{strip_tags(substr($p->lokisi,0,200))}}</td>
                                                    <td>{{substr($p->lokkontak,0,200)}}</td>
                                                    <td>
                                                        <a href="{{ url('adminix/loker/edit/'.$p->lokid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('adminix/loker/detail/'.$p->lokid) }}" class="btn btn-warning btn-md"><i class="fa fa-eye"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/loker/delete/'.$p->lokid) }}"><i class="fa fa-trash"></i></button> 
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
            text: "Anda akan menghapus Lowongan ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Lowongan akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Lowongan tidak dihapus");
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