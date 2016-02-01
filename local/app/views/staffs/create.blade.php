
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Staffs
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/staffs')}}">Staffs</a></li>
          </ol>
        </section>
	

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
					<h3 class="box-title">Create</h3>
                </div>
                <div class="box-body">

					 {{ Form::open(array('url' => "staffs", 'method' => 'post','id' =>'test')) }}
						
					   <div class="form-group">
							 {{ Form::label('username', 'Staff') }}
							{{ Form::text('username',null,array('class'=>'form-control')) }}
							 <p class="errors">{{$errors->first('day')}}</p>   
						</div>
						
							{{ Form::submit('Create',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("staffs/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop

