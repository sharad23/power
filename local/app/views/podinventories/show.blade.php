
@extends('layouts.main')
@section('content')
		
        <section class="content-header">
          <h1>
            Pod Inventory
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('/pod_inventories')}}"> Pod Inventory</a></li>
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
						<th>Pod</th>
						<th>Submeter</th>
						<th>Rack</th>
						<th>Earthing</th>
						<th>Alternative Source</th>
						<th>Power Router</th>
						<th>Action</th>
					</thead> 
					<tbody>
							<tr>
								<td>								
								@if(is_object($podinventory->pod))
									{{$podinventory->pod->apiPod->pod}}
								@endif	
								</td>
								<td>{{($podinventory->submeter==1)?'On':'Off'}}</td>
								<td>{{($podinventory->rack==1)?'Yes':'No'}}</td>
								<td>{{($podinventory->earthing==1)?'Yes':'No'}}</td>
								<td>{{($podinventory->alternative_source==1)?'Yes':'No'}}</td>
								<td>{{$podinventory->power_router_ip}}</td>
											
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

