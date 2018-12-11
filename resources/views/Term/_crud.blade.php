       
         <br>
       
       <legend style="text-align: center; font-size: 50px;margin-bottom: -16px;"> <strong>Create Term</strong></legend>
      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br>

       <!-- Text input-->
       <div class="form-group{{ $errors->has('TermName') ? ' has-error' : '' }}">
         {!! Form::label('TermName', 'Term Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            {!! Form::text('TermName', null, array('class' => 'inputForm' ,"style"=>"font-size:18px; padding-left:20px; width:400px;",'placeholder'=>'Enter Term', 'id'=>'termid',
             ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
              @if ($errors->has('TermName'))
          <span class="help-block">
          <strong>{{ $errors->first('TermName') }}</strong>
          </span>
          @endif
          </div>
       </div>


   