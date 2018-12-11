@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
  
    {!!Form::open(array('method'=>'GET','route'=>'usermangement.search'))!!}
    {!!Form::label('quicksearch','Search Users:')!!}
    {!!Form::text('quicksearch')!!}
    {!!Form::submit('Search',array('class'=>'btn btn-primary'))!!}
    {!!Form::close()!!}

    <div class="col-md-10 col-md-offset-1">
    <h1>Users</h1>
    @if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
				<p>
				<a class="btn btn-primary" role="button" href="{{route('usermangement.create')}}">Add New User</a>
				
				<a class="btn btn-default" href="{{ route('usermangement.index') }}" role="button">Show All</a>
				</p>
				@if($rows->count())
				<div class="panel panel-primary">
				<div class="panel-heading">List Of Users</div>
				<div class="panel-body">

	                  <table class="table table-striped">
							<tr>

								<th>User</th>
								
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							@foreach($rows as $row)
							<tr>

								<td>{{$row->name or 'DEFAULT'}}</td>
								<td></td>
								<td><a class="btn btn-xs btn-success" href="{{ route('usermangement.show', $row->id)  }}">
		                                                   <i class="glyphicon glyphicon-eye-open"></i></a> </td>   
								<td>
		                        
			                        <a href="{{ action('usermangementController@edit', array($row->id)) }}"
			                            class="btn btn-info btn-xs">
			                            <i class="glyphicon glyphicon-pencil"></i>
			                        </a>

		                        </td>

			                    <td>
			                        
			            
			                      {{ Form::open(array('method' 
			                    		=> 'DELETE', 'route' => array('usermangement.destroy', $row->id))) }}  	                  
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
	           {!! $rows->links() !!}

            @else
				There are no records
		 
	       @endif
    </div>
    </div>
</div>
@endsection

				
