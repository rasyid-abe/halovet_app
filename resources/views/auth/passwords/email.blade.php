@extends('layouts.web')
@section('title','Reset Password')
@section('content')
@section('js')<script src="{{asset('js/notyf.min.js') }}"></script>@endsection
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
    @if (notify()->ready())

    @endif

    <div class="container">
        <div class="row form-login-ya">
            <div class="col-md-12">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <h1 class="text-center login-title">Masukkan Email untuk mereset password</h1>
                    <div class="panel-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="account-wall">
                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                            <form class="form-signin" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <input id="email" type="email" class="form-control" name="email" placeholder="Masukkan Email anda" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-lg btn-block hvr-grow-shadow">
                                        Reset Passowrd
                                    </button>
                                    <div class="height40"></div>
                                    <div class="height20"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end sub-page-content-->



@endsection
