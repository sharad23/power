
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Off Pod Logs
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Off Pods Logs</li>
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
						<th>Id</th>
						<th>Pod</th>
						<th>Off Time</th>
						<th>On Time</th>
						<th>Total off Time</th>
						<th>State</th>
						<th>Group</th>
						<th>Schedule Time</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($offpodlogs as $pod)
							<tr>
								<td>{{$i}}</td>
								<td>
								@if(is_object($pod->pod))
									{{$pod->pod->apiPod->pod}}
								@endif
								</td>
							    <td>{{ $pod->from_time }}</td>
								<td>{{ $pod->to_time   }}</td>
								<?php $difftime = strtotime($pod->to_time ) - strtotime($pod->from_time) ?>
							    <td>{{ date('H:i:s',$difftime) }}</td>

								
								
<?php
$from_time = new DateTime($pod->from_time );
$to_time = new DateTime($pod->to_time);

?>

								
								
									@if($pod->state==0||$pod->state==1)
									<td class="bg-primary">	{{'Blue'}} </td>
									@elseif($pod->state==2)
									<td class="bg-yellow">	{{'Yellow'}} </td>
									@else
									<td class="bg-red">	{{'Red'}} </td>
									@endif
									
									@if($pod->pod->schedule_type == 0)
	                                    <?php $group = $pod->pod->groupSchedules->first();
										$group_id=$group->group->id;
										?> 
	                                    @if(is_object($group))
									      <td>
										  {{HTML::link("groups/$group_id",'Group-'.$group->group->name)}}
										 </td>
									    @else
									       <td></td>
									    @endif
									@else
									    <td></td>
									@endif
									
									
							
								<td>
								{{$pod->schedule_from_time.'-'.$pod->schedule_to_time}}
								</td>
								
								
							</tr>
							<?php $i++;?>
						@endforeach
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

