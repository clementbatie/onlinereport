 
  <legend style="padding-left: 200px; margin-top: -100px; font-size: 50px; margin-bottom: -16px;"> Student File Upload </legend>

<div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
 <br><br><br><br>
          
      

       <!-- Text input-->
        <div style="margin-left: 5px;" class="form-group{{ $errors->has('sample_file') ? ' has-error' : '' }}">
            <div style="margin-right: 100px; font-size: 30px;">
                        {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-4 control-label']) !!}
                          </div>
                        <div class="col-md-7">
                      {{--   {!! Form::file('sample_file', array('class' => 'form-control','id'=>'excelfile')) !!} --}}

                        {!! Form::file('sample_file', array('class' => 'inputForm' ,"style"=>"font-size:30px; padding-left:20px; width:400px;",'placeholder'=>'Enter Subject', 'id'=>'excelfile')) !!}
                       
                     @if ($errors->has('sample_file'))
                     <span class="help-block">
                     <strong>{{ $errors->first('sample_file') }}</strong>
                   </span>
                   @endif
               
                        
                    </div>
        </div><br><br><br>



