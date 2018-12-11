@extends('layouts.app')

@section('content')<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">
<div id="aaa" class="col-md-6">
        {{-- <a href="{{url('/salarypay')}}"  class="btn btn-danger btn-block">
        Back
        </a> --}}
        </div>
        
        </div>

     <div class="col-md-11 col-md-offset-1">
      
          {!! Form::open(array('method' => 'GET','route' => 'teacherclass.search')) !!}  
              
    <div class="form-group">
       <div class="col-md-3">
          
     {!! Form::select('searchString1',$teacher, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Student Name','data-live-search'=>'true' ]) !!}

        </div>
        </div>

       <!--  <div class="form-group">
       <div class="col-md-3">
          
     {!! Form::select('searchString2',$classes, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Class','data-live-search'=>'true' ]) !!}

        </div>
        </div>
 -->
       <!-- <div class="form-group">
       <div class="col-md-4">
          
     {!! Form::select('searchString3',$school, null, ['class' => 'form-control selectpicker', 'placeholder'=>'Select Term','data-live-search'=>'true' ]) !!}

      </div>
      </div> -->
        
       <!--  <div class="form-group">
       <div class="col-md-3">
        <br> 
        {!!Form::text('FromDate',null,['class'=>'form-control','id'=>'datepicker1',
       'placeholder'=>'Date From'
        ] )!!}
        </div>
        </div>

         <div class="form-group">
       <div class="col-md-3">
        <br> 
        {!!Form::text('ToDate',null,['class'=>'form-control','id'=>'datepicker2',
       'placeholder'=>'Date To'
        ] )!!}
        </div>
        </div> -->
       <div class="form-group">
       <div class="col-md-3">
    
    {!!Form::submit('Generate',array('class'=>'btn btn-info'))!!}
    </div>
        </div>
    {!!Form::close()!!}


<div id="aaa" class="col-md-6">
         <a href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div>
        </div>
   
    <div class="col-md-10 col-sm-offset-1">
    
        
    <h1>Teacher and Class</h1>
    @if(Session::has('message'))
          <p style="font-size: 20px;" class="alert {{ Session::get('alert-class', 'alert-info') }}">
              {{Session::get('message')}}
          </p>
      @endif
      
        <div class="panel panel-default">
        <div class="panel-header"></div>
        <div class="panel-body">
<div class="table-responsive">
                    <table class="table table-striped" id="exporttable">
   <tr><td colspan="10" > Name: <span style="margin-left: 10px; margin-right:10px">{{$searchStr or ""}}</span>{{$teacherName or ""}}</td></tr>
    <tr><td colspan="10" class="">Report Period: <span style="margin-left: 10px; margin-right:10px"><u>{{$from  or "0"}}</u> </span>To <span style="margin-left: 10px; margin-right:10px"><u>{{$to or "0"}}</u></span></td></tr>
            
              <tr style="background-color: rgb(192,192,192);">
                              
              <th class="text-left">Teacher Name</th>
               <th class="text-left">Teacher's Number</th>
               <th class="text-left">Subject</th>
               <th class="text-left">Class Teaching</th>
                               
                                
              </tr>

               <?php $memarray = []; ?> 
              @foreach($array as $i=>$row)
             
              <tr>
    
                <td class="text-left">{{$row->TeacherSetupName}}</td>
                <td class="text-left">{{$row->PhoneNo}}</td>
                <td class="text-left">{{$row->SubjectName}}</td>
                <td class="text-left">{{$row->ClassName}}</td>
              
{{-- 
               @for($i; $i<count($array); $i++)

                   <td class="text-left">{{$array[$i]}}</td>
                   @break
                
               @endfor --}}

                <div id="{{""}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message Discussed: {{""}}</h4>
                      </div>
                      <div class="modal-body">
                        <u><h4>Comments</h4></u>
                        <p>{{""}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div><!-- end modal -->                 
              </tr>

              </tr>
               
      <!--         
              <tr style="font-weight: bolder;">
                <td></td>
                <td></td>
                   <td></td>
                   <td></td>
               <td></td>
               <td></td>
               <td></td> -->
               
           
                
              </tr>
                
              
              @endforeach
             
               


               <tr style="font-weight: bolder;">
                
                <!-- <td></td>
                <td></td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$con or "0"}}</td>
                <td class="text-right text-primary">{{$newconverts or "0"}}</td>
                <td class="text-right text-primary">{{$chil or "0"}}</td>
                <td class="text-right text-primary">{{$tot or "0"}}</td>
                <td class="text-right text-primary">{{$prev or "0"}}</td>
                <td class="text-right text-primary">{{$variance or "0"}}</td> -->
              </tr>            
            </table>
</div>
                  </div>
               <!-- -->
                     
                   {{-- @include('trademark') --}}
             </div>
      </div>
    </div>
</div>
 
 <style type="text/css">
  #datepicker1::placeholder,#datepicker2::placeholder{
    font-weight: bold;
  }
 </style>
@endsection

        
