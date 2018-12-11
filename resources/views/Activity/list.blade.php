@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{!! Form::open(array('method' => 'GET','route' => 'Activity.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Activity Desciption</h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<a class="btn btn-primary" href="{{ route('Activity.create') }}" role="button">Add new data</a>
					<a class="btn btn-default" href="{{ route('Activity.index') }}" role="button">Show All</a>
					
				</p>
			

			@if ($rows->count())


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of Activity</div>

	                <div class="panel-body">
<div class="table-responsive">

	                  <table class="table table-striped">
							<tr>

								<th>Activity</th>
								
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							@foreach($rows as $row)
							<tr>

								<td>{{$row->Activity or 'DEFAULT'}}</td>
								<td><a class="btn btn-xs btn-success" href="{{ route('Activity.show', $row->Activity_ID)  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                        <a href="{{ action('ActivityController@edit', array($row->Activity_ID)) }}"
			                            class="btn btn-info btn-xs">
			                            <i class="glyphicon glyphicon-pencil"></i>
			                        </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'DELETE', 'route' => array('Activity.destroy', $row->Activity_ID))) }}  	                  
			                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td>    
							</tr>
							@endforeach
					  </table>
</div>
	                </div>
	            </div>
		            {!! $rows->links() !!}

            @else
				There are no records
			@endif
        </div>
    </div>
</div>
@endsection
