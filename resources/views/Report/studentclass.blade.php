@extends('layouts.app')

@section('content')<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
  <div class="col-md-11 col-md-offset-1">
<div id="aaa" class="col-md-6">
       
        </div>
        
        </div>

     <div class="col-md-11 col-md-offset-1">
      
          {!! Form::open(array('method' => 'GET','route' => 'studentclass.search')) !!}  
              
    <div class="form-group">
       <div class="col-md-3">
          
     {!! Form::select('searchString1',$student, null, ['class' => 'form-control selectpicker','id'=> 'searchString1', 'placeholder'=>'Select Student Name','data-live-search'=>'true' ]) !!}

     {{-- {!! Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']) !!} --}}

        </div>
        </div>

        {{-- <div class="form-group">
       <div class="col-md-3"> --}}
          
     {{-- {!! Form::select('searchString2',$classes, null, ['class' => 'form-control selectpicker', 'id'=> 'searchString3','placeholder'=>'Select Class']) !!} --}}

     <div class="form-group">
     <div class="col-md-2">
       {!! Form::select('searchString2',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','data-live-search'=>'true']) !!}
     </div>
   </div>

       {{--  </div>
        </div> --}}

       <div class="form-group">
       <div class="col-md-3">
          
       {!! Form::select('searchString3',$school, null, ['class' => 'form-control', 'placeholder'=>'Select School','id'=> 'studentSchool','data-live-search'=>'true','disabled' ]) !!}

      </div>
      </div>
        
        {{-- <div class="form-group">
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
        </div> --}}
       <div class="form-group">
       <div class="col-md-2">
        
    {!!Form::submit('Generate',array('class'=>'btn btn-info'))!!}
    </div>
        </div>
    {!!Form::close()!!}

 {{-- <a href="{{url('/salarypay')}}"  class="btn btn-danger">
        Back
        </a> --}}

        <div id="aaa" class="col-md-2">
         <a href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
        </div>

        </div>
   
    <div class="col-md-10 col-sm-offset-1">
    
        
    <h1>Students In a Class</h1>
    @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
              {{Session::get('message')}}
          </p>
      @endif
      
        <div class="panel panel-default">
        <div class="panel-header"></div>
        @if (count($output))
        <div class="panel-body">
<div class="table-responsive">
                    <table class="table table-striped" id="exporttable">
   <tr><td colspan="10" > Name: <span style="margin-left: 10px; margin-right:10px">{{$name or ""}}</span>{{$indicate or ""}}</td></tr>
    {{-- <tr><td colspan="10" class="">Report Period: <span style="margin-left: 10px; margin-right:10px"><u>{{$from  or "0"}}</u> </span>To <span style="margin-left: 10px; margin-right:10px"><u>{{$to or "0"}}</u></span></td></tr> --}}
            
              <tr style="background-color: rgb(192,192,192);">
                <th>#</th>
                                 <th>Student Name</th>
              <th class="text-left">Class Name</th>
              <th class="text-left">Parent Name</th>
              <th class="text-left">Parent Number</th>
               
              {{--  <th class="text-left">School Code</th> --}}
                               
                                
              </tr>

               <?php $memarray = []; ?> 
              @foreach($output as $index => $row)
             
              <tr>
                <!--<td>{{$row->Job_Code}}</td>-->
                <td> {{ ($output->currentpage()-1) * $output->perpage() + $index + 1 }}</td>  
                <td class="text-left">{{$row->StudentName}}</td>
                <td class="text-left">{{$row->ClassName}}</td>
                <?php if(isset($mem)){
                  $mem += $row->assembly;
                }else{
                  $mem = $row->assembly;
                }
                ?> 
                
                <td class="text-left">{{$row->ParentName}}</td>
                <?php if(isset($newmembers)){
                  $newmembers += $row->newmembers;
                }else{
                  $newmembers = $row->newmembers;
                }
                ?> 

                <td class="text-left">{{$row->ParentNumber}}</td>
                <?php if(isset($newmembers)){
                  $newmembers += $row->newmembers;
                }else{
                  $newmembers = $row->newmembers;
                }
                ?> 

                {{-- <td class="text-left">{{$row->SchoolCode}}</td> --}}
                 <?php if(isset($vis)){
                  $vis += $row->visitors;
                }else{
                  $vis = $row->visitors;
                }
                ?> 
<!--  -->

                <!-- <td><a class="btn btn-xs btn-success" data-toggle="modal" data-target="#{{$index}}"> <i class="glyphicon glyphicon-eye-open"></i></a> </td> -->        <!-- Modal -->
                <div id="{{$index}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Message Discussed: {{$row->topic or ""}}</h4>
                      </div>
                      <div class="modal-body">
                        <u><h4>Comments</h4></u>
                        <p>{{$row->comments}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div><!-- end modal -->                 
              </tr>

              </tr>
               
              @endforeach
              <tr style="font-weight: bolder;">
                <td></td>
                <td></td>
                   <td></td>
                   <td></td>
               <td></td>
               <td></td>
               <td></td>
               
               <!-- <td style="font-size: 20px">Total : </td>

                <td style="font-size: 20px" class="text-left text-primary">{{array_sum($memarray)}}</td> -->
                
              </tr>

             <!--  <tr style="font-weight: bolder;">
                <td></td>
                <td></td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$mem or "0"}}</td>
                <td class="text-right text-primary">{{$con or "0"}}</td>
                <td class="text-right text-primary">{{$newconverts or "0"}}</td>
                <td class="text-right text-primary">{{$chil or "0"}}</td>
                <td class="text-right text-primary">{{$tot or "0"}}</td>
                <td class="text-right text-primary">{{$prev or "0"}}</td>
                <td class="text-right text-primary">{{$variance or "0"}}</td>
              </tr>    -->          
            </table>
</div>
                  </div>

                   <div style="margin-left: 600px;">
              @if ($output->lastPage() > 1)
                         <ul class="pagination">
                               <li class="{{ ($output->currentPage() == 1) ? ' disabled' : '' }}">
                                   <a href="{{ $output->url(1) }}">Previous</a>
                               </li>
                            @for ($i = 1; $i <= $output->lastPage(); $i++)
                             <li class="{{ ($output->currentPage() == $i) ? ' active' : '' }}">
                                   <a href="{{ $output->url($i) }}">{{ $i }}</a>
                             </li>
                           @endfor
                             <li class="{{ ($output->currentPage() == $output->lastPage()) ? ' disabled' : '' }}">
                                  <a href="{{ $output->url($output->currentPage()+1) }}" >Next</a>
                             </li>
                         </ul>
                      @endif
            </div>
@else
      {{--  <div style="font-size: 20px;"> There are no records </div> --}}
      @endif
                     
                   {{-- @include('trademark') --}}
             </div>
      </div>
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

        
