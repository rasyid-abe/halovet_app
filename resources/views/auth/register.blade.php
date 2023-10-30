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

    <div class="height40"></div>
    <div class="container">
        <div class="row form-login-ya">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <h1 class="text-center login-title">Buat akun baru</h1>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" placeholder="Konfirmasi Password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <input id="nohp" type="text" class="form-control" placeholder="No HP/Telepon" name="nohp" required autofocus>
                        </div>
                        <div class="form-group">
                            <input id="alamat" type="text" placeholder="Alamat Lengkap" class="form-control" name="alamat" required autofocus>
                        </div>
                        <input type="hidden" name="role" value="1">
                        <button type="submit" class="btn btn-primary btn-lg btn-block hvr-grow-shadow">
                            Daftar
                        </button>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!--end sub-page-content-->



@endsection
