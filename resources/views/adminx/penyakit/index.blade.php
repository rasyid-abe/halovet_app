@extends('layouts.admin')
@section('title','Penyakit Hewan -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Penyakit</h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <a href="{{ url('adminix/penyakit/new') }}" class="btn btn-primary btn-md">Buat Penyakit Baru</a>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Penyakit yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="35%">Nama</th>
                                                    <th width="35%">Ringkasan Isi</th>
                                                    <th width="10%">Tanggal</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($penyakit as $p)
                                                <tr>
                                                    <th scope="row">{{$p->pennama}}</th>
                                                    <td>{{strip_tags(substr($p->penisi,0,200))}}</td>
                                                    <td>{{$p->pendate}}</td>
                                                    <td>
                                                        <a href="{{ url('adminix/penyakit/edit/'.$p->penid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('adminix/penyakit/detail/'.$p->penid) }}" class="btn btn-warning btn-md"><i class="fa fa-eye"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/penyakit/delete/'.$p->penid) }}"><i class="fa fa-trash"></i></button> 
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
            text: "Anda akan menghapus Penyakit ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Penyakit akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Penyakit tidak dihapus");
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