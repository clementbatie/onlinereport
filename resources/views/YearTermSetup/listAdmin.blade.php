@extends('layouts.app')

@section('content')<br>
<div class="container spark-screen">
    <div class="row">

		{{-- {!! Form::open(array('method' => 'GET','route' => 'yeartermsetup.search')) !!}  
		            {!! Form::label('searchString', 'Quick Search:') !!}
		            {!! Form::text('searchString') !!}
		     	
					{!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
		 
		{!! Form::close() !!} --}}
	
	
	

        <div class="col-md-10 col-md-offset-1">
	        
	         <div>
	       		<strong style="padding-left: 200px; font-size: 50px; position: fixed;" class="blinking">Academic Year and term</strong>
	       	</div><br><br><br>
	       	<legend style="margin-bottom: 2px;"></legend>
	       	<div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 760px; ">{{$getTerm}}</span>{{$getYear}}</strong></div><br><br>
	       	<br>
	        @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
					<!-- <a class="btn btn-primary" href="{{route('yeartermsetup.create')}}" >Add new data</a> -->
					{{-- <a class="btn btn-default" href="{{ route('yeartermsetup.index') }}" role="button">Show All</a> --}}
					<a style="background-color:#00663d; color:#fff;" class="btn btn-primary" href="{{ route('yeartermsetup.index') }}" role="button">Refresh</a>
					{{-- <a class="btn btn-info" href="{{ route('yeartermsetup.transfer') }}" role="button">Transfer to History</a>
					<!-- <a class="btn btn-info" href="{{ url('parents') }}" role="button">Transfer</a> --> --}}
					
				</p>
			

			@if (count($rows))


				
	            <div class="panel panel-primary">
	               {{--  <div class="panel-heading">List of  Year and Term</div> --}}
	                {{-- <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Year and Term</div> --}}

	                <div class="rows" style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">
                      <div class="col-md-9">
	                	<th>List of  Year and Term</th>
                      </div>
                      <div>
                     <th style="padding-left: 20px;">
                     	showing {{($rows->currentpage()-1)*$rows->perpage()+1}} to {{$rows->currentpage()*$rows->perpage()}} of {{$rows->total()}} entries
                     </th>
                 </div>
	                </div>

	                <div class="panel-body">

	                  <table class="table table-striped">
							<tr>
								<th>#</th>
								<th>Year</th>
								<th>Term</th>
								<th>Shool Name</th>					

							</tr>

							@foreach($rows as $key=>$row)
							<tr>
                             <td> {{ ($rows->currentpage()-1) * $rows->perpage() + $key + 1 }}</td>	
                             <td>{{$row->Year or 'DEFAULT'}}</td>
                             <td>{{$row->TermName or 'DEFAULT'}}</td>
                              <td>{{$row->Name or 'DEFAULT'}}</td>

								<td><a class="btn btn-xs btn-success" href="{{ route('yeartermsetup.show',[$row->Year_Term_SetipID])  }}">Show
		                                                   {{-- <i class="btn btn-xs btn-success"> --}}
		                                                   	
		                                                   </i></a> </td>   
								<td>
		                        
			                         <a href="{{ action('yeartermsetupController@edit', array($row->Year_Term_SetipID)) }}"
			                           class="btn btn-info btn-xs">Edit
			                           {{-- <i class="btn btn-info btn-xs"></i> --}}
			                       </a>

		                        </td>

			                   <!--  <td>
			                        
			            
 {{ Form::open(array('method'=> 'delete', 'route' => array('yeartermsetup.destroy',$row->Year_Term_SetipID))) }}  	                  
{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
			                        {
			                        return false;};'    ))  }}
			                        {{ Form::close() }}   
			            
			                    </td>  -->   
							</tr>
							@endforeach
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
