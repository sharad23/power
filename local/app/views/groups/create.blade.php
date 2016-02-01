
@extends('layouts.main')
@section('content')

 <section class="content-header">
          <h1>
            Groups
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/groups')}}">Groups</a></li>
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

					{{ Form::open(array('url' => "groups/", 'method' => 'post')) }}
						<div class="form-group">
							{{ Form::label('name', 'Name') }}
								{{ Form::text('name',null,array('name'=>'name','class'=>'form-control')) }}
								<p class="errors">{{$errors->first('name')}}</p>
						</div>
												
							{{ Form::submit('Create',array('class'=>'btn btn-primary')) }}
							{{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
							{{ HTML::link("groups/", 'Cancel',array('class'=>'btn btn-primary','role'=>'button')) }}
					{{ Form::close() }}
					
				</div>
			</div>
		</div>
	</div>	
</section>
 
@stop

