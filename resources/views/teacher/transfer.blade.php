@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    {!! Form::open(array('route' => 'Members.transferstore', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


<!-- include the partial    -->
    <legend>Transfer Member Records</legend>

<div class="form-group{{ $errors->has('members') ? ' has-error' : '' }}">
 {!! Form::label('members', 'Member Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('members',$members,null, array('class' => 'form-control selectpicker', 'placeholder'=>'Select Member ','data-live-search'=>'true', 'id' => 'members',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('members'))
  <span class="help-block">
    <strong>{{ $errors->first('members') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('assemblies') ? ' has-error' : '' }}">
 {!! Form::label('assemblies', 'Cell Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('assemblies',$assemblies,null, array('class' => 'form-control selectpicker','data-live-search'=>'true' ,'placeholder'=>'Select Cell Name', 'id' => 'assemblies',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('assemblies'))
  <span class="help-block">
    <strong>{{ $errors->first('assemblies') }}</strong>
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
           <a class="btn btn-danger" href="{{ url('Members') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>

  <script>
  var data = [];
</script>
@endsection
