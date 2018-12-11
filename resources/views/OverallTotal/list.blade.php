
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
	       {{--  <h1>  </h1> --}}
	        <div>
	       		<strong style="padding-left: 250px; font-size: 50px; position: fixed;" class="blinking">Overal Position In A Class</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 890px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>

	       	<br><br>

	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif

				<div class="row">

					{{-- <div style="margin-right: -2000px;" class="col-md-4">

						{!! Form::open(array('method' => 'GET','route' => 'student.search')) !!}  

		            {{-- {!! Form::text('searchString', null, array('placeholder'=>'Type Student Name')) !!}
 --}}{{-- <div style="margin-right: 200px;" class="col-md-7">
		            {!! Form::text('searchString',null, array('class' => 'form-control', 'placeholder'=>'Type Student Name', 'id'=>'position',
                          )) !!}
		     	</div>
					{!! Form::submit('Quick Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
		 
		              {!! Form::close() !!} --}}

						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						{{-- <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('overalposition.create')}}" >Add New Terminal Score</a>
 --}}						
						<!-- <a class="btn btn-info" href="{{-- {{ url('parents') }} --}}" role="button">Transfer</a> -->
					{{-- </div>  --}}
             @if(auth()->user()->UserLevelID == 2)
					<div class="col-md-6">
						<div class="row">
						{!! Form::open(array('method' => 'GET','route' => 'overalposition.search')) !!}  
			           {{--  {!! Form::label('searchString', 'Search:') !!} --}}
			            <div class="col-md-4">
			              {!! Form::select('classID',$Class, null, ['class' => 'form-control','id'=>'Class' ]) !!}
			             </div>

                      {{-- 
			             <div class="col-md-4">
			              {!! Form::select('classID',$Class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true','id'=>'Class' ]) !!}
			             </div> --}}
			     	 
						{!! Form::submit('Get Position', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
			            </div>
					</div>
             @endif


					<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{                         route('overalposition.index') }}" role="button"> Refresh</a>

					{{-- <div class="col-md-4">
						<div class="row">
						{!! Form::open(array('method' => 'GET','route' => 'overalposition.searchStudent')) !!}  
			           {{--  {!! Form::label('searchString', 'Search:') !!} --}}
			           {{--  <div class="col-md-7">
			              {!! Form::text('StudentName', null, ['class' => 'form-control selectpicker', 'placeholder'=>'Type Student Name','data-live-search'=>'true','id'=>'Class' ]) !!}
			             </div>
			     	 
						{!! Form::submit('Quick Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
			            </div>
					</div> --}} 
           
					<div class="col-md-4">
						<div class="row">
						{!! Form::open(array('method' => 'GET','route' => 'overalposition.searchStudent')) !!}  
			           {{--  {!! Form::label('searchString', 'Search:') !!} --}}
			            <div class="col-md-6">
			           {!! Form::select('getclassid',$Class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true','id'=>'ClassB' ]) !!}
			       </div>


			            {{-- <div class="col-md-4">
			           {!! Form::select('subjectID',[], null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname')) !!} --}}
  

			      {{--  </div> --}}
			     	 
						{!! Form::submit('Search', array('class' => 'btn btn-primary',"style"=>"background-color:#00663d; color:#fff;")) !!}
			 
			            {!! Form::close() !!}
			            </div>
					</div>

					

					{{-- <a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('overalposition.index2') }}" role="button">Show All Records</a> --}}

					{{-- <li><a a href="{{url('/overalposition2')}}">Enter Terminal Score</a></li> --}}

				</div><br>
			

			@if (count($rows))

{{-- <form action="{{ route('categories10.deleteMultiple') }}" method="post">
    {{ csrf_field() }} --}}
	 <thead>
            <tr>
                <th style="width: 8px;">
	            <div class="panel panel-primary">
	                {{-- <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Student Position In Class</div>
                    --}}
                   <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Student Position In Class</th>
                      </div>
                      <div>
                     {{-- <th style="padding-left: 20px;">
                     	showing {{($rows->currentpage()-1)*$rows->perpage()+1}} to {{$rows->currentpage()*$rows->perpage()}} of {{$rows->total()}} entries
                     </th> --}}

                     <th style="padding-left: 20px;">
                     	{{$rows->total()}} Records 
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
								<th>#</th>
								<th>Student Name</th>
								{{-- <th>UniqueCode</th> --}}					
								<th>Class Name</th>
								<th>Overall Total</th>
								<th>Position</th>
								<th>Class Teacher Name</th>
								<th>Year</th>
								<th>Term</th>
								{{-- <th>School Code</th> --}}
							</tr>
			</tr>
	</thead>
							
							@foreach($rows as $i=>$row)
							<tr>
								
                       {{--  <td><input type="checkbox" name="categories10[]" class="checkboxes" value="{{ $row->TerminanlScoreID }}" /></td> --}}
                      {{-- @for($is=0; $is>$i; $is++) --}}
                        
                                <td> {{ ($rows->currentpage()-1) * $rows->perpage() + $i + 1 }}</td>
                                <td>{{$row->StudentName or 'DEFAULT'}}</td>
                                {{-- <td>{{$row->UniqueCode or 'DEFAULT'}}</td> --}}
                                <td>{{$row->ClassName or 'DEFAULT'}}</td>
                                <td>{{$row->OverallTotal or 'DEFAULT'}}</td>
                                <td>{{$row->Position or 'DEFAULT'}}</td>
                                <td>{{$row->TeacherSetupName or 'DEFAULT'}}</td>
                                <td>{{$row->Year or 'DEFAULT'}}</td>
                                <td>{{$row->TermName or 'DEFAULT'}}</td> 

                       {{-- @endfor --}}
                             {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                              {{-- <div class="col-md-2" style="margin-bottom: 5px">
          <iframe width="560" height="315" src="{{$row->ImageType}}" frameborder="0" allowfullscreen></video>

          </div>  --}}


								{{-- <td><a class="btn btn-xs btn-success" href="{{ route('terminalscore.show',[$row->TerminanlScoreID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}{{-- </i></a> </td>  --}}  
								{{-- <td>
		                        
			                         <a href="{{ action('terminalscoreController@edit', array($row->TerminanlScoreID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td> --}}
			                        
			            
			                      {{-- {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('terminalscore.destroy',$row->TerminanlScoreID))) }}  	                  
			                        {{ Form::button('<i>Delete</i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td>  --}} 
			                     
							</tr>
							@endforeach
                     {{-- </form> --}}
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

