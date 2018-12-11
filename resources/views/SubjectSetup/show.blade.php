@extends('layouts.app')

@section('content')<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')

     {{  Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('classes.update', $rows->ClassID), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>


       <!-- include the partial    -->
       @include('SubjectSetup/_crude', array('rwstate' => 'true') )


            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           
           <a class="btn btn-info" href="{{ action('subject2Controller@edit', array($rows->SubjectSetupID)) }}" role="button">Edit</a>
           <a class="btn btn-danger" href="{{ url('/subject2') }}" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
