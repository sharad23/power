
@extends('layouts.main')
@section('content')

        <section class="content-header">
          <h1>
            Off Pods
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Off Pods</li>
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
						<th>State</th>
						<th>Group</th>
						<th>From Time</th>
						<th>Schedule</th>
					</thead> 
					<tbody>
					<?php $i =1; ?>
						@foreach($offpods as $pod)
							<tr>
								<td>{{$i}}</td>
								<td>
								@if(is_object($pod->pod))
									{{$pod->pod->apiPod->pod}}
								@endif								
								</td>
																
									@if($pod->state==0||$pod->state==1)
									<td class="bg-primary">	{{'Blue'}} </td>
									@elseif($pod->state==2)
									<td class="bg-yellow">	{{'Yellow'}} </td>
									@else
									<td class="bg-red">	{{'Red'}} </td>
									@endif
								
								@if($pod->pod->schedule_type == 0)
                                    <?php $group = $pod->pod->groupSchedules->first();
										  $group_id=$group->group->id;									?> 
                                    @if(is_object($group))
								      <td> {{HTML::link("groups/$group_id",'Group-'.$group->group->name)}}</td>
								    @else
								       <td></td>
								    @endif
								@else
								<td></td>
								@endif
								<td>{{$pod->created_at }}</td>
								<td>									
									@if($pod->schedule_id!= 0)
										{{$pod->schedule->from_time.'-'.$pod->schedule->to_time}}
									@endif
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

