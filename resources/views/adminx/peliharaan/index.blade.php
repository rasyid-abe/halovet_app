@extends('layouts.admin')
@section('title','Hewan Peliharaan Pengguna -')
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
                                                    <th width="45%">Info Hewan</th>
                                                    <th width="25%">Pemilik</th>
                                                    <th width="10%">Pet Code</th>
                                                    <th width="20%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($peliharaan as $p)
                                                <tr>
                                                    <th scope="row">
                                                    <p class="marsot">Nama Hewan : {{$p->petname}} @if($p->petsex == 1)
                            <img src="{{ url('icon/male.png') }}" width="16" height="16">
                            @else
                            <img src="{{ url('icon/female.png') }}" width="16" height="16">
                            @endif</p>
                            
<p class="marsot">Warna Hewan : {{$p->petcolor}}</p>
<p class="marsot">Jenis Hewan : 
@if($p->pettype == 1)
Mamalia
@elseif($p->pettype == 2)
Reptil
@elseif($p->pettype == 3)
Unggas
@elseif($p->pettype == 4)
Amfibi
@else
Tidak terklasifikasi
@endif</p>
<p class="marsot">Status Vaksin : 
 @if($p->petvaksin == 1)
Belum / Tidak Vaksin
@else
Sudah Vaksin
@endif
</p>    
<p class="marsot">Ciri Hewan : {{$p->petciri}}</p>

        
                                                    </th>
                                                    <td><a href="{{ url('adminix/user/detail/'.$p->petowner) }}">{{$p->name}}</a></td>
                                                    <td>{{$p->petcode}}</td>
                                                    <td>
                                                        <a href="{{ url('adminix/peliharaan/edit/'.$p->petid) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('adminix/peliharaan/detail/'.$p->petid) }}" class="btn btn-warning btn-md"><i class="fa fa-eye"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/peliharaan/delete/'.$p->petid) }}"><i class="fa fa-trash"></i></button> 
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