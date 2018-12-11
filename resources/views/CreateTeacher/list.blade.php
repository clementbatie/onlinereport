@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{!! Form::open(array('method' => 'GET','route' => 'teacher.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        <h1>Teacher </h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<a class="btn btn-primary" href="{{route('teacher.create')}}" >Add new data</a>
					<a class="btn btn-default" href="{{ route('teacher.index') }}" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					
				</p>
			

			@if (count($rows))


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  teachers</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>Teacher Name</th>
								<th>Phone</th>					
				                <th>Class</th>
				                <th>Subject</th>
							</tr>
							@foreach($rows as $i=>$row)

							<tr>
                                <td>{{$row->Name or 'DEFAULT'}}</td>
                                <td>{{$row->PhoneNo or 'DEFAULT'}}</td>
                                <td>{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->SubjectName or 'DEFAULT'}}</td>
                              
                 
								<td><a class="btn btn-xs btn-success" href="{{ route('teacher.show',[$row->SetupTeacherID])  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('TeachersController@edit', array($row->SetupTeacherID)) }}"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('teacher.destroy',$row->SetupTeacherID))) }}  	                  
			                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td>    
							</tr>
							@endforeach
					  </table>
                        {!! $rows->links() !!}
	                </div>
	            </div>
		           

            @else
				There are no records
			@endif
        </div>
    </div>
</div>

@endsection
