@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">   
    
     {{  Form::model($rows->toArray(), array('method' => 'PATCH', 'route' =>array('usermangement.update', $rows->id), 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true'  )) }}
    
         {{ csrf_field() }}

       <fieldset>




       <!-- include the partial    -->
       @include('usermanagement/_crud', array('rwstate' => 'false') )


       
            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save"  class="btn btn-success" value="Submit">
           <input type="reset" id="reset"  class="btn btn-warning" >
           <a class="btn btn-danger" href="{{ url('/usermangement') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
