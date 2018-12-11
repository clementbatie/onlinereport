

@extends('layouts.app')

@section('content')
<br>
<div class="container" >
    <div class="row">
        <div style="margin-left: 180px;" class="col-md-8 col-md-offset-1">
            <div class="panel panel-primary">
               
              
                <div id="app-layout2" style="height: 600px; width: 748px;" >
                    {{-- <div class="col-md-1" style="height: 10px">
                       <div class="panel-body">
                            <img class="imghome" style="height: 500px; width: 700px; padding-right: 60px;" src="{{asset('uploads/img2.jpg')}}" alt="image">
                      </div>
                 </div> --}}

                {{-- <div class="col-md-10" style="padding-right: -90px"> --}}
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}<br><br><br><br>

                    <div style="background-color:#00663d; padding-top: 8px; padding-bottom: 10px; margin-right: 40px; margin-left: 40px;">
                      <div style=" color: #fff;font-size: 20px;font-weight: bold; margin-left: 280px; ">Account Login</div>
                    </div><br><br><br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-4">
                                <input type="email" class="form-control" placeholder="example@abc.com" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"></label>

                            <div class="col-md-4">
                                <input type="password" placeholder="password"  class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" >
                                <button type="submit" style="background-color:#00663d; margin-left: 40px;">
                               
                                    <div style="font-size: 20px; color: #fff; padding-right: 30px; padding-left: 30px; text-align: center;"><i class="fa fa-btn fa-sign-in"></i>Sign In</div>
                                
                                </button><br><br>

                                <a class="panel-heading text-center" href="{{ url('/password/reset') }}">Forgot Your Password?</a>  
                            </div>
                        </div>

                        {{-- <div class="panel-body">
                            <img class="imghome" src="{{asset('uploads/p7.jpg')}}" alt="image">
                       </div> --}}
                    </form>
                
            </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
