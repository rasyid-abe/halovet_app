@extends('layouts.admin')
@section('title','Slider -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Slider</h3>
                    </div>
                    <div id="main-wrapper">
                     <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <a href="{{ url('adminix/slider/new') }}" class="btn btn-primary btn-md">Buat Slider Baru</a>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    </div><!-- Row -->
                    <br>
                        <div class="row">
                            
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Slider yang telah di publikasikan</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Judul</th>
                                                    <th width="20%">Deskripsi</th>
                                                    <th width="20%">Gambar</th>
                                                     <th width="20%">Gambar BG</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($slider as $a)
                                                <tr>
                                                    <th scope="row">{{$a->slidjudul}}</th>
                                                    <td>{!! strip_tags(substr($a->sliddesc,0,250)) !!}</td>
                                                    <td><img src="{{ asset($a->slidimg) }}" style="width: 100px; height: 60px;"></td>
                                                    <td><img src="{{ asset($a->slidbg) }}" style="width: 100px; height: 60px;"></td>
                                                    <td>
                                                        <a href="{{ url('adminix/slider/edit/'.$a->slidid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                     
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/slider/delete/'.$a->slidid) }}"><i class="fa fa-trash"></i></button> 
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
            text: "Anda akan menghapus Slider ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Slider akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Slider tidak dihapus");
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