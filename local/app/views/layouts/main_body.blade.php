
<div class="wrapper">
  
	@if(!Request::is('login'))
	    @include('layouts.header')
	@endif
 

	<div class="content-wrapper">	
			
						@if(Session::has('error'))					
							@if ($alert = Session::get('error'))
								<div class="alert alert-danger alert-dismissible role="alert"">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>{{ $alert }}</strong>
								</div>
							@endif
						@endif
						
						@if(Session::has('success'))					
							@if ($alert = Session::get('success'))
								<div class="alert alert-success alert-dismissible role="alert"">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>{{ $alert }}</strong>
								</div>
							@endif
						@endif
								
			
						@yield('content')
		
		
	</div>
	@if(!Request::is('login'))
		@include('layouts.footer')
	@endif
</div>
	
	