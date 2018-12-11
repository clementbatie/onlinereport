@extends('layouts.app')

@section('content')<br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">

        <p>
  {{-- <div style="padding-left: 20px" class="blinking"><h1></h1></div>
 --}}

  <div>
            <strong style="padding-left: 200px; font-size: 50px; position: fixed;" class="blinking">Promoting Of Students</strong>
          </div><br><br><br>
          <legend style="margin-bottom: 2px;"></legend>


 <div style="font-size: 18px;"><strong><span style="padding-right: 10px; padding-left: 800px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
          <br><br>
  
     <div class="col-md-11">

      
          {!! Form::open(array('method' => 'GET','route' => 'promotestudents.search')) !!}  
 

      
        <div class="form-group" style="margin-left: -20px">
       <div class="col-md-3">
          
     {!! Form::select('classname',$class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]) !!}

        </div>
        </div>

      

       <div class="form-group">
       <div class="col-md-4">
      
    {!!Form::submit('Search For Class',array('class'=>'btn btn-success'))!!}
    </div>
        </div>
    {!!Form::close()!!}

        <div id="aaa" class="col-md-2">
            <a href="{{url('/promotestudents')}}" class="btn btn-primary">Refresh Page</a>
        </div>
        <div id="aaa" class="col-md-2">
            <a href="#" id="export" class="btn btn-primary"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div><br><br>

        </div>
    </div></p>




<form action="{{ route('categories2.destroy') }}" method="post">
              {{ csrf_field() }}
              
   
    <div class="col-md-10 col-sm-offset-1">
    
    @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
              {{Session::get('message')}}
          </p>
      @endif

            
  

  
            <tr>
                
                  <div class="panel panel-primary">
                      <div style="background-color:#00663d; color:#fff; padding-top: 12px;padding-bottom: 12px;padding-left: 20px;"  class="panel-primary2">List of  Students In a Class</div>
                  <p>
                
 
                     
                    <div class="col-md-3" style="padding-top: 20px;">
                      {!! Form::select('classname2',$class, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Promote To Class ','data-live-search'=>'true' ]) !!}
                        </div>
                     

                     
                    <div class="col-md-3" style="padding-top: 20px;">
                       <td><button class="btn btn-success">Promote Students</button></td>
                     </div><br><br>
                   
                    
                     
                     </p>
 </tr>

                  <div class="panel-body">

                    <table class="table table-striped panel1"> 

         
           
                
              <tr>
                <td class="col-md-1" style="font-size: 10px;"><label><input type="checkbox" id="selectAll" name=""/> Select all</label></td>
                <th>Student Name</th>
                <th>Class Name</th>         
                <th>Parent Name</th>
                <th>Parent Number</th>
                <th>Year</th>
                <th>Term</th>
                <th></th>
              </tr>
      
 
              
              @foreach($output as $row)
              <tr>
                
              <td><input type="checkbox" name="categories[]" class="checkboxes" value="{{ $row->id }}" /></td>

                             <td>{{$row->StudentName or 'DEFAULT'}}</td>
                             <td>{{$row->ClassName or 'DEFAULT'}}</td>
                             <td>{{$row->ParentName or 'DEFAULT'}}</td>
                             <td>{{$row->ParentNumber or 'DEFAULT'}}</td>
                             <td>{{$row->Year or 'DEFAULT'}}</td>
                            <td>{{$row->TermName or 'DEFAULT'}}</td>
           

                          <td> 
                              
                  
                            {{ Form::open(array('method' 
                              => 'delete', 'route' => array('student.destroy',$row->id))) }}                      
                              {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick'=>'if(!confirm("Are you sure to delete this item?"))
                              {
                              return false;};'    ))  }}
                              {{ Form::close() }}   
                  
                          </td> 
                           
                    </tr>
                  @endforeach          
                
               </table>           
             </div>
       </div> 
     </form>
     </tr>
   </form>
 </div>
</div>
 
 <style type="text/css">
  #datepicker1::placeholder,#datepicker2::placeholder{
    font-weight: bold;
  }
 </style>
 <script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>
@endsection

        
