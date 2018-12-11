@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    @include('errors.messages')
    {!! Form::open(array('route' => 'terminalscore.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>



         <div class="col-md-offset-4" style="margin-bottom: 15px">
    
    

   <img width="100" height="100" id="blah">
</div>

<!-- include the partial    -->
       @include('Terminalscore/_crud', array('rwstate' => 'false') )




       <!-- Button (Double) -->

       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="addterminalscore"  value="Add"  class="btn btn-primary">
          <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="save" value="Save" class="btn btn-success createterminalscore">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('terminalscore') }}" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
      <div class="panel panel-heading "><h4> Added Data</h4></div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Year</th>         
            <th>Term</th>
            <th>Class</th>
            <th>Student Name</th>
            <th>Subject</th>
            <th>Class score</th>         
            <th>Exams Score</th>
            <th>Position</th>
            <th>Remarks</th>
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