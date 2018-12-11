<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Church Central Report</title>

  <!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->


  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <!--- new additions for the select boxes  vv-->    
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('ppdu/css/bootstrap.min.css') }}">  -->

  <style>
  body {
    font-family: 'Lato';
  }

  .fa-btn {
    margin-right: 6px;
  }
  #head-wrap{

   -webkit-box-shadow: 3px 2px 4px rgba(0,0,0,.5);
   -moz-box-shadow: 3px 2px 4px rgba(0,0,0,.5);
   box-shadow: 3px 2px 4px rgba(0,0,0,.5);
   background:url(../img/bg-body.jpg);

 }
</style>
<link rel="stylesheet" href="{{asset('css/fractionreset.css')}}" type="text/css"   charset="utf-8" />
    <link rel="stylesheet" href="{{asset('css/fractionstyle.css')}}" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="{{asset('css/fractionslider.css')}}">
    
    <script src="{{asset('js/jquery-1.9.0.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('js/jquery.fractionslider.js')}}" type="text/javascript" charset="utf-8"></script>
    
    <script src="{{asset('js/main.js')}}" type="text/javascript" charset="utf-8"></script>
</head>
<body id="app-layout">
  <div class="display_color"></div>
  <header id="head-wrap">
   <nav class="navbar navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        @if(Auth::guest())
        <a class="navbar-brand" href="{{url('/')}}">
          <img src="{{asset('img/cop_client.png')}}" class="img_head"/>
        </a>
        @else
        <a class="navbar-brand" href="{{url('/')}}">
          <img src="{{asset('img/cop_client.png')}}" class="img_head"/>
        </a>
        @endif
      </div>

      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{url('/login')}}"  class="active_link"><span class=""></span> Login</a></li>
          <br>
        </ul>
      </div>
    </div>
  </nav>
</header>

<div class="header-blue">
  <div class="header-title">
   
  </div>
</div>

<div class="slider-wrapper">
      <div class="responisve-container">
        <div class="slider">
          <div class="fs_loader"></div>
          <div class="slide">
            <img  src="img/slider1.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
                
           
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">HOME CELLS PROMOTES THE MOST<br> EFFECTIVE METHOD OF EVANGELISM</p>
           </div>    
       <div class="slide">
            <img  src="img/slider2.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
           
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">PEOPLE ARE EMPOWERED IN SMALL GROUPS<br>TO DO MORE THAN THEY EVER THOUGHT THEY COULD</p>
        </div>      

        <div class="slide">
            <img  src="img/slider3.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
         
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">VAST NUMBER OF PEOPLE IN THE CONGREGATION<br>ARE DEVELOPED INTO LEADERS THROUGH <br> CELL GOUPS MINISTRY</p>
        </div>     

        <div class="slide">
            <img  src="img/slider1.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
                
          
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">INDIVIDUALS IN THE CELLS ARE IDENTIFIED.<br>(Who they are, what they need, what gifts they <br> possess) and acknowledged (what they  <br> accomplish for Christ and others).</p>
        </div>     
   
          <div class="slide">
          
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">PEOPLE ARE EMPOWERED IN SMALL GROUPS TO DO <br>MORE THAN THEY EVER THOUGHT THEY COULD</p>

            <img  src="img/slider3.png" width="500" height="354"      
                data-position="10,700" data-in="fade" data-delay="500" data-out="bottomRight">

        
            
          </div>
          <div class="slide">
         
            <img    src="img/slider1.png"  width="500" height="354"      
                data-position="10,700"
                data-position="138,-152" data-in="bottomRight" data-out="bottomRight">
          
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">THE GROUP IS EDIFIED THROUGH THE WORD, <br>FELLOWSHIP AND RELATIONSHIPS.<br>Each member is given an opportunity <br> for leadership development.</p>

            <img  src="img/02_main.png"  width="500" height="500"
                data-position="-50,650" data-in="fade" data-delay="500" data-out="bottomRight">
          </div>
        
                      
          <div class="slide">
           
            <img    src="img/slider2.png" width="500" height="354"      
                data-position="10,700"
               data-in="bottomRight" data-out="bottomRight">
          
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">MENTORING OCCURES, WITH A HEART-TO-HEART <br>TRANSMISSION OF INFORMATION AND VALUES.<br>Prov. 27:17 </p>

            <img  src="img/02_main.png"  width="500" height="500"
                data-position="-50,650" data-in="fade" data-delay="500" data-out="bottomRight">
          </div>
          
           <div class="slide">
            
            <img  src="img/slider3.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
          
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">SERVING AND MINISTRY GIFTS ARE EXERCISED.<br>(Eph. 4:12)</p>

            <img  src="img/02_main.png"  width="500" height="500"
                data-position="-50,650" data-in="fade" data-delay="500" data-out="bottomRight">
          </div>

          <div class="slide">
            <img  src="img/slider1.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
            <p    class="white"       
                data-position="150,40" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">CELL GROUPS PROVIDE A PLACE FOR NEW BELIEVERS<br>TO GROW IN CHRIST LIKENESS,LEARNING<br> TO POSSESS CHARACTER QUALITIES SUCH AS,<br> HUMILITY, SERVING, AND FORGIVENSS.</p>

            <img  src="img/02_main.png"  width="500" height="500"
                data-position="-50,650" data-in="fade" data-delay="500" data-out="bottomRight">
          </div>

          <div class="slide">
             <img  src="img/slider2.png"
                width="500" height="354"      
                data-position="10,700" data-in="right"  data-out="left">
          
            <p    class="white"       
                data-position="150,0" data-in="top" data-step="0" data-out="top" data-ease-in="easeOutBounce">CELL GROUPS PROVIDES ACCOUNTABILITY IN THE CHURCH.</p>

            <img  src="img/02_main.png"  width="500" height="500"
                data-position="-50,650" data-in="fade" data-delay="500" data-out="bottomRight">
          </div>
          
        </div>
      </div>
    </div>
    <div class="container" style="margin-top: 20px">
      <div class="col-md-4">
        <div class="row">
          <h4 style="margin-bottom: 10px"><b><u>Background</u></b></h4>

