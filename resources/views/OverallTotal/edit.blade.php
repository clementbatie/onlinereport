@extends('layouts.app')

@section('content')<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    
     {{  Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('terminalscore.update', $rows->TerminanlScoreID), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>

       <!-- include the partial    -->
       @include('Terminalscore/_crud', array('rwstate' => 'false    ') )

         
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save" value="Update" class="btn btn-success">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('/terminalscore') }}" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
