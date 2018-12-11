@extends('layouts.app')

@section('content')<br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    @include('errors.messages')
    {!! Form::open(array('route' => 'subject2.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>'true')) !!}
    <!-- <form class="form-horizontal" action="minute"  class="form-horizontal"> -->
       {{ csrf_field() }}

       <fieldset>


<!-- include the partial    -->
       @include('SubjectSetup/_crude', array('rwstate' => 'false') )




       <!-- Button (Double) -->

       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
         <input type="button" id="addsubject2"  value="Add"  class="btn btn-primary">
          <input type="button" value="Delete Row"  class="btn btn-info delete-row">
           <input type="submit" id="save" value="Submit"  class="btn btn-success createsubject2">
           <input type="reset" id="reset"  class="btn btn-warning">
           <a class="btn btn-danger" href="{{ url('subject2') }}" role="button">Return</a>
         </div>
         
       </div>

       </fieldset>

    {!! Form::close() !!}
 

    </div>
    </div>
</div>
<div class="container col-md-6 col-md-offset-3">
  <div class="panel panel-primary">
      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">Added Data</div>
    <div class="panel panel-body">   
    <table class="table table-responsive">  
      <tbody> 
        <thead> 
          <tr>  
            <th>#</th>
            <th>Class Name</th>         
            
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
