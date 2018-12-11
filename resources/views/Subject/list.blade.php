@extends('layouts.app')

@section('content')<br><br><br><br>

<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	         	<div>
	       		<strong style="padding-left: 370px; font-size: 50px; position: fixed;" class="blinking">Subjects</strong>
	       	</div><br><br><br><br>
	       	<legend></legend>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					<div class="col-md-6">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('subject.create')}}" >Add new data</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('subject.index') }}" role="button">Show All</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					<div class="col-md-6">
						{!! Form::open(array('method' => 'GET','route' => 'subject.search')) !!}  
			            {{-- {!! Form::label('searchString', 'Quick Search:') !!}
			            {!! Form::text('searchString') !!} --}}
			            {!! Form::text('searchString', null, array('placeholder'=>'By Subject Name')) !!}
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
					</div>
				</div><br>
			

			@if (count($rows))

<form action="{{ route('categories1.destroy') }}" method="post">
    {{ csrf_field() }}
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Students</div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	{{-- <tr class="info"> --}}
                   <p>
                              {{-- <td style="font-size: 30px;: ;"> <input type="checkbox" id="selectAll" /> Select all</td> --}}
		                     
		                     {{--  </tr> --}}
		                       <div class="col-sm-10"> 
		                     <td> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
							 	<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Subject</th>					
								<th>Class</th>
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $row)
							<tr>
								
                        <td><input type="checkbox" name="categories1[]" class="checkboxes" value="{{ $row->SubjectID }}" /></td>

                            <td>{{$row->SubjectName or 'DEFAULT'}}</td>
                             <td>{{$row->ClassName or 'DEFAULT'}}</td>
                             {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								<td><a class="btn btn-xs btn-success" href="{{ route('subject.show',[$row->SubjectID])  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('subjectsController@edit', array($row->SubjectID)) }}"
			                           class="btn btn-info btn-xs">
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('subject.destroy',$row->SubjectID))) }}  	                  
			                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td> 
			                     
							</tr>
							@endforeach

							
                </form>
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
