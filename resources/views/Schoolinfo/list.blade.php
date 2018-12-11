@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'schoolinfo.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	       

	         <div>
	       		<strong style="padding-left: 240px; font-size: 50px; position: fixed;" class="blinking">School Credentials</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<div class="row">

					<div class="col-md-8">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('schoolinfo.create')}}" >Add New School Detail</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('schoolinfo.index') }}" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->

						 @if(auth()->user()->UserLevelID == 4)
						<a href="{{url('/schoollogo')}}" class="btn btn-primary">Add School Logo</a>
					  @endif
					</div>

					{{-- <div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'schoolinfo.search')) !!}  
			            {{-- {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}
			            {{-- {!! Form::text('searchString', null, array('placeholder'=>'   Search By School Name')) !!}
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
					</div>  --}}


					<div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'schoolinfo.search')) !!}  
			            {{--  {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}

			            {!! Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By School Name')) !!}

			            {{-- {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) }} --}}
			     	 
						{!! Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) !!}
			 
			            {!! Form::close() !!}
					</div>

				</div><br>
			

			@if (count($rows))

<form action="{{ route('categories12.deleteMultiple') }}" method="post">
    {{ csrf_field() }}
	 <thead>
	 	<tr>
				
	            <div class="panel panel-primary">
	                <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of School Detail</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	<p>
		                       <div class="col-sm-10"> 
		                          <td> <button class="btn btn-danger">Delete Checked</button></td>
		                       </div> 
		                </p>
							<tr>
								<!-- <th>SchoolIfoID</th> -->
								<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td> 
								<th>Name of School</th>					
								<th>Address</th>
								<th>Contact Nos</th>
								<th>School Code</th>
								<th>Report Name</th>

							</tr>
		</tr>
							@foreach($rows as $row)
							<tr>
                               <!--  <td>{{$row->SchoolIfoID or 'DEFAULT'}}</td> -->
                               <td><input type="checkbox" name="categories12[]" class="checkboxes" value="{{ $row->SchoolIfoID }}" /></td>
                                <td>{{$row->Name or 'DEFAULT'}}</td>
                                <td>{{$row->Address or 'DEFAULT'}}</td>
                                <td>{{$row->ContactNos or 'DEFAULT'}}</td>
                                <td>{{$row->SchoolCode or 'DEFAULT'}}</td>
                                <td>{{$row->reportname or 'DEFAULT'}}</td>
                                
								<td><a class="btn btn-xs btn-success" href="{{ route('schoolinfo.show',[$row->SchoolIfoID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('SchoolinfoController@edit', array($row->SchoolIfoID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('schoolinfo.destroy',$row->SchoolIfoID))) }}  	                  
			                        {{ Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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
<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>

@endsection
