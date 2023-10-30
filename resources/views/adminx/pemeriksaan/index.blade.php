@extends('layouts.admin')
@section('title','Daftar Pemeriksaan Dokter Hewan -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Daftar Hewan Peliharaan </h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                   
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                               
                                                    <th width="10%">Kode Pemeriksaan</th>
                                                    <th width="10%">Kode Hewan</th>
                                                    <th width="15%">Anamnesa</th>
                                                     <th width="15%">Pemeriksaan Umum</th>
                                                     <th width="20%">Pengobatan / Tindakan</th>
                                                      <th width="10%">Tanggal</th>
                                                      <th width="10%">Dokter</th>
                                                    <th width="10%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pemeriksaan as $p)
                                                <tr>
                                                    <th scope="row">{{$p->percode}}</th>
                                                     <td>{{$p->perpetid}}</td>
                                                    <td>{{strip_tags(substr($p->peranamnesa,0,200))}}</td>
                                                    <td>{{strip_tags(substr($p->perumum,0,200))}}</td>
                                                       <td>{{strip_tags(substr($p->pengobatan,0,200))}}</td>
                                                    <td>{{$p->pertanggal}}</td>
                                                     <td><a href="{{ url('adminix/user/detail/'.$p->perdokid) }}">{{$p->name}}</a></td>
                                                    <td>
                                                        <a href="{{ url('adminix/pemeriksaan/edit/'.$p->percode) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('adminix/pemeriksaan/detail/'.$p->percode) }}" class="btn btn-warning btn-md"><i class="fa fa-eye"></i></a>
                                                         <button class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/pemeriksaan/delete/'.$p->percode) }}"><i class="fa fa-trash-o"></i></button> 
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
            text: "Anda akan menghapus Hewan ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Hewan akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Hewan tidak dihapus");
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