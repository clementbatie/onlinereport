@extends('layouts.app')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $rwstate = "true"; ?>
      @include('errors.messages')
      {!! Form::open(array('route' => 'smsbalance', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
      <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


        <!-- include the partial    -->
        <!-- form details -->


        <!-- Form Name -->
        <legend>SMS Credits Balance</legend>

        <!-- Text input-->
        

        <div class="form-group{{ $errors->has('smsbalance') ? ' has-error' : '' }}">
         {!! Form::label('smsbalance', 'SMS Balance:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::text('smsbalance',$balance, array('class' => 'form-control', 'placeholder'=>'Enter smsbalance', 
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('smsbalance'))
          <span class="help-block">
            <strong>{{ $errors->first('smsbalance') }}</strong>
          </span>
          @endif
        </div>
      </div>



      <!-- Button (Double) -->

   </fieldset>

   {!! Form::close() !!}
   

 </div>
</div>
</div>
@endsection
