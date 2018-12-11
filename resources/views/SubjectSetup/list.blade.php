@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'subject2.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-10 col-md-offset-1">
        	{{-- <div style="padding-left: 400px; position: fixed;">
	        <h1></h1>
	    </div><br><br><br><br><br> --}}

	     <div>
	       		<strong style="padding-left: 350px; font-size: 50px; position: fixed;" class="blinking">Subjects</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; ">{{$getTerm}}</span>{{$getYear}}</strong></div><br>
	       	<br><br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				{{-- <p>
					<a class="btn btn-primary" href="{{route('subject2.create')}}" >Add new data</a>
					<a class="btn btn-default" href="{{ route('subject2.index') }}" role="button">Show All</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					
				</p> --}}

				<div class="row">

					<div class="col-md-8">
						{{-- <div style="background-color:#313b3d; padding-top: 10px; padding-bottom: 10px;"> --}}
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{route('subject2.create')}}" >Add New Subject</a>
						<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('subject2.index') }}" role="button">Refresh</a>
						<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> -->
					</div>

					<div class="col-md-4">
						{!! Form::open(array('method' => 'GET','route' => 'subject2.search')) !!}  
			            {{--  {!! Form::label('searchString', 'Quick Search:') !!} --}}
			            {{-- {!! Form::text('searchString') !!} --}}

			            {!! Form::text('searchString', null, array('class' => 'inputForm',"style"=>" font-size:18px;",'placeholder'=>'Type Subject Name')) !!}

			            {{-- {{ Form::submit('Submit', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) }} --}}
			     	 
						{!! Form::submit('Search', array('class' => 'inputForm',"style"=>"background-color:#00663d; color:#fff; font-size:18px;")) !!}
			 
			            {!! Form::close() !!}
					</div>
				</div><br>
			

			@if (count($rows))


				
	           <form action="{{ route('categories7.deleteMultiple') }}" method="post">
                {{ csrf_field() }}
                <thead>
                    <tr>
                      <th style="width: 8px;">
	            <div class="panel panel-primary">
	                {{-- <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of Subjects</div> --}}
                     <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of Subjects</th>
                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing {{($rows->currentpage()-1)*$rows->perpage()+1}} to {{$rows->currentpage()*$rows->perpage()}} of {{$rows->total()}} entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">
	                  	<p>
                           <div class="col-sm-12"> 
		                     <td class="col-md-1"> <button class="btn btn-danger">Delete Checked</button></td>
		                   </div> 
		                </p>
							<tr>
								<td>#</td>
								<td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
								<th>Subject Name</th>
                                {{-- <th>School Code</th> --}}
							</tr>


							@foreach($rows as $key=>$row)
							<tr>
								<td> {{ ($rows->currentpage()-1) * $rows->perpage() + $key + 1 }}</td>
								<td><input type="checkbox" name="categories7[]" class="checkboxes" value="{{ $row->SubjectSetupID }}" /></td>
                                <td>{{$row->SubjectName or 'DEFAULT'}}</td>
                                {{-- <td>{{$row->SchoolCode or 'DEFAULT'}}</td> --}}
                               

								<td><a class="btn btn-xs btn-success" href="{{ route('subject2.show',[$row->SubjectSetupID])  }}">Show
		                                                   {{-- <i class="glyphicon glyphicon-eye-open"> --}}</i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('subject2Controller@edit', array($row->SubjectSetupID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           <i class="glyphicon glyphicon-pencil"></i>
			                       </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'delete', 'route' => array('subject2.destroy',$row->SubjectSetupID))) }}  	                  
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
