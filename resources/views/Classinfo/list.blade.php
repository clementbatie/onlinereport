
@extends('layouts.app')

@section('content')<br>

<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	       
	         <div>
	       		<strong style="padding-left: 250px; font-size: 50px; position: fixed;" class="blinking">Class Information</strong>
	       	</div><br><br><br>
	       	<legend></legend>
	       	<br><br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					<div class="col-md-8">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('classinfo.create')}}" >Add New Class Info</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('classinfo.index') }}" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					{{-- <div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'classinfo.search')) !!}  
			            {{-- {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}
			           {{--  {!! Form::text('searchString', null, array('placeholder'=>'   Search By Class Name')) !!}
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
					</div>  --}}

					<div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'classinfo.search')) !!}  
			            {{--  {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}

			            {!! Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By Class Name')) !!}

			            {{-- {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) }} --}}
			     	 
						{!! Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) !!}
			 
			            {!! Form::close() !!}
					</div>
				</div><br>
			

			@if (count($rows))

<form action="{{ route('categories9.deleteMultiple') }}" method="post">
    {{ csrf_field() }}
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Class Information</div>

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
								<th>Class</th>					
								<th>OnRoll</th>
								<th>NextTermBegins</th>
								<th>SchoolCloses</th>
								<th>Year</th>
								<th>Term</th>
                                {{-- <th>SchoolCode</th> --}}
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $row)
							<tr>
								
                        <td><input type="checkbox" name="categories9[]" class="checkboxes" value="{{ $row->ClassInfoID }}" /></td>

                                <td>{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->OnRoll or 'DEFAULT'}}</td>
                                <td>{{$row->NextTermBegins or 'DEFAULT'}}</td>
                                <td>{{$row->SchoolCloses or 'DEFAULT'}}</td>
                                
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->TermName or 'DEFAULT'}}</td>
                                {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                             {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								<td><a class="btn btn-xs btn-success" href="{{ route('classinfo.show',[$row->ClassInfoID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('classinfoController@edit', array($row->ClassInfoID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('classinfo.destroy',$row->ClassInfoID))) }}  	                  
			                        {{ Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure you want to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td> 
			                     
							</tr>
							@endforeach
                        </form>

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

<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>

@endsection

