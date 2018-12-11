@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="container spark-screen">
    <div class="row">

		{!! Form::open(array('method' => 'GET','route' => 'terminalscore.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!}
	
	
	

        <div class="col-md-11 col-md-offset-1">
	        <h1>Terminal Scores </h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<a class="btn btn-primary" href="{{route('terminalscore.create')}}" >Add new data</a>
					<a class="btn btn-default" href="{{ route('terminalscore.index') }}" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					
				</p>
			

			@if (count($rows))


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<th>School Code</th>
									<th>Student Name</th>
								<th>Subject</th>					
								<th>Class</th>
								<th>Year</th>
								<th>Term</th>
								<th>Class Score</th>
								<th>Exams Score</th>
								<th>Total Score</th>
								<th>Position</th>
								<th>Remarks</th>
						

							</tr>
							@foreach($rows as $row)

							<tr>
                               <!--  <td>{{$row->SchoolIfoID or 'DEFAULT'}}</td> -->
                                <td>{{$row->SchoolCode or 'DEFAULT'}}</td>
                                <td>{{$row->StudentName or 'DEFAULT'}}</td>
                                <td>{{$row->SubjectName or 'DEFAULT'}}</td>
                                <td>{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->TermName or 'DEFAULT'}}</td>
                                <td>{{$row->classscore or 'DEFAULT'}}</td>
                                <td>{{$row->examscore or 'DEFAULT'}}</td>
                                <td>{{$row->totalscore or 'DEFAULT'}}</td>    
                                <td>{{$row->position or 'DEFAULT'}}</td>
                                <td>{{$row->remarks or 'DEFAULT'}}</td>

		<td><a class="btn btn-xs btn-success" href="{{ route('terminalscore.show',[$row->TerminanlScoreID])  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			         <a href="{{ action('terminalscoreController@edit', array($row->TerminanlScoreID)) }}"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    	=> 'delete', 'route' => array('terminalscore.destroy',$row->TerminanlScoreID))) }}  	                  
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
