@extends('layouts.admin')
@section('title',$detper->percode.' - ')
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
                                    <h4 class="panel-title">{{$detper->petname}}</h4>
                                </div>
                                <div class="panel-body">
                     <div class="row marbot">
              <div class="col-md-6 col-sm-6  col-xs-6">
              <h5 style="float: left;">No Pemeriksaan : <b>{{$detper->percode}}</b></h5>
              
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
              <a href="{{ url('adminix/peliharaan/detail/'.$detper->petid) }}"><h5 style="float: right;">Kode Hewan : {{$detper->perpetid}}</h5></a>
                <br>
              </div>
              <div class="col-md-12">
        
 <div class="jawaban">
 <br>
              <p>Tanggal Pemeriksaan : {{$detper->pertanggal}}</p>
 <br>
<b>Anamnesa :</b>
<br>
<p>{{$detper->peranamnesa}}</p>
<b>Pemeriksaan Umum :</b>
<br>
<p>{{$detper->perumum}}</p>
<b>Pemeriksaan Khusus :</b>
<br>
<p>{{$detper->perkhusus}}</p>
<b>Pengobatan / Tindakan:</b>
<br>
<p>{{$detper->pengobatan}}</p>
<br>
</div>
 <div class="action">
 <a href="{{ url('adminix/pemeriksaan/edit/'.$detper->percode) }}" class="btn btn-primary btn-md"> <i class="fa fa-pencil"></i> Edit</a>
<button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/pemeriksaan/delete/'.$detper->percode) }}"><i class="fa fa-trash-o"></i> Delete</button> 
</div>

              </div>
                                
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