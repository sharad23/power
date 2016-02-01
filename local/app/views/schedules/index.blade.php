
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Schedules
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Schedules</li>
          </ol>
        </section>
		
		

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                 {{ HTML::link("schedules/create", 'Create Schedule') }}
                </div>
                <div class="box-body">
					<div class="table-responsive">
					<table id="example" class="table table-bordered table-hover table-striped">
					<thead>
					<tr>
						<th>Group/Day</th>
						<th>Sun</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</tr>
					</thead> 
					<tbody>
						@for ($i = 1; $i <=Group::orderBy('name')->max('name'); $i++)
							<tr>
								<td>{{$i}}</td>
								@for ($j = 0; $j <7; $j++)
									<td>
									@if(isset($grp_schedule[$i][$j]))
										
										@foreach($grp_schedule[$i][$j] as $sch)	
											
											{{ link_to("schedules/$sch[id]/edit",$sch['from'].'-'. $sch['to'] , $attributes = array()) }}<br/>
											
										@endforeach
									@endif				
									</td>
								@endfor
							</tr>
						@endfor
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop


