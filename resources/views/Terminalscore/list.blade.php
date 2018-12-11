
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
	       		<strong style="padding-left: 370px; font-size: 50px; position: fixed;" class="blinking">Terminal Scores</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 850px; margin-top: 20px;">{{$getTerm}}</span>{{$getYear}}</strong></div>
            <br><br>
	       
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					<div class="col-md-7">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('terminalscore.create')}}" >Add New Terminal Score</a>

						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('terminalscore.index') }}" role="button">Refresh</a>

						{{-- <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('studentbehaviour')}}" >Student Behaviour</a> --}}
                       @if(auth()->user()->UserLevelID == 2)
						<a href="{{url('/studentbehaviour')}}" class="btn btn-primary">Student Behaviour</a>
					  @endif
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					<div class="col-md-5">
						<div class="row">
						{!! Form::open(array('method' => 'GET','route' => 'terminalscore.search')) !!}  
			           {{--  {!! Form::label('searchString', 'Search:') !!} --}}
			            <div class="col-md-4">
			           {!! Form::select('classID',$Class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true','id'=>'Class' ]) !!}
			       </div>


			            <div class="col-md-4">
			           {!! Form::select('subjectID',[], null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname')) !!}

	
{{--   {!! Form::select('SubjectID',$Subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname',
   )) !!} --}}
  

			       </div>
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
			            </div>
					</div>

				</div><br>
			

			@if (count($rows))

<form action="{{ route('categories10.deleteMultiple') }}" method="post">
    {{ csrf_field() }}
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	               {{--  <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Terminal Score</div> --}}

	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Terminal Score</th>
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
		                     {{-- <td> <button class="btn btn-primary">Set Positions</button></td> --}}
		                   </div> 
		             </p>
							<tr>
							 	{{-- <td style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td> --}}
								{{-- <th>School Code</th> --}}
								<td>#</td>
								<th>Student Name</th>
								<th>Subject</th>					
								<th>Class</th>
								<th>Year</th>
								<th>Term</th>
								<th>Class Score</th>
								<th>Exams Score</th>
								<th>Total Score</th>
								<th>Grade</th>
								
								<th>Position</th>
								<th>Remarks</th>
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $i=>$row)
							<tr>
								
                        {{-- <td><input type="checkbox" name="categories10[]" class="checkboxes" value="{{ $row->TerminanlScoreID }}" /></td> --}}
                      {{-- @for($is=0; $is>$i; $is++) --}}
                        
                              <td> {{ ($rows->currentpage()-1) * $rows->perpage() + $i + 1 }}</td>
                            <!--  <td>{{$row->SchoolIfoID or 'DEFAULT'}}</td> -->
                                {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                                
                                <td>{{$row->StudentName or 'DEFAULT'}}</td>
                                <td>{{$row->SubjectName or 'DEFAULT'}}</td>
                                <td>{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->TermName or 'DEFAULT'}}</td>
                                <td>{{$row->classscore or 'DEFAULT'}}</td>
                                <td>{{$row->examscore or 'DEFAULT'}}</td>
                                <td>{{($row->totalscore)}}</td> 
                                <td>{{$row->Grade}}</td>
                                  <td>{{$row->position}}</td>
                               {{--  <td>{{$i +1}}</td> --}}
                                <td>{{$row->remarks or 'DEFAULT'}}</td>
                       {{-- @endfor --}}
                             {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								<td><a class="btn btn-xs btn-success" href="{{ route('terminalscore.show',[$row->TerminanlScoreID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('terminalscoreController@edit', array($row->TerminanlScoreID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('terminalscore.destroy',$row->TerminanlScoreID))) }}  	                  
			                        {{ Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
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

