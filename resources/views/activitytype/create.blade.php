@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    {!! Form::open(array('route' => 'activitytype.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


<!-- include the partial    -->
       @include('activitytype/_crud', array('rwstate' => 'false') )




       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save"  class="btn btn-success">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('activitytype') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
@endsection
