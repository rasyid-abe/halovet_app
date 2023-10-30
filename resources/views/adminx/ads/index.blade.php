@extends('layouts.admin')
@section('title','Iklan -')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Iklan</h3>
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
                                    <h4 class="panel-title"></h4>
                                </div>
                                <div class="panel-body">
                                <form method="post" class="form-horizontal" action="{{url('adminix/ads/update')}}">
                                        {{ csrf_field() }}
                                    <div class="row">
                                        <input type="hidden" name="adsid" value="{{$ed->adsid}}">
                                        
                                        <div class="col-md-4">
                                            <label>Universal Sidebar</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="universalsidebar" style="width: 100%; height: auto;">
                                                {{ $ed->universalsidebar }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Universal Footer</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="universalfooter" style="width: 100%; height: auto;">
                                                {{ $ed->universalfooter }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>User Profile Sidebarr</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="usersidebar" style="width: 100%; height: auto;">
                                                {{ $ed->usersidebar }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Setelah Article</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="afterarticle" style="width: 100%; height: auto;">
                                                {{ $ed->afterarticle }}
                                            </textarea>
                                        </div>
                                        
                                    </div>
                                    <button type="submit" clas="btn btn-md btn-primary">Ubah</button>
                                </form>
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
            text: "Anda akan menghapus Page ini, anda yakin?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Baik, Page akan dihapus", {
              icon: "success",
            });
            window.location.href = href;
          } else {
             icon: "fail",
            swal("Okay, Page tidak dihapus");
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