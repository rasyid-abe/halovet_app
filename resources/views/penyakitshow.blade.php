@extends('layouts.web')
@section('title','Penyakit '.$ps->pennama)
@section('content')

    
	
			<!-- Sub Page Content
			============================================= -->
			<div id="sub-page-content" class="clearfix">
        
				<div class="container">
					
					<div class="row">
					
						<div class="col-md-8 blog-wrapper clearfix">
							
							<h2 class="bordered">{{$ps->pennama}}</h2>
							
							
							<article class="blog-item blog-full-width blog-detail">
								
								<div class="blog-thumbnail">
									<img alt="" src="{{asset($ps->penthumb)}}">
								</div>
								
								<div class="blog-content">
								<h2>{{$ps->pennama}}</h2>
									{!! $ps->penisi !!}     
								</div>
											
											
								<div class="share-post clearfix">
									<label>Share this Post!</label>
									<ul class="social-rounded">
									<li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a></li>
										<li><a href="https://twitter.com/home?status={{$ps->pennama}}%20{{url()->current()}}"><i class="fa fa-twitter"></i></a></li>
										<li><a href="https://plus.google.com/share?url={{url()->current()}}"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
											
							</article>
							
							
							
						
	
							
						</div>
						
						
					@include('layouts.sidebar')
						
					</div>
					
				</div>
    
    

		</div><!--end sub-page-content-->
    
    
    @endsection