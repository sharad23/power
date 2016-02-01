
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
                <div class="box-header">
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead>
						<th>Group/Day</th>
						<th>Sun</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</thead>
					<tbody>
					<tr>
						<td>{{$schedule['id']}}</td>
						@for ($i = 0; $i < 7; $i++)
						<td>	
							@if(isset($schedule[$i]))			
										
										@foreach($schedule[$i] as $sch)
											{{ $sch['from'].'-'. $sch['to']}}</br/>	
										@endforeach	
											
							@endif			
						</td>
						@endfor
					</tr>
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
