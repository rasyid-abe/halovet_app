@extends('layouts.admin')
@section('title','Sidebar -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Sidebar</h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <a href="{{ url('adminix/sidebar/new') }}" class="btn btn-primary btn-md">Buat Sidebar Baru</a>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Sidebar yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="40%">Nama</th>
                                                     <th width="40%">Lokasi</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($as as $a)
                                                <tr>
                                                    <th scope="row">{{$a->sidebarname}}</th>
                                                     <td>
                                                         @if($a->sidelocation == 1)
                                                         Homepage
                                                         @elseif($a->sidelocation == 2)
                                                         Article
                                                         @elseif($a->sidelocation == 3)
                                                         Penyakit
                                                         @else
                                                         Dokter
                                                         @endif
                                                     </td>
                                                    <td>
                                                        <a href="{{ url('adminix/sidebar/edit/'.$a->pageid) }}" class="btn btn-warning btn-md"> <i class="fa fa-pencil"></i></a>
                                                     <a href="{{ url('adminix/sidebar/'.$a->pageid) }}" class="btn btn-info btn-md"> <i class="fa fa-eye"></i></a>
                                                       <a href="{{ url('sidebar/'.$a->pageslug) }}" class="btn btn-primary btn-md"> <i class="fa fa-world"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/sidebar/delete/'.$a->pageid) }}"><i class="fa fa-trash"></i></button> 
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
                       
                        
                    </div><!-- Main Wrapper -->
                    <div class="page-footer">
                        <p>Made with <i class="fa fa-heart"></i> by hadegawe</p>
                    </div>
                </div><!-- /Page Inner -->
                
@endsection