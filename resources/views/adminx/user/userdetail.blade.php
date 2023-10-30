@extends('layouts.admin')
@section('title',$detail->name.' - ')
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
                                <div class="panel-body user-profile-panel" style="text-align: left;">
                                    <img src="{{ asset($detail->profilepic) }}" height="100px" width="100px" class="user-profile-image img-circle" alt="">
                                    <h4 class="m-t-lg">{{$detail->name}}</h4>
                                    <p>{{$detail->bio}}</p>
                                    <hr>
                                    <ul class="list-unstyled">
                                    @if($detail->role == 2)
                                         <li><b>DOKTER</b></li>
                                          @if($detail->verifadmin == 0)
                                     <a href="{{ url('adminix/user/dokter/verify/'.$detail->id) }}" class="btn btn-success btn-md"><i class="fa fa-check"></i> VERIFIKASI</a>
                                      <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-file"></i> Lihat Dokumen</button>
                                     @else
                                      <a href="{{ url('adminix/user/dokter/unverify/'.$detail->id) }}" class="btn btn-primary btn-md"><i class="fa fa-user"></i> BATALKAN VERIFIKASI</a>
                                       <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-file"></i> Lihat Dokumen</button>
                                     @endif
                                        <li><p> {{$detail->klinik}}</p></li>
                                        <li><p>{{$detail->pengalaman}} Tahun</p></li>
                                        <li><p> {{$detail->lulusan}} - {{$detail->tahunlulus}}</p></li>
                                       

                                        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen dari {{$detail->name}}</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
  <li class="active"><a href="#scanktp" data-toggle="tab">SCAN KTP</a></li>
  <li><a href="#scanijazah" data-toggle="tab">SCAN IJAZAH / KTA PDHI / LAINNYA</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="scanktp">
   @if(is_null($detail->scanktp))
   <p>Pengguna belum mengupload scan ktpnya</p>
   @else
<img src="{{ asset($detail->scanktp) }}" class="img-responsive">
<center><a href="{{ url($detail->scanktp) }}" class="btn btn-md btn-info">Download / Lihat Lebih Besar</a></center>
   @endif
  </div>
  <div class="tab-pane fade" id="scanijazah">
   @if(is_null($detail->scansurat))
   <p>Pengguna belum mengupload scan dokumen lainnya</p>
   @else
<img src="{{ asset($detail->scansurat) }}" class="img-responsive">
<center><a href="{{ url($detail->scansurat) }}" class="btn btn-md btn-info">Download / Lihat Lebih Besar</a></center>
   @endif
  </div>
 
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                                        @endif
                                        <li><p>{{$detail->alamat}}</p></li>
                                        <li><p>{{$detail->email}}</p></li>
                                        <li><p>{{$detail->nohp}}</p></li>

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
                                @foreach($upost as $u)
                                    <li class="timeline-item">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="timeline-item-header">
                                        <img src="{{ asset($detail->profilepic) }}" width="40px" height="40px" alt="">
                                        <p>{{$detail->name}} <span>{{$u->konsdate}}</span></p>
                                       
                                    </div>
                                    <div class="timeline-item-post">
                                    <h4><a href="{{ url('konsultasi/'.$u->konslug) }}">{{$u->konsjudul}}</a></h4>
                                        <p>{{strip_tags(substr($u->konsisi,0,250))}}</p>
                                        <div class="timeline-options">
                                            <a href="{{ url('adminix/user/detail/'.$u->konsid) }}" class="btn btn-primary btn-md"><i class="fa fa-eyes"></i> Lihat Post</a>
                                    <a href="{{ url('adminix/user/edit/'.$u->konsid) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i> Ubah Post</a>

                                    <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/user/delete/'.$u->konsid) }}"><i class="fa fa-trash"></i> Hapus Post</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                    </li>
                                    @endforeach
                                 
                             
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