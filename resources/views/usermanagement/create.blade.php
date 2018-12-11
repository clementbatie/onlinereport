@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
    {!! Form::open(array('route' => 'usermangement.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
         {!! csrf_field() !!}

       <fieldset>


<!-- include the partial    -->
    @include('usermanagement/_crud4create', array('rwstate' => 'false') )



       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-6">
         <div class="text-center">
           <input type="submit" id="save"  class="btn btn-success" value="Submit">
           <input type="reset" id="reset"  class="btn btn-warning" value="reset">
           <a class="btn btn-danger" href="{{ url('/usermangement') }}" role="button">Cancel</a>
         </div>
         </div>
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
