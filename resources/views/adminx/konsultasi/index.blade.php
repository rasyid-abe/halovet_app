@extends('layouts.admin')
@section('title','Thread Diskusi -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Thread Diskusi</h3>
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
                                    <h4 class="panel-title">Thread Diskusi yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="25%">Judul</th>
                                                    <th width="35%">Ringkasan Isi</th>
                                                    <th width="10%">User</th>
                                                    <th width="10%">Status</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allthread as $t)
                                                <tr>
                                                    <th scope="row">{{$t->konsjudul}}</th>
                                                    <td>{!! strip_tags(substr($t->konsisi,0,250))!!}</td>
                                                    <td>{{$t->name}}</td>
                                                    <td>
                                                        @if($t->konstatus == 2)
                                                        <label class="label label-success">Sudah Dijawab Dokter Hewan</label>
                                                        @elseif($t->konstatus == 1)
                                                        <label class="label label-warning">Terbuka</label>
                                                        @else
                                                        <label class="label label-danger">Closed</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        
                                                        <a href="{{ url('konsultasi/'.$t->konsslug) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ url('adminix/konsultasi/edit/'.$t->konsid) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>   

                                                        @if($t->konstatus == 3)
                                                        <a href="{{ url('adminix/konsultasi/unclose/'.$t->konsid) }}" class="btn btn-warning btn-sm"><i class="fa fa-unlock"></i></a>
                                                        @else
                                                         <a href="{{ url('adminix/konsultasi/close/'.$t->konsid) }}" class="btn btn-warning btn-sm"><i class="fa fa-lock"></i></a>
                                                         @endif
                                                         <button type="button" class="btn btn-danger btn-sm" id="delete-btn" href="{{ url('adminix/konsultasi/delete/'.$t->konsid) }}"><i class="fa fa-trash"></i></button> 
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
            text: "Anda akan menghapus Thread Diskusi ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik Thread Diskusi akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Thread Diskusi tidak dihapus");
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