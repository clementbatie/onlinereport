@extends('layouts.app')

@section('content')<br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

 		@include('errors.messages')
    {!! Form::open(array('route' => 'yeartermsetup.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


<!-- include the partial    -->
       @include('YearTermSetup/_crud', array('rwstate' => 'false') )

       <!-- Button (Double) -->
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="addyeartermsetup"  value="Add"  class="btn btn-primary">
           <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="save33" value="Save" class="btn btn-success createyeartermsetup">
            
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('yeartermsetup') }}" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
      {{-- <div class="panel panel-heading "><h4> </h4></div> --}}
      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">Added Data</div>

    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Year</th>
            <th>Term</th>
            <th>School Name</th>
          </tr>
        </thead>
               
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <script>
  var data = [];
</script>
@endsection
