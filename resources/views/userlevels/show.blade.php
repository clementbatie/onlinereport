@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    @if ($errors->any())
    <ul>
        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
    </ul>
    @endif
    
     {{  Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('userlevel.update', $rows->UserLevelID), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>




       <!-- include the partial    -->
       @include('userlevels/_crud', array('rwstate' => 'true') )


            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           
           <a class="btn btn-info" href="{{ action('UserLevelController@edit', array($rows->UserLevelID)) }}" role="button">Edit</a>
           <a class="btn btn-danger" href="{{ url('/userlevel') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
