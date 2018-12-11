
@extends('layouts.app')<br><br><br>
{{-- <div style="padding-right:90px;">
                  <marquee width="50%"><a style="color:#fff;" class="navbar-brand" href="index.html">BaTech <span>Limited</span></a></marquee>
                   
       </div> --}}
@section('content')<br><br><br><br><br><br><br><br>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
               {{--  <div class="panel-heading text-center"><marquee><h4>ONLINE SCHOOL REPORT SYSTEM</h4></marquee> --}}
                 <div class="panel-heading text-center"><h4>ONLINE SCHOOL REPORT SYSTEM</h4>
               </div>
                <div style="text-align: center; font-size: 60px; padding-top: 10px; padding-bottom: 10px;"><a style="text-decoration: #ffffff" href="{{url('/login')}}"  class="active_link"><span class=""></span><p class="blinking">CLICK HERE TO LOGIN</p></a></div>

                {{-- <div class="panel-body">
                    <img class="imghome" src="{{asset('uploads/p12.jpg')}}" alt="image">
                </div> --}}
            </div>
        </div>
     
    </div>
</div>
<script>
    function blinker(){
        $('.blinking').fadeOut(500);
        $('.blinking').fadeIn(500);
    }
    setInterval(blinker, 1000);
</script>

<style>
  .imghome{
    max-height: 100%;
    max-width: 100%;
    display: block;
    margin: auto;
    position: relative;
top: -15px;
   // margin: 0px;
   height: 100vh
  }
.panel-body{
    margin: 0px;
    padding: 0px;
    
}
.panel{
    margin: 0px;
    //border: none;
}
.panel-heading{
    margin: 0px;
}
h4{
    font-size: 28px
}
</style>
@endsection


