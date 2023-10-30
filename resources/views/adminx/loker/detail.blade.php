@extends('layouts.admin')
@section('title','Lowongan '.$lkdet->lokjudul.' - ')
@section('content')

 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/loker') }}" class="btn btn-md btn-primary">Kembali ke Daftar Penyakit</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header"></h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">{{$lkdet->lokjudul}}</h4>
                                </div>
                                <div class="panel-body">
                                   <h2>{{$lkdet->lokjudul}}</h2>
                                   <p>Perusahaan : {{$lkdet->lokperus}}</p>
                                   <br>
                                   <img src="{{ asset($lkdet->lokimg) }}">
                                   <br>
                                   {!! $lkdet->lokisi !!}
                                   <br>
                                   <br>

                                   <p><b>Kontak :</b><p>
                                   {{$lkdet->lokkontak}}
                                   <br>
                                   <br>
                                    <a href="{{ url('adminix/loker/edit/'.$lkdet->lokid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i> Edit</a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/loker/delete/'.$lkdet->lokid) }}"><i class="fa fa-trash"></i> Delete</button> 
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