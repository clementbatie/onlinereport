@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		<div class="col-md-11 col-md-offset-1">
			{!!Form::open(array('method'=>'GET','route'=>'Zonename.search'))!!}

			<div class="form-group">
				<div class="col-md-2">
					{!!Form::select('type',['Zone_ID'=>'Zone ID','Zone_Name'=>'Zone Name','Deleted' => 'Deleted'],null,['class'=>'form-control selectpicker','id'=>'',
						'placeholder'=>'','data-live-search'=>'true'
						] )!!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-2">
						{!! Form::text('searchstring', null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Member Name','data-live-search'=>'true' ]) !!}

					</div>
				</div>





				<div class="form-group">
					<div class="col-md-2">
						{!!Form::submit('Generate',array('class'=>'btn btn-info'))!!}
					</div>
				</div>
				{!!Form::close()!!}

			</div>
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1> Zone </h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
			
				<p>
					<a class="btn btn-primary" href="{{ route('Zonename.create') }}" role="button">Add new data</a>
					<a class="btn btn-default" href="{{ route('Zonename.create') }}" role="button">Show All</a>
{{--<a class="btn btn-info" href="{{ route('Member.transfer') }}" role="button">Transfer</a>
 --}}					
				</p>
			 

			


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of Records</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>Zone Name</th>
								
								<!-- <th>Floor Name</th>
								
								<th>Rent From</th>
								<th>Rent To</th>
								<th>Client Name</th>
						        <th>Rent Amount</th>
								<th>Comment</th> -->
							</tr>
							@foreach($rows as $row)
							<tr>
								<td>{{$row->Zone_Name or 'DEFAULT'}}</td>
                                <!-- <td>{{$row->RentFrom or 'DEFAULT'}}</td>
                                <td>{{$row->rent_to or 'DEFAULT'}}</td>
                                <td>{{$row->CompanyName or 'DEFAULT'}}</td>
                                <td>{{$row->RentAmount or 'DEFAULT'}}</td>
                               <td>{{$row->Comment or 'DEFAULT'}}</td> -->

								

								<td>
		                        
			                        <a href="{{ action('ZonenameController@edit', array($row->Zone_ID)) }}"
			                            class="btn btn-info btn-xs">
			                            <i class="glyphicon glyphicon-pencil"></i>
			                        </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method'=> 'DELETE', 'route' => array('Zonename.destroy', $row->Zone_ID))) }}  	                  
			                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			             
			                    </td>    
							</tr>
							@endforeach
					  </table>
{{$rows->appends($_GET)->links()}}
	                </div>
	            </div>
		           

        </div>
    </div>
</div>
@endsection
