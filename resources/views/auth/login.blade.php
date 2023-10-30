@extends('layouts.web')
@section('title','Login')
@section('content')



<!-- Sub Page Content
			============================================= -->


<div id="sub-page-content" class="clearfix">

    <!--  INI LOGIN PAGE YG KUBUAT  -->
    <div class="container">
        <div class="row form-login-ya">
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Masuk untuk melanjutkan ke Hallovet</h1>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif


                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif

                        </div>

                        <button class="btn btn-lg btn-primary btn-block hvr-grow-shadow" type="submit">
                            Masuk</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Ingat saya
                        </label>
                        <a href="{{ route('password.request') }}" class="pull-right need-help">Lupa password? </a><span class="clearfix"></span>


                    </form>
                </div>
                <a href="{{ url('register') }}" class="text-center new-account">Buat akun baru </a>
            </div>
        </div>
    </div>
    <!-- INI BATAS LOGIN PAGE YG KUBUAT -->



</div>



<!--end sub-page-content-->





@endsection
