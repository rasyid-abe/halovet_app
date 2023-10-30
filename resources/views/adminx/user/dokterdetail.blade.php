@extends('layouts.admin')
@section('title','User '.$detail->name.' - ')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/user') }}" class="btn btn-md btn-primary">Kembali ke Daftar Pengguna</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Detail {{$detail->name}}</h3>

                    </div>

                <div id="main-wrapper">
                     <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">User Profile</h4>
                                </div>
                                <div class="panel-body user-profile-panel">
                                    <img src="{{ asset($detail->profilepic) }}" height="100px" width="100px" class="user-profile-image img-circle" alt="">
                                    <h4 class="text-center m-t-lg">{{$detail->name}}</h4>
                                    <p class="text-center">{{$detail->bio}}</p>
                                    <hr>
                                    <ul class="list-unstyled text-center">
                                        <li><p><i class="fa fa-map-marker m-r-xs"></i>{{$detail->alamat}}</p></li>
                                        <li><p><i class="fa fa-paper-plane-o m-r-xs"></i> {{$detail->email}}</p></li>
                                        <li><p><i class="fa fa-link m-r-xs"></i> {{$detail->nohp}}</p></li>
                                    </ul>
                                    <hr>
                                    <a href="{{ url('adminix/user/detail/'.$detail->id) }}" class="btn btn-primary btn-md"><i class="fa fa-user"></i></a>
                                    <a href="{{ url('adminix/user/edit/'.$detail->id) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i></a>

                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/user/delete/'.$detail->id) }}"><i class="fa fa-trash"></i></button> 

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
            text: "Anda akan menghapus pengguna ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Pengguna akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Pengguna tidak dihapus");
          }
        });
    });
});
</script>
                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3>User's Post</h3>
                            <div class="profile-timeline">
                                <ul class="list-unstyled">

                                    <li class="timeline-item">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="timeline-item-header">
                                        <img src="{{ asset($detail->profilepic) }}" width="40px" height="40px" alt="">
                                        <p>jack smith <span>posted a status</span></p>
                                        <small>3 hours ago</small>
                                    </div>
                                    <div class="timeline-item-post">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor mi eget laoreet auctor. Proin dictum nulla id augue aliquam, vitae condimentum erat imperdiet</p>
                                        <div class="timeline-options">
                                            <a href="{{ url('adminix/user/detail/'.$detail->id) }}" class="btn btn-primary btn-md"><i class="fa fa-eyes"></i> Lihat Post</a>
                                    <a href="{{ url('adminix/user/edit/'.$detail->id) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i> Ubah Post</a>

                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/user/delete/'.$detail->id) }}"><i class="fa fa-trash"></i> Hapus Post</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                    </li>

                                     <li class="timeline-item">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="timeline-item-header">
                                        <img src="http://via.placeholder.com/40x40" alt="">
                                        <p>jack smith <span>posted a status</span></p>
                                        <small>3 hours ago</small>
                                    </div>
                                    <div class="timeline-item-post">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor mi eget laoreet auctor. Proin dictum nulla id augue aliquam, vitae condimentum erat imperdiet</p>
                                        <div class="timeline-options">
                                            <a href="{{ url('adminix/user/detail/'.$detail->id) }}" class="btn btn-primary btn-md"><i class="fa fa-eyes"></i> Lihat Post</a>
                                    <a href="{{ url('adminix/user/edit/'.$detail->id) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i> Ubah Post</a>

                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/user/delete/'.$detail->id) }}"><i class="fa fa-trash"></i> Hapus Post</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                    </li>

                                     <li class="timeline-item">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="timeline-item-header">
                                        <img src="http://via.placeholder.com/40x40" alt="">
                                        <p>jack smith <span>posted a status</span></p>
                                        <small>3 hours ago</small>
                                    </div>
                                    <div class="timeline-item-post">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porttitor mi eget laoreet auctor. Proin dictum nulla id augue aliquam, vitae condimentum erat imperdiet</p>
                                        <div class="timeline-options">
                                            <a href="{{ url('adminix/user/detail/'.$detail->id) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i> Lihat Post</a>
                                    <a href="{{ url('adminix/user/edit/'.$detail->id) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i> Ubah Post</a>

                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/user/delete/'.$detail->id) }}"><i class="fa fa-trash"></i> Hapus Post</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                    </li>
                             
                                </ul>
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