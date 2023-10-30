@extends('layouts.web')
@section('title','Pengaturan Profil')
@section('content')
@section('js')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputprofilepic").change(function() {
        readURL(this);
    });

</script>
@endsection


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="no-padding-bottom clearfix">



    <!-- For Patient and Families
				============================================= -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix ">
                    <div class="card-user-profile-container ">
                        <div class="card-user-profile-inner dropshadow">
                            <center>
                                <div class="card-user-profile-photo">
                                    <img src="{{asset(Auth::user()->profilepic)}}" class="img-responsive img-circle marbot" style="width: 70% !important; height: 70% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{Auth::user()->name}}</b>
                                </div>
                                @if(Auth::user()->role == 2)
                                @if(Auth::user()->verifadmin == 0)
                                <label style="font-weight: normal; font-size: 80%;" class="label label-warning">Unverified</label>
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close pull-right" style="min-width: 10px;" data-dismiss="alert">&times;</button>
                                    <h4 class="text-center">Peringatan</h4>
                                    <p>Anda belum terverifikasi. Mohon lengkapi persyaratan agar akun anda dapat diverifikasi. Silahkan klik <a href="{{ url('setting/dokter') }}" class="alert-link">di sini</a> untuk melengkapi persyaratan. Banyak benefit yang anda dapatkan jika sudah terverifikasi. Silahkan baca keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">di sini</a>.</p>
                                </div>
                                @else
                                <label class="label label-success">Verified</label>
                                @endif
                                <br>
                                @endif

                                <div class="title">Bio</div>
                                <div class="card-user-profile biography">{{Auth::user()->bio}}</div>
                                <div class="title">Email</div>
                                <div class="card-user-profile email">{{Auth::user()->email}}</div>
                                <div class="title">No. HP</div>
                                <div class="card-user-profile nohp">{{Auth::user()->nohp}}</div>
                                <div class="title">Alamat</div>
                                <div class="card-user-profile alamat">{{Auth::user()->alamat}}</div>
                                @if(Auth::user()->role == 2)
                                <div class="title">Almamater</div>
                                <div class="card-user-profile almamater">
                                    {{Auth::user()->lulusan}} ({{Auth::user()->tahunlulus}})
                                </div>
                                <div class="title">Alamat Klinik</div>
                                <div class="card-user-profile klinik">
                                    {{Auth::user()->klinik}}
                                </div>
                                @endif
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div id="target" class="col-md-8 blog-wrapper clearfix">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard#target')}}">Dashboard</a></li>
                    <li class="active"><a href="{{ url('#')}}">Ubah Profil</a></li>
                </ul>
                <div class="height20"></div>


                <h3 class="light text-center"><span>Ubah Informasi Pengguna</span></h3>

                <div class="height20"></div>

                <div class="dropshadow well">
                    <form class="form-horizontal" method="post" action="{{ url('setting/save') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <fieldset>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Nama Lengkap</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="name" value="{{$edit->name}}" class="form-control" type="text">
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textarea">Bio</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="textarea" name="bio"> {{$edit->bio}}</textarea>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">No HP</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="nohp" value="{{$edit->nohp}}" class="form-control" type="text">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Alamat</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="alamat" value="{{$edit->alamat}}" class="form-control" type="text">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-md-2" for="profile">Profile Picture </label>
                                <div class="col-md-10">
                                    <img src="{{ url($edit->profilepic)}}" id="blah" style="max-width:200px;max-height:200px;" class="img-circle img-responsive" />

                                    <input type="file" id="inputprofilepic" name="profile" class="validate">
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button id="singlebutton" name="submit" class="btn btn-md btn-primary">Ubah</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
