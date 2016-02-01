
@extends('layouts.main')
@section('content')

<style>
.dl-horizontal dt{

    width: 110px;
}
.dl-horizontal dd{
    margin-left: 140px;
}
</style>

		<section class="content-header">
			  <h1>
			   Visits
			  </h1>
			  <ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active"><a href="{{URL::to('/visits')}}">Visits</a></li>
			  </ol>
		</section>
	
	
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header with-border">
							Visit
						</div>
						<div class="box-body">
						
							<div class="table-responsive">
							<table id="example" class="table table-bordered table-hover table-striped">
							<tbody>
							<tr>
								<td>Type:</td><td>{{($visit->type==0)?'Regular':'Urgent'}}</td>
							</tr>
							<tr>
								<td>Visit Date:</td><td>{{$visit->visit_date}}</td>
							</tr>
							<tr>
								<td>Purpose:</td><td>{{$visit->purpose}}</td>
							</tr>
							<tr>
								<td>Status:</td><td>{{($visit->status==1)?'completed':'Pending'}}</td>
							</tr>
							<tr>
								<td>Remark:</td><td>{{$visit->remarks}}</td>
							</tr>
							</tbody>
							</table>
							
							</div>
						
						
						<!--	<dl class="dl-horizontal">
								
								<dt>Type:</dt>
								<dd>{{($visit->type==0)?'Regular':'Urgent'}}</dd>
								<dt>Visit Date:</dt>
								<dd>{{$visit->visit_date}}</dd>
								
								<dt>Purpose:</dt>
								<dd>{{$visit->purpose}}</dd>
								<dt>Status:</dt>
								<dd>{{($visit->status==1)?'completed':'Pending'}}</dd>
								<dt>Remark:</dt>
								<dd>{{$visit->remarks}}</dd>
							</dl> -->
						</div>
					</div>
				</div>
			</div>
		</section>
		
		

		<section class="content">
			<div class="row">
				<div class="col-xs-6">
					<div class="box">
						<div class="box-header with-border">
						Related Staff
						</div>
						<div class="box-body">
							<div class="table-responsive">
							<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<th>Id</th>
								<th>Username</th>
							</thead> 
							<tbody>
							<?php $i =1; ?>
								@foreach($visit->staffs as $staff)
									<tr>
										<td>{{$i}}</td>
										<td>
										@if(is_object($staff))
											{{$staff->username}}
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
			
				<div class="col-xs-6">
					<div class="box">
						<div class="box-header with-border">
						Related Pod
						</div>
						<div class="box-body">
							<div class="table-responsive">
							<table id="example2" class="table table-bordered table-hover table-striped">
							<thead>
								<th>Id</th>
								<th>Pod</th>
							<!--<th>Submeter</th>
								<th>Rack</th>
								<th>Earthing</th>
								<th>Alternative Source</th>
								<th>Power Router</th>-->
							</thead> 
							<tbody>
							<?php $i =1; ?>
								@foreach($visit->pods as $pod)
									<tr>
										<td>{{$i}}</td>	
										<td>
										@if(is_object($pod->pod))
											{{HTML::link("pod_inventories/".$pod->id,$pod->pod->apiPod->pod)}}											
										@endif											
										</td>
									<!--<td>{{($pod->submeter==1)?'On':'Off'}}</td>
										<td>{{($pod->rack==1)?'Yes':'No'}}</td>
										<td>{{($pod->earthing==1)?'Yes':'No'}}</td>
										<td>{{($pod->alternative_source==1)?'Yes':'No'}}</td>
										<td>{{$pod->power_router_ip}}</td>-->
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

