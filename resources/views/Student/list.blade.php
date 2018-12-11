@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	{{-- <div style="text-align: center; font-size: 40px; padding-top: "><a style="text-decoration: #ffffff" href="{{url('/login')}}"  class="active_link"><span class=""></span><strong class="blinking">STUDENT REPORT SEARCH</strong></a></div> --}}
	

        <div class="col-md-10 col-md-offset-1">
	        
	       	<div>
	       		<strong style="padding-left: 370px; font-size: 50px; margin-top: -25px; position: fixed;" class="blinking">Students</strong>
	       	</div><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; ">{{$getTerm}}</span>{{$getYear}}</strong></div><br><br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					<div class="col-md-8">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('student.create')}}" >Add New Student</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('student.index') }}" role="button">Show All Records</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					

					<div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  
			            {{--  {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}

			            {!! Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Search By Student Name')) !!}

			            {{-- {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) }} --}}
			     	 
						{!! Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) !!}
			 
			            {!! Form::close() !!}
					</div>
				</div><br>
			
{{-- <a class="w3-bar-item-block w3-button"><i class="fa fa-search"></i></a> --}}
			@if (count($rows))

<form action="{{ route('categories.destroy') }}" method="post">
    {{ csrf_field() }}

	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                {{-- <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Students</div> --}}

                    <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Students</th>
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
		                       <div class="col-sm-12"> 
		                     <td> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		             </p>
							<tr>
							 	{{-- <td> <lable><input type="checkbox" style="font-size: 10px;" id="selectAll" /> Select all</lable></td>  --}}
							 	<th>#</th>
							 	<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Student Name</th>					
								<th>Gender</th>
								<th>DOB</th>
								<th>Class Name</th>
								<th>Parent Name</th>
								<th>Parent Number</th>
								{{-- <th>UniqueCode</th> --}}
								{{-- <th>Show</th>
								<th>Edit</th>
								<th>Delete</th> --}}
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $key=>$row)
							<tr>
							<td> {{ ($rows->currentpage()-1) * $rows->perpage() + $key + 1 }}</td>	
                        <td><input type="checkbox" name="categories[]" class="checkboxes" value="{{ $row->id }}" /></td>

                             <td>{{$row->StudentName or 'DEFAULT'}}</td>
                             <td>{{$row->Gender}}</td>
                             <td>{{$row->DOB}}</td>
                             <td>{{$row->ClassName or 'DEFAULT'}}</td>
                             <td>{{$row->ParentName or 'DEFAULT'}}</td>
                              <td>{{$row->ParentNumber or 'DEFAULT'}}</td>
                              {{-- <td>{{$row->UniqueCode or 'DEFAULT'}}</td> --}}

                            {{--  <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								<td><a class="btn btn-xs btn-success" href="{{ route('student.show',[$row->id])  }}">Show{{-- <i class="btn btn-xs btn-success"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('StudentController@edit', array($row->id)) }}"
			                           class="btn btn-info btn-xs">Edit
			                            <i class="glyphicon glyphicon-pencil"> </i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('student.destroy',$row->id))) }}  	                  
			                        {{ Form::button('<i >Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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
