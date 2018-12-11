{{--        <legend>Terminal Score</legend>
  
<!-- Text input-->
<div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
 {!! Form::label('Year ', 'Academic Year:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Year',$Year, null, array('class' => 'form-control','id' => 'year',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Year'))
  <span class="help-block">
    <strong>{{ $errors->first('Year') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Term') ? ' has-error' : '' }}">
 {!! Form::label('Term', 'Term :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Term',$Term, null, array('class' => 'form-control', 'id'=>'term',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Term'))
  <span class="help-block">
    <strong>{{ $errors->first('Term') }}</strong>
  </span>
  @endif
</div>
</div>



<div class="form-group{{ $errors->has('Class') ? ' has-error' : '' }}">
 {!! Form::label('Class', 'Class :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Class',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'Class',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Class'))
  <span class="help-block">
    <strong>{{ $errors->first('Class') }}</strong>
  </span>
  @endif
</div>
</div>
<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
 {!! Form::label('subject', 'Subject :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('SubjectID',$Subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('subject'))
  <span class="help-block">
    <strong>{{ $errors->first('subject') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
 {!! Form::label('id', 'Student Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('id',$StudentName, null, array('class' => 'form-control', 'placeholder'=>'Select Student Name','id'=>'studentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('id'))
  <span class="help-block">
    <strong>{{ $errors->first('id') }}</strong>
  </span>
  @endif
</div>
</div>
<div class="form-group{{ $errors->has('classscore') ? ' has-error' : '' }}">
 {!! Form::label('classscore ', 'Class Score:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('classscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Class Score', 'id' => 'classscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('classscore'))
  <span class="help-block">
    <strong>{{ $errors->first('classscore') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('examscore') ? ' has-error' : '' }}">
 {!! Form::label('examscore', 'Exams Score :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('examscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Exams Score', 'id'=>'examscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('examscore'))
  <span class="help-block">
    <strong>{{ $errors->first('examscore') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
 {!! Form::label('position', 'Position :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('position',null, array('class' => 'form-control', 'placeholder'=>'Enter Position', 'id'=>'position',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('position'))
  <span class="help-block">
    <strong>{{ $errors->first('position') }}</strong>
  </span>
  @endif
</div>
</div>
<div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
 {!! Form::label('remarks', 'Remarks :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('remarks',null, array('class' => 'form-control', 'placeholder'=>'Enter Remaks', 'id'=>'remarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('remarks'))
  <span class="help-block">
    <strong>{{ $errors->first('number') }}</strong>
  </span>
  @endif
</div>
</div>


 --}}



        {{-- <legend>Terminal Score</legend>  --}}

         
       
       <legend style="text-align: center; margin-top: -10px; font-size: 50px; margin-bottom:8px;"> <strong>Terminal Score</strong></legend>
      

     {{--  <div>
            <strong style="padding-left: 370px; font-size: 50px; position: fixed;" class="blinking">Students</strong>
          </div><br><br><br><br> --}}

<!-- Text input-->

{{-- <div class="col-md-offset-4" style="margin-bottom: 15px">
  <img id="blah" alt="" height="200px" width="200px"/>
</div> --}}

<div class="col-md-4" style="margin-right: -910px;">
        <div style="margin-right: 100px;" class="form-group" >
         <img src="{{asset('uploads/p12.jpg')}}" alt="" class="img img-responsive studentimage" style="width: 100px; height: 100px;">
       </div>
       <div class="form-group text-center" style="width: 200px">
         {{--<input class="form-control  text-center" type="text" disabled="true" id="Studename" value="Kofi">  --}} 
          {{-- {!! Form::label('regid', ' Student Name' , array('class'=>'control-label text-center'  )) !!} --}}
          {!! Form::select('Class',[],null, array('class' => 'form-control', 'placeholder'=>'Student Name', 'id'=>'StudentName',( $rwstate=='true' ?  'readonly'  :null )  )) !!}
       </div>
      </div>
      <div style="font-size: 25px;"><strong><span style="padding-right: 10px; padding-left: 700px; ">{{$getTerm}}</span>{{$getYear}}</strong></div>
      <br><br><br><br><br><br>



 {{-- <div class="form-group{{ $errors->has('StudentName') ? ' has-error' : '' }}">
         {!! Form::label('StudentName', ' Student Name:' , array('class'=>'col-md-4 control-label'  )) !!}
         <div class="col-md-6">
            <select name="member" id="studentname" class="selectpicker form-control" data-live-search="true">
            @foreach($StudentName as $one)
             <option value="{{$one->id}}" image="{{$one->ImageType}}" regid="{{$one->StudentName}}">{{$one->StudentName}}</option>
            @endforeach
            </select>
              @if ($errors->has('StudentName'))
              <span class="help-block">
             <strong>{{ $errors->first('StudentName') }}</strong>
             </span>
               @endif
          </div>
       </div> --}}

 

{{-- <div class="form-group{{ $errors->has('Year') ? ' has-error' : '' }}">
 {!! Form::label('Year ', 'Year:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Year',$Year, null, array('class' => 'form-control','id' => 'year',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Year'))
  <span class="help-block">
    <strong>{{ $errors->first('Year') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('Term') ? ' has-error' : '' }}">
 {!! Form::label('Term', 'Term :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Term',$Term, null, array('class' => 'form-control','id'=>'term',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Term'))
  <span class="help-block">
    <strong>{{ $errors->first('Term') }}</strong>
  </span>
  @endif
</div>
</div>
<br><br> --}}
{{-- <legend></legend>  --}}


<div class="form-group{{ $errors->has('Class') ? ' has-error' : '' }}">
 {!! Form::label('Class', 'Class :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('Class',$Class,null, array('class' => 'form-control', 'placeholder'=>'Select Class', 'id'=>'Class',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('Class'))
  <span class="help-block">
    <strong>{{ $errors->first('Class') }}</strong>
  </span>
  @endif
</div>
</div>

      <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
 {!! Form::label('id ', 'Student Name:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('id',$StudentName, null, array('class' => 'form-control', 'placeholder'=>'Select Student Name', 'id' => 'studentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('id'))
  <span class="help-block">
    <strong>{{ $errors->first('id') }}</strong>
  </span>
  @endif
</div>
</div>
{{-- <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
 {!! Form::label('id', 'Student Name :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('id',$StudentName, null, array('class' => 'form-control', 'placeholder'=>'Select Student Name','id'=>'studentname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('id'))
  <span class="help-block">
    <strong>{{ $errors->first('id') }}</strong>
  </span>
  @endif
</div>
</div> --}}
<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
 {!! Form::label('subject', 'Subject :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::select('SubjectID',$Subject, null, array('class' => 'form-control', 'placeholder'=>'Select Subject','id'=>'subjectname',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('subject'))
  <span class="help-block">
    <strong>{{ $errors->first('subject') }}</strong>
  </span>
  @endif
</div>
</div>


<div class="form-group{{ $errors->has('classscore') ? ' has-error' : '' }}">
 {!! Form::label('classscore ', 'Class Score:' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('classscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Class Score', 'id' => 'classscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('classscore'))
  <span class="help-block">
    <strong>{{ $errors->first('classscore') }}</strong>
  </span>
  @endif
</div>
</div>

<div class="form-group{{ $errors->has('examscore') ? ' has-error' : '' }}">
 {!! Form::label('examscore', 'Exams Score :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::number('examscore',null, array('class' => 'form-control', 'placeholder'=>'Enter Exams Score', 'id'=>'examscore',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('examscore'))
  <span class="help-block">
    <strong>{{ $errors->first('examscore') }}</strong>
  </span>
  @endif
</div>
</div>


{{-- <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
 {!! Form::label('position', 'Position :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('position',null, array('class' => 'form-control', 'placeholder'=>'Enter Position', 'id'=>'position',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('position'))
  <span class="help-block">
    <strong>{{ $errors->first('position') }}</strong>
  </span>
  @endif
</div>
</div> --}}
{{-- <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
 {!! Form::label('remarks', 'Remarks :' , array('class'=>'col-md-4 control-label'  )) !!}
 <div class="col-md-6">
  {!! Form::text('remarks',null, array('class' => 'form-control', 'placeholder'=>'Enter Remaks', 'id'=>'remarks',
  ( $rwstate=='true' ?  'readonly'  :null )  )) !!}
  @if ($errors->has('remarks'))
  <span class="help-block">
    <strong>{{ $errors->first('number') }}</strong>
  </span>
  @endif
</div>
</div> --}}