Leader's Companion is a resource center for managers and administrators of small groups
      <br><br>The site provides the tools required by the small group leader to effectively manage and monitor <br> the performance of the group over a period <br>of time.

        </div>
        
      </div>
      <div class="col-md-4">
         <h4><b><u>Jetro Pricinple for Leaders</u></b></h4>
          <ol style="list-style-type: circle; margin-top: 10px">
            <li>Effective leaders know their limitations. </li>
            <li>Effective leaders stand before God for the people</li>
            <li>Effective leaders teach. </li>
            <li>Effective leaders create teams. </li>
            <li>Effective leaders delegate. </li>
            <li>Effective leaders create a system of accountability. </li>
            <li>Effective leaders encourage and empower excellence. </li>
          </ol>
      </div>
      <div class="col-md-4">
        <div class="row">
          <h4 style="margin-bottom: 10px"><b><u>Scripture</u></b></h4>

          19 Listen now to me and I will give you some advice, and may God be with you. You must be the people’s representative before God and bring their disputes to him. 20 Teach them his decrees and instructions, and show them the way they are to live and how they are to behave. 21 But select capable men from all the people—men who fear God, trustworthy men who hate dishonest gain—and appoint them as officials over thousands, hundreds, fifties and tens. 22 Have them serve as judges for the people at all times, but have them bring every difficult case to you; the simple cases they can decide themselves. That will make your load lighter, because they will share it with you. 23 If you do this and God so commands, you will be able to stand the strain, and all these people will go home satisfied.” <strong>Exodus 18:19-23</strong>
        </div>
      </div>
    </div>
    <style>
      .white{
        color: white;
        background-color: transparent;

      }
      .sm{
        font-size: 12px;
      }
      .display_color{
        background-color: #0067a9;
height: 10px;
width: 100%;
      }
      .header-blue{
        margin-top: -20px;
        height: 40px;
        background-color: #333;;
      }
      .header-title{
        height: 100%;
        font-size: 27px;
        color:  white;
        font-family: serif;
        background: url('img/ab.png');
        background-repeat: no-repeat;
        background-position: right;
        z-index: 20
        margin-left:40px;
      }
      .header-title h1{
        font-style: italic;
        margin-left:40px;
      }
    </style>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>


