@extends('layouts.admin')
@section('title',$depel->petname.' - ')
@section('content')

 <!-- Page Inner -->
                <div class="page-inner">
                 <a href="{{ url('adminix/peliharaan') }}" class="btn btn-md btn-primary">Kembali ke Daftar Hewan Peliharaan</a>

                    <div class="page-title">
                        <h3 class="breadcrumb-header"></h3>
                    </div>

                <div id="main-wrapper">
                    <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">{{$depel->petname}}</h4>
                                </div>
                                <div class="panel-body">
                      <div class="row">
                      <div class="col-md-4">
                                   <img src="{{ asset($depel->petphoto) }}" class="img-responsive img-fluid">
                                   </div>
                                   <div class="col-md-8">
                                        <h4>{{$depel->petname}} </h4>
                                        <p>Pemilik : <a href="{{url('adminix/user/detail/'.$depel->id)}}">{{$depel->name}}</a></p>
                                                                                       <p class="marsot">Jenis Kelamin @if($depel->petsex == 1)
                            Jantan <img src="{{ url('icon/male.png') }}" width="16" height="16">
                            @else
                            Betina <img src="{{ url('icon/female.png') }}" width="16" height="16">
                            @endif</p>
                            <b>Kode Hewan : {{$depel->petcode}}</b>
<p class="marsot">Warna Hewan : {{$depel->petcolor}}</p>
<p class="marsot">Jenis Hewan : 
@if($depel->pettype == 1)
Mamalia
@elseif($depel->pettype == 2)
Reptil
@elseif($depel->pettype == 3)
Unggas
@elseif($depel->pettype == 4)
Amfibi
@else
Tidak terklasifikasi
@endif</p>
<p class="marsot">Status Vaksin : 
@if($depel->petvaksin == 1)
@else
Belum / Tidak Vaksin
@endif
Sudah Vaksin
</p>    
<p class="marsot">Ciri Hewan : {{$depel->petciri}}</p>
                                   <br>
                                    <a href="{{ url('adminix/peliharaan/edit/'.$depel->petid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i> Edit</a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/peliharaan/delete/'.$depel->petid) }}"><i class="fa fa-trash"></i> Delete</button> 
                                                         </div>
                                                         </div>
                                                         <br>
                                                         <h3>Riwayat Pemeriksaan Dokter</h3>
                                                         <div class="list-group">
                                                         @foreach($riwhew as $r)
  <a href="{{ url('adminix/pemeriksaan/detail/'.$r->percode) }}" class="list-group-item">
    <h4 class="list-group-item-heading">Pemeriksaan <b>{{$r->percode}}</b></h4>
    <p>Pada tanggal {{$r->pertanggal}}</p>
    <p class="list-group-item-text">Anamnesa : {{substr($r->peranamnesa,0,200)}}</p>
  
  </a>
  @endforeach

</div>
                                                         <br>
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