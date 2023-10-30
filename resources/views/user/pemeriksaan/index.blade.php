@extends('layouts.web')
@section('title','Pemeriksaan - ')
@section('content')
@section('css')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
@endsection
  
<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

        <div class="col-md-3">

<!-- Categories Widget
            ============================================= -->
<div class="sidebar-widget clearfix ">
    <div class="card-user-profile-container ">
        <div class="card-user-profile-inner">
            <center>
                <h4>Menu Ambulatoir</h4>
            </center>
                <ul class="list-group" style="border:none;">
                    <a href="" class="list-group-item">Ambulatoir Baru</a>
                    <a href="" class="list-group-item">Nota Baru</a>
                    <a href="" class="list-group-item">Riwayat Pemeriksaan</a>
                    <a href="" class="list-group-item">Porta ac consectetur ac</a>
                    <a href="" class="list-group-item">Vestibulum at eros</a>
                  </ul>
        </div>
    </div>
</div>
</div>


            <div class="col-md-9 blog-wrapper clearfix" id="target">



                <div class="height20"></div>


                <h2 class="text-center light"><span>Riwayat Pemeriksaan Hewan</span></h2>
       
               
                <div class="height40"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" id="tabelpemeriksaan">
                        <thead>
                            <tr>
                                <th width="10%">Tanggal Periksa</th>
                                <th width="15%">Kode Hewan</th>
                                <th width="55%">Diagnosa</th>
                                <th width="10%">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($per as $p)
                            <tr>
                                <td>@php echo date("m-d-Y", strtotime($p->pertanggal)) @endphp</td>
                <td>{{$p->perpetid}}</td>
                <td>{{strip_tags(substr($p->peranamnesa,0,200))}}<br>
                    {{strip_tags(substr($p->perumum,0,200))}}<br>{{strip_tags(substr($p->pengobatan,0,200))}}</td>
               
                <td>
                    <a href="{{ url('dashboard/pemeriksaan/edit/'.$p->percode) }}" class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i></a>
                    <a href="{{ url('dashboard/pemeriksaan/detail/'.$p->percode) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-danger btn-sm" id="delete-btn" href="{{ url('dashboard/pemeriksaan/delete/'.$p->percode) }}"><i class="fa fa-trash-o"></i></a>
                </td>

                </tr>
                @endforeach
                </tbody>
                </table>
            </div>

            
            
            <script type="text/javascript">
             $('#tabelpemeriksaan').DataTable();
                $(document).ready(function() {
                    $('.btn-danger').on('click', function(e) {
                        e.preventDefault(); //cancel default action

                        //Recuperate href value
                        var href = $(this).attr('href');
                        var message = $(this).data('confirm');

                        //pop up
                        swal({
                                title: "Anda Yakin?",
                                text: "Anda akan menghapus Ambulatoir ini, anda yakin?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    swal("Baik, Ambulatoir ini akan dihapus", {
                                        icon: "success",
                                    });
                                    window.location.href = href;
                                } else {
                                    icon: "fail",
                                    swal("Okay, Ambulatoir ini tidak dihapus");
                                }
                            });
                    });
                });

            </script>
        </div>
    </div>
</div>

<!--end sub-page-content-->
@section('js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
@endsection

@endsection
