
@extends('layouts.app')

@section('content')<br>

<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-12 ">
	        
	        <div>
	       		<strong style="padding-left: 300px; font-size: 50px; position: fixed;" class="blinking">Student Behaviour</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; ">{{$getTerm}}</span>{{$getYear}}</strong></div><br><br>
	       	<br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					<div class="col-md-8">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('studentbehaviour.create')}}" >Add New Behaviour</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('studentbehaviour.index') }}" role="button">Show All</a>

						 <a href="{{url('/terminalscore')}}" class="btn btn-primary">Return To Scores</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					<div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'studentbehaviour.search')) !!}  
			            {{-- {!! Form::label('searchString', 'Search:') !!} --}}
			            {!! Form::text('searchString', null, array('placeholder'=>'Search By Student Name')) !!}
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
					</div>
				</div><br>
			

			@if (count($rows))

<form action="{{ route('categories11.deleteMultiple') }}" method="post">
    {{ csrf_field() }}
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                {{-- <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Students Behaviour</div> --}}

	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Students Behaviour</th>
                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing {{($rows->currentpage()-1)*$rows->perpage()+1}} to {{$rows->currentpage()*$rows->perpage()}} of {{$rows->total()}} entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	{{-- <tr class="info"> --}}
                   <p>
                              {{-- <td style="font-size: 30px;: ;"> <input type="checkbox" id="selectAll" /> Select all</td> --}}
		                     
		                     {{--  </tr> --}}
		                   <div class="col-md-12"> 
		                     <td><button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
								<th>#</th>
							 	<th style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/>Select all</label></th>
								
								<th class="col-sm-2">Student Name</th>
								{{-- <th>Subject</th> --}}					
								<th class="col-sm-2">Class</th>
								<th>Year</th>
								<th>Term</th>
								<th>Attendance Expected</th>
								<th>Actual Attendence</th>
								<th>Interest</th>
								<th>Teacher Remarks</th>
								<th>Headmaster Remarks</th>
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $i=>$row)
							<tr>
								<td> {{ ($rows->currentpage()-1) * $rows->perpage() + $i + 1 }}</td>
                        <td><input type="checkbox" name="categories11[]" class="checkboxes" value="{{ $row->StudentPerformanceID }}" /></td>

                            <!--  <td>{{$row->SchoolIfoID or 'DEFAULT'}}</td> -->
                                {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                                <td class="col-sm-2">{{$row->StudentName or 'DEFAULT'}}</td>
                               {{--  <td>{{$row->SubjectName or 'DEFAULT'}}</td> --}}
                                <td class="col-sm-2">{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->TermName or 'DEFAULT'}}</td>
                                <td>{{$row->AttendanceExpected or 'DEFAULT'}}</td>
                                <td>{{$row->ActualAttendance or 'DEFAULT'}}</td>
                                <td>{{$row->Interest}}</td>    
                                <td>{{$row->ClassTeacherRemarks or 'DEFAULT'}}</td>
                                <td>{{$row->HeadTeacherRemarks or 'DEFAULT'}}</td>

                             {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								<td><a class="btn btn-xs btn-success" href="{{ route('studentbehaviour.show',[$row->StudentPerformanceID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('studentbehaviourController@edit', array($row->StudentPerformanceID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('studentbehaviour.destroy',$row->StudentPerformanceID))) }}  	                  
			                        {{ Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure you want to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td> 
			                     
							</tr>
							@endforeach
                     </form>
					  </table>
                          <div style="margin-left: 600px;">
					  	@if ($rows->lastPage() > 1)
                         <ul class="pagination">
	                             <li class="{{ ($rows->currentPage() == 1) ? ' disabled' : '' }}">
	                                 <a href="{{ $rows->url(1) }}">Previous</a>
	                             </li>
                            @for ($i = 1; $i <= $rows->lastPage(); $i++)
	                           <li class="{{ ($rows->currentPage() == $i) ? ' active' : '' }}">
	                                 <a href="{{ $rows->url($i) }}">{{ $i }}</a>
	                           </li>
                           @endfor
                             <li class="{{ ($rows->currentPage() == $rows->lastPage()) ? ' disabled' : '' }}">
                                  <a href="{{ $rows->url($rows->currentPage()+1) }}" >Next</a>
                             </li>
                         </ul>
                      @endif
					  </div>
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


