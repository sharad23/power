
@extends('layouts.main')
@section('content')


<div class="container" style="position:absolute;top:5%;left:5%;">
	
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
</div>

<div class="container" style="position:absolute;top:20%;left:5%;">

        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default" style="box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Login</h3>
                    </div>
					
				  
                    <div class="panel-body">
				  
					{{ Form::open(array('url'=>'/login','method'=>'POST', 'class'=>'form-signup','role'=>'form')) }}
                           
                            <div class="form-group">
							{{ Form::text('staff_username', null, array('id'=>'username','class'=>'form-control input-sm', 'placeholder'=>'Username')) }}
							<p class="errors">{{$errors->first('staff_username')}}</p>
							 </div>

                            <div class="form-group">

                               {{ Form::password('staff_password', array('id'=>'password','class'=>'form-control input-sm', 'placeholder'=>'Password')) }}
							<p class="errors">{{$errors->first('staff_password')}}</p>
							 </div>

                            <div class="form-group">
							
							{{ Form::submit('Login', array('class'=>'btn btn-info btn-block'))}} 
							
							{{ Form::token() }}
							{{ Form::close() }}
							
                    </div>
                </div>
            </div>
        </div>
    </div>
	
@stop