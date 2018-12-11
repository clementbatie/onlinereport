@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{!! Form::open(array('method' => 'GET','route' => 'studentsinfo.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Parents </h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<a class="btn btn-primary" href="{{route('studentsinfo.create')}}" >Add new data</a>
					<a class="btn btn-default" href="{{ route('studentsinfo.index') }}" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					
				</p>
			

			@if (count($rows))


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>ClassInfoID</th>
								<th>Class</th>					
								<th>OnRoll</th>
								<th>NextTermBegins</th>
								<th>SchoolCloses</th>
								<th>Year</th>
								<th>Term</th>
                                <th>SchoolCode</th>

							</tr>
							@foreach($rows as $row)
							<tr>
                                <td>{{$row->ClassInfoID or 'DEFAULT'}}</td>
                                <td>{{$row->ClassID or 'DEFAULT'}}</td>
                                <td>{{$row->OnRoll or 'DEFAULT'}}</td>
                                <td>{{$row->NextTermBegins or 'DEFAULT'}}</td>
                                <td>{{$row->SchoolCloses or 'DEFAULT'}}</td>
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->Term or 'DEFAULT'}}</td>
                                <td>{{$row->SchoolCode or 'DEFAULT'}}</td>


								<td><a class="btn btn-xs btn-success" href="{{ route('studentsinfo.show',[$row->SetupParentID])  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('ParentController@edit', array($row->SetupParentID)) }}"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('parents.destroy', $row->date,$row->SetupParentID))) }}  	                  
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
