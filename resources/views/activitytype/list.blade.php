@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{!! Form::open(array('method' => 'GET','route' => 'activitytype.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Activitytype</h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<a class="btn btn-primary" href="{{ route('activitytype.create') }}" role="button">Add new data</a>
					<a class="btn btn-default" href="{{ route('activitytype.index') }}" role="button">Show All</a>
					
				</p>
			

			@if ($rows->count())


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of Activitytypes</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>

								<th> Activitytype</th>
								
							
								
								<th></th>
								<th></th>
								<th></th>
							</tr>
							@foreach($rows as $row)
							<tr>

								<td>{{$row->activitytype or 'DEFAULT'}}</td>
                               
                               
								<td><a class="btn btn-xs btn-success" href="{{ route('activitytype.show', $row->id)  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                        <a href="{{ action('ActivitytypeController@edit', array($row->id)) }}"
			                            class="btn btn-info btn-xs">
			                            <i class="glyphicon glyphicon-pencil"></i>
			                        </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'DELETE', 'route' => array('activitytype.destroy', $row->id))) }}  	                  
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
		            {!! $rows->links() !!}

            @else
				There are no records
			@endif
        </div>
    </div>
</div>
@endsection
