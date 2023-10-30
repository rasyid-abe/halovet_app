@extends('layouts.web')
@section('title','Login')
@section('content')
@section('js')<script src="{{asset('js/notyf.min.js') }}"></script>@endsection
  @if (notify()->ready())
 <script type="text/javascript">
var notyf = new Notyf(
  {
    delay:5000
  });


// Display an alert notificatio

// Display a success notification
notyf.{{ notify()->type() }}('{{ notify()->message() }}');
 </script>
 @endif

			
			<!-- Sub Page Banner
			============================================= -->
			<section class="sub-page-banner text-center" data-stellar-background-ratio="0.3">
				
				<div class="overlay"></div>
				
				<div class="container">
					<h1 class="entry-title">Login</h1>
					<p>Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets.</p>
				</div>
				
			</section>
    
    
			
			<!-- Sub Page Content
			============================================= -->
			<div id="sub-page-content" class="clearfix">
@if (notify()->ready())

 @endif

				<div class="container">
					<div class="row">
                    <div class="col-md-12">
           <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
				</div>
     </div>
     </div>
			</div><!--end sub-page-content-->
    

    
@endsection