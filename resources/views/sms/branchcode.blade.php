@extends('layouts.app')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php $rwstate = "true"; ?>
      @include('errors.messages')
      {!! Form::open(array('url' => '', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
      <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


        <!-- include the partial    -->
        <!-- form details -->


        <!-- Form Name -->
        <legend>Branch Code</legend>

        <!-- Text input-->
        <div class="form-group{{ $errors->has('branchcode') ? ' has-error' : '' }}">
         {!! Form::label('branchcode', 'branchcode:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
          {!! Form::text('branchcode',$branchcode, array('class' => 'form-control', 'placeholder'=>'Enter branchcode', 
          ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
          @if ($errors->has('branchcode'))
          <span class="help-block">
            <strong>{{ $errors->first('branchcode') }}</strong>
          </span>
          @endif
        </div>
      </div>

   </fieldset>

   {!! Form::close() !!}
   

 </div>
</div>
</div>
@endsection
