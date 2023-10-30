<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Admin Login</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="{{asset('dash/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/icomoon/style.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/uniform/css/default.css')}}" rel="stylesheet"/>
        <link href="{{asset('dash/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
      
        <!-- Theme Styles -->
        <link href="{{asset('dash/css/space.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/css/custom.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!-- Page Container -->
        <div class="page-container">
                <!-- Page Inner -->
                <div class="page-inner login-page">
                    <div id="main-wrapper" class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 login-box">
                                <h4 class="login-title">Administrator Sign In</h4>
                                <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>

                                     <div class="form-group">
                            <div class="">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a href="{{ url('/password/reset') }}" class="forgot-link">Lupa Password</a>
                                </form>
                            </div>
                        </div>
                    </div>
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        <!-- Javascripts -->
        <script src="{{asset('dash/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
        <script src="{{asset('dash/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('dash/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('dash/plugins/uniform/js/jquery.uniform.standalone.js')}}"></script>
        <script src="{{asset('dash/plugins/switchery/switchery.min.js')}}"></script>
        <script src="{{asset('dash/js/space.min.js')}}"></script>
    </body>
</html>