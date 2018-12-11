@extends('layouts.app')

@section('content')<br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
         <fieldset>
               <legend>Change Password</legend>

               
                   @include('errors.messages')
   {!! Html::ul($errors->all(), array('class'=>'errors'))!!}
{!! Form::open(array('method'=>'post','route' => 'usermangement.resetpassword','class'=>'form-horizontal','role'=>'form', 'files'=>'true')) !!}
@if(Session::has('message'))
			    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
			        {{Session::get('message')}}
			    </p>
			@endif
                        {!! csrf_field() !!}

                        

                        <div class="form-group{{ $errors->has('oldpasssword') ? ' has-error' : '' }}">
                            {!!Form::label('oldpasssword','Current Password:', array('class'=>'col-md-4 control-label'))!!}

                            <div class="col-md-6">
                                {!!	Form::password('oldpassword',array('class'=>'form-control'))!!}

                                @if ($errors->has('oldpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!!Form::label('password','Password:', array('class'=>'col-md-4 control-label'))!!}

                            <div class="col-md-6">
                                {!!	Form::password('password',array('class'=>'form-control'))!!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                             {!!Form::label('ppassword_confirmation','Confirm Password:', array('class'=>'col-md-4 control-label'))!!}

                            <div class="col-md-6">
                                {!!	Form::password('password_confirmation',array('class'=>'form-control'))!!}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            
       <div class="form-group">
         <label class="col-md-4 control-label" for="save"></label>
         <div class="col-md-8">
           <input type="submit" id="save"  class="btn btn-success" value="Submit">
           <input type="reset" id="reset"  class="btn btn-warning" >
           <a class="btn btn-danger" href="{{ url('/home') }}" role="button">Cancel</a>
         </div>
         
       </div>

       </fieldset>
                   {!!Form::open()!!}
                </div>
            </div>
        </div>
    
@endsection
