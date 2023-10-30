@extends('layouts.web')
@section('title','Registrasi')
@section('content')
<script src="{{asset('js/notyf.min.js') }}"></script>
@if (notify()->ready())
<script type="text/javascript">
    var notyf = new Notyf({
        delay: 5000
    });


    // Display an alert notificatio

    // Display a success notification
    notyf. {
        {
            notify() - > type()
        }
    }('{{ notify()->message() }}');

</script>
@endif



<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">
        <div class="row form-login-ya">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <h1 class="text-center login-title">Registrasi Dokter Hewan</h1>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="name" type="text" class="form-control col-md-8" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap (dengan gelar)" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="nohp" type="text" class="form-control col-md-8" name="nohp" placeholder="No HP/Telepon" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="alamat" type="text" class="form-control col-md-8" name="alamat" placeholder="Alamat Lengkap" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="tahunlulus" type="text" class="form-control col-md-8" name="tahunlulus" placeholder="Tahun Lulus" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="lulusan" type="text" class="form-control col-md-8" name="lulusan" placeholder="Lulusan/Almamater" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="klinik" type="text" class="form-control col-md-8" name="klinik" placeholder="Alamat Klinik" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectbasic">Provinsi Klinik</label>
                            <div class="col-md-4">
                                <select id="province" name='province' class="form-control">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectbasic">Kota Klinik</label>
                            <div class="col-md-4">
                                <select id="city" name="city" class="form-control">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="selectbasic">Pengalaman</label>
                            <div class="col-md-4">
                                <select id="selectbasic" name="pengalaman" class="form-control">
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

                        <input type="hidden" name="role" value="2">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary text-center">
                                    Daftar
                                </button>
                            </div>
                        </div>

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
    $(function(){
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
