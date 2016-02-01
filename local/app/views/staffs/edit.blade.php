
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
					<h3 class="box-title">Edit</h3>
                </div>
                <div class="box-body">

					{{ Form::model($staff , array('url' => "staffs/$staff->id", 'method' => 'put', 'id' =>'test')) }}
						 <div class="form-group">
							 {{ Form::label('username', 'Staff') }}
							{{ Form::text('username',null,array('class'=>'form-control')) }}
							 <p class="errors">{{$errors->first('day')}}</p>   
						</div>
						
							{{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>	
</section>

@stop
