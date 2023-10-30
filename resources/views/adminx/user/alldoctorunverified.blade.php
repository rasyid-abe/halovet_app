@extends('layouts.admin')
@section('title','User -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Semua Dokter Yang Belum Terverifikasi</h3>
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
                    @foreach($aldun as $u)
                                    <div class="col-md-3">
                                    <div class="panel panel-white">
                                         <div class="panel-heading clearfix">
                                          <a href="{{url('adminix/user/detail/'.$u->id) }}"><h4 class="panel-title"><b>{{$u->name}}</b></h4></a>
                                         </div>
                                <div class="panel-body">
                               <a href="{{url('adminix/user/detail/'.$u->id) }}"> <img src="{{asset($u->profilepic)}}" width="100px" height="100px"></a>
                                    <p>{{$u->email}}</p>
                                    <p>{{$u->alamat}}</p>
                                    <p>{{$u->nohp}}</p>
                                    <p>{{$u->klinik}}</p>
                                    <p>{{$u->pengalaman}} Tahun</p>
                                    <p>{{$u->lulusan}} - {{$u->tahunlulus}}</p>


                                     <a href="{{ url('adminix/user/detail/'.$u->id) }}" class="btn btn-primary btn-md"><i class="fa fa-user"></i></a>
                                    <a href="{{ url('adminix/user/edit/'.$u->id) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i></a>
                                    @if($u->verifadmin == 0)
                                     <a href="{{ url('adminix/user/dokter/verify/'.$u->id) }}" class="btn btn-success btn-md"><i class="fa fa-check"></i></a>
                                     @else
                                      <a href="{{ url('adminix/user/dokter/unverify/'.$u->id) }}" class="btn btn-primary btn-md"><i class="fa fa-user"></i></a>
                                     @endif
                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/dokter/delete/'.$u->id) }}"><i class="fa fa-trash"></i></button> 
                                    
                                </div>
                                </div>
                                     </div>
                               @endforeach

                               {{$aldun->links()}}
                        </div>
                </div><!-- Main Wrapper -->
                <div class="page-footer">
                    <p>Made with <i class="fa fa-heart"></i> by Hadegawe</p>
                </div>
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
            text: "Anda akan menghapus Dokter ini, anda yakin?", 
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
            swal("Okay, Dokter tidak dihapus");
          }
        });
    });
});
</script>
                
                </div><!-- /Page Inner -->
               
                
            </div><!-- /Page Content -->
@endsection