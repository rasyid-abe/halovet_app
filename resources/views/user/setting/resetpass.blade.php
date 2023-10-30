@extends('layouts.web')
@section('title','Ubah Password')
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
    <div class="container big-font">
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
                    <li class="active"><a href="{{ url('#')}}">Ubah Password</a></li>
                </ul>
                <div class="height20"></div>


                <h3 class="light text-center"><span>Ubah Password Akun</span></h3>

                <div class="height20"></div>

                <div class="dropshadow well">
                    <form class="form-horizontal" id="resetpwform" method="post" action="{{ url('setting/reset') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <fieldset>

                            <input type="hidden" name="userid" value="{{Auth::id()}}">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Password Lama </label>
                                <div class="col-md-10">
                                    <input id="textinput1" name="passwordlama" class="form-control" type="password" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Password Baru</label>
                                <div class="col-md-10">
                                    <input id="textinput2" name="passwordbaru1" class="form-control" type="password" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Konfirmasi Password Baru </label>
                                <div class="col-md-10">
                                    <input id="textinput3" name="passwordbaru2" class="form-control" type="password" requipred="" onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div><!-- Button -->
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button id="reset" name="btnsubmit" type="submit" class="btn btn-md btn-primary">Ubah</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                    <script>
                        $(document).ready(function(e) {
                            document.getElementById('reset').className = 'btn btn-md btn-primary disabled'
                            var resetBtn = document.getElementById('reset');
                            resetBtn.disabled = "disabled";
                        });

                        function checkPass() {
                            //store the password field object into variable
                            var pass1 = document.getElementById('textinput2');
                            var pass2 = document.getElementById('textinput3');

                            var message = document.getElementById('confirmMessage');

                            var goodColor = "#66cc66";
                            var badColor = "#ff6666";

                            if (pass1.value == pass2.value) {
                                pass2.style.backgroundColor = goodColor;
                                message.style.color = goodColor;
                                message.innerHTML = "Password baru cocok!"
                                document.getElementById('reset').className = 'btn btn-md btn-primary'
                                document.getElementById('reset').disabled = false;
                            } else {
                                pass2.style.backgroundColor = badColor;
                                message.style.color = badColor;
                                message.innerHTML = "Password tidak cocok!"
                                document.getElementById('reset').className = 'btn btn-md btn-primary disabled'
                                $("input[type=submit]").attr("disabled", "disabled");
                                event.preventDefault()

                            }
                        }

                        document.getElementById('reset').addEventListener("click", function(event) {
                            event.preventDefault()

                            var pass1 = document.getElementById('textinput2');
                            var pass2 = document.getElementById('textinput3');

                            var message = document.getElementById('confirmMessage');

                            var goodColor = "#66c66";
                            var badColor = "#ff6666";
                            if (pass1.value == pass2.value) {
                                document.getElementById('resetpwform').submit();

                            } else {
                                pass2.style.backgroundColor = badColor;
                                message.style.color = badColor;
                                message.innerHTML = "Password Do Not Match"
                            }
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->


@endsection
