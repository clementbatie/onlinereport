@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class="container spark-screen">
    <div class="row">

		

        <div class="col-md-10 col-md-offset-1">
        	


	        <h1>Year/Term Setup </h1>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				
					  <div class="row">

					<div class="col-md-5">
                    <a class="btn btn-primary" href="{{route('yeartermsetup.create')}}" >Add new data</a>
					<a class="btn btn-default" href="{{ route('yeartermsetup.index') }}" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
                     </div>
                    <div class="col-md-6">
			        	{!! Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')) !!}  
					            {!! Form::label('searchString', 'Quick Search:') !!}
					            {!! Form::text('searchString') !!}
					     	
								{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
					 
					    {!! Form::close() !!}
	                </div>
					</div><br>
			
			

			@if (count($rows))


				
	            <div class="panel panel-primary">
	                <div class="panel-heading">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
							<!-- 	<th>#</th> -->
								<th>Year</th>					
								<th>Term</th>

							</tr>
							@foreach($rows as $row)
							<tr>

                             <td>{{$row->Year or 'DEFAULT'}}</td>
                             <td>{{$row->TermName or 'DEFAULT'}}</td>


								<td><a class="btn btn-xs btn-success" href="{{ route('yeartermsetup.show',[$row->Year_Term_SetipID])  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('yeartermsetupController@edit', array($row->Year_Term_SetipID)) }}"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('yeartermsetup.destroy',$row->Year_Term_SetipID))) }}  	                  
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
		            

            @else
				There are no records
			@endif
        </div>
    </div>
</div>

@endsection
