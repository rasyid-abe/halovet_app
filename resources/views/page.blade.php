@extends('layouts.web')
@section('title',$sp->pagejudul.' - ')
@section('content')

			
			<!-- Sub Page Banner
			============================================= -->
			<section class="sub-page-banner text-center" data-stellar-background-ratio="0.3" style="background:url(../{{$sp->pageimg}}) no-repeat  !important;">
				
				<div class="overlay"></div>
				
				<div class="container">
					<h1 class="entry-title"><span>{{$sp->pagejudul}}</span></h1>
				</div>
				
			</section>
    

    
			<!-- Sub Page Content
			============================================= -->
			<div id="sub-page-content" class="no-padding-bottom clearfix">

    	
				
				<!-- For Patient and Families
				============================================= -->
				<div class="container big-font">
					
					
					<div class="row">
					
						<div class="col-md-10 col-md-offset-1">
						{!! $sp->pagedesc !!}
						</div>
	
					</div>
					
				</div>
				
				
				
				
			<div class="height20"></div>
		
		
    
		</div><!--end sub-page-content-->
    
    
    @endsection