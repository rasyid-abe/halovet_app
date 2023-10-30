@extends('layouts.web')
@section('title','Pengaturan Profil Dokter')
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

    unction readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputsurat").change(function() {
        readURL(this);
    });

</script>
@endsection

@if (notify()->ready())
<script type="text/javascript">
    swal({
        title: "{!! notify()->message() !!}",
        text: "{!! notify()->option('text') !!}",
        icon: "{{ notify()->type() }}",
        //        if(notify() - > option('timer'))
        // timer: {
        // {
        // notify() - > option('timer')
        // }
        // },
        // showConfirmButton: false
        //endif
    });

</script>
@endif
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
                @if(Auth::user()->role == 2)
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard') }}">Konsultasi</a></li>
                    <li><a href="{{ url('dashboard/pemeriksaan#target') }}">Ambulatoir</a></li>
                    <li><a href="{{ url('dashboard/post#target')}}">Artikel Saya</a></li>
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                    <li class="active"><a href="{{ url('#') }}">Pengaturan Dokter</a></li>
                </ul>
                @else

                @endif
                <div class="height20"></div>


                <h3 class="light text-center"><span>Ubah Pengaturan Dokter</span></h3>

                <div class="height20"></div>


                <div class="well">
                    <form class="form-horizontal" method="post" action="{{ url('setting/dokter/save') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <fieldset>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Tahun Lulus</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="tahunlulus" value="{{$editdok->tahunlulus}}" class="form-control" type="text">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Almamater / Lulusan</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="lulusan" value="{{$editdok->lulusan}}" class="form-control" type="text">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Alamat Klinik</label>
                                <div class="col-md-10">
                                    <input id="textinput" name="klinik" value="{{$editdok->klinik}}" class="form-control" type="text">
                                </div>
                            </div>                            


                            <div class="form-group">
                                    <label class="col-md-2 control-label" for="selectbasic">Provinsi Klinik</label>
                                    <div class="col-md-10">
                                        <select id="province" name='province' class="form-control">
                                            
                                        </select>
                                    </div>
                                </div>
        
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="selectbasic">Kota Klinik</label>
                                <div class="col-md-10">
                                    <select id="city" name="city" class="form-control">
                                            
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="selectbasic">Pengalaman</label>
                                <div class="col-md-10">
                                    <select id="selectbasic" name="pengalaman" class="form-control">
                                        <option value="{{$editdok->pengalaman}}" selected> Kurang dari 1 Tahun </option>
                                        <option value="0"> Kurang dari 1 Tahun </option>
                                        <option value="1"> 1 Tahun</option>
                                        <option value="2"> 2 Tahun</option>
                                        <option value="3"> 3 Tahun</option>
                                        <option value="4"> 4 Tahun</option>
                                        <option value="5"> 5 Tahun</option>
                                        <option value="6"> 6 Tahun</option>
                                        <option value="7"> 7 Tahun</option>
                                        <option value="8"> 8 Tahun</option>
                                        <option value="9"> 9 Tahun</option>
                                        <option value="10"> 10 Tahun</option>
                                        <option value="11"> >10 tahun</option>
                                    </select>
                                </div>
                            </div>


                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="control-label col-md-2" for="scanktp">SCAN KTP <p>Max 500kb</p></label>

                                <div class="col-md-10">
                                    <img src="{{asset($editdok->scanktp)}}" id="blah" style="max-width:300px;max-height:200px;" class="img-responsive" />

                                    <input type="file" id="inputprofilepic" name="scanktp" class="validate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="scansurat">SCAN Ijazah Dr Hewan / STRV / KTA PDHI</label>
                                <div class="col-md-10">
                                    <img src="{{asset($editdok->scansurat)}}" id="blah2" style="max-width:300px;max-height:200px;" class="img-responsive" />
                                    <input type="file" name="scansurat" id="inputsurat" class="validate">
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button id="singlebutton" name="submit" class="btn btn-md btn-primary">Ubah</button>
                                </div>
                            </div>

                        </fieldset>

                        <input type="text" name="namaprov" id="namaprov" hidden>
                        <input type="text" name="namakabu" id="namakabu" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->

<script>
    $(function () {
        namaprovinsi();
    });

$("#province").change(function () {
    $('#city').html("");

    str = $('#province').val();
    if (typeof str != 'undefined') {
        id = $('#province').val();
        nama = $('select[name=province]').find('option[value="' + id + '"]').text();
        $('#namaprov').val(nama);
        test = $('#namaprov').val()
        namakota(id);
    }
});

$("#city").change(function () {
    str = $('#city').val();
    if (typeof str != 'undefined') {
        id_kabu = $('#city').val();
        nama = $('select[name=city]').find('option[value="' + id_kabu + '"]').text();
        $('#namakabu').val(nama);
        test = $('#namakabu').val()
    }
});

function namaprovinsi() {
    $.get("{{route('cariprovinsi')}}", function (data) {
        $.each(data, function (index, value) {
            $('#province').append("<option value='" + value.id + "'>" + value.provname + "</option>");
        });
    });
}

function namakota(id_prov) {
    $.get("{{route('carikota')}}?id=" + id_prov, function (data) {
        $.each(data, function (index, value) {
            $('#city').append("<option value='" + value.kotid + "'>" + value.kotname + "</option>");
        });
    });
} 
</script>


@endsection
