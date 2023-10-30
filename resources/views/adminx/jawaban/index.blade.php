@extends('layouts.admin')
@section('title','Thread Diskusi -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Jawaban Diskusi</h3>
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
                                                    <th width="25%">User</th>
                                                    <th width="25%">Isi</th>
                                                    <th width="25%">Thread</th>
                                                    <th width="15%">Aksi</th>
                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($aj as $j)
                                                <tr>
                                                    <th scope="row"><div style="display: inline-block;"><img src="{{ asset($j->profilepic) }}" style="width: 50px; height: 50px;"> {{$j->name}}</div></th>
                                                    <td>{!! strip_tags(substr($j->jawisi,0,250)) !!}</td>
                                                    <td><a href="{{ url('konsultasi/'.$j->konsslug.'#'.$j->jawid) }}">{{$j->konsjudul}}</a></td>
                                                    
                                                    <td>
                                                        
                                                        <a href="{{ url('konsultasi/'.$j->konsslug.'#'.$j->jawid) }}" class="btn btn-primary btn-md"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ url('adminix/jawabandiskusi/edit/'.$j->jawid) }}" class="btn btn-warning btn-md"><i class="fa fa-pencil"></i></a>
                                                         <button type="button" class="btn btn-danger btn-md" id="delete-btn" href="{{ url('adminix/jawabandiskusi/delete/'.$j->jawid) }}"><i class="fa fa-trash"></i></button> 
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
            text: "Anda akan menghapus Jawaban Diskusi ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik Jawaban Diskusi akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Jawaban Diskusi tidak dihapus");
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