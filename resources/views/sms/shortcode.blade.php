@extends('layouts.app')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $rwstate = "false"; ?>
      @include('errors.messages')
      {!! Form::open(array('route' => 'Assembly.shortcodesave', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
      <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


        <!-- include the partial    -->
        <!-- form details -->


        <!-- Form Name -->
        <legend>Short Code</legend>

        <!-- Text input-->
        

        <div class="form-group{{ $errors->has('shortcode') ? ' has-error' : '' }}">
         {!! Form::label('shortcode', 'Shortcode:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::text('shortcode',$shortcode, array('class' => 'form-control', 'placeholder'=>'Enter shortcode', 
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('shortcode'))
          <span class="help-block">
            <strong>{{ $errors->first('shortcode') }}</strong>
          </span>
          @endif
        </div>
      </div>



      <!-- Button (Double) -->
      <div class="form-group">
       <label class="col-md-4 control-label" for="save"></label>
       <div class="col-md-8">
         <input type="submit" id="save"  class="btn btn-success">
         <input type="reset" id="reset"  class="btn btn-warning">
         <a class="btn btn-danger" href="{{ url('Assembly') }}" role="button">Cancel</a>
       </div>
       
     </div>

   </fieldset>

   {!! Form::close() !!}
   

 </div>
</div>
</div>
@endsection
