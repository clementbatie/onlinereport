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


    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <!-- for calendar control styling  -->
    <link href="{{ asset('ppdu/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('ppdu/css/nnastyles.css') }}" rel="stylesheet">  <!-- styles for mailing list 2 lists -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!--- new additions for the select boxes  vv-->    
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('ppdu/css/bootstrap.min.css') }}">  -->







    <style>
        body {
            font-family: 'Lato';
        }
.display_color{background-color:#0067a9; height:10px; width:100%;
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
      @yield('header')
</head>
<body id="app-layout">
<header id="head-wrap">
  <div class="display_color"></div>
   <nav class="navbar navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar">
        </span>
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

  @if (Auth::guest())

                @else

      <ul class="nav navbar-nav">
          <li><a href="{{url('/')}}">Home</a></li>
     @if(auth()->user()->UserLevelID == 3)
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Submit Report<span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="{{url('/submitstats')}}">Statistics</a></li>
          <li><a href="{{url('/submitfinance')}}">Finance</a></li>
          <li><a href="{{url('/submitstatsdata')}}">Statistical Data</a></li>
          <li><a href="{{url('Finance')}}">Edit Data</a></li>
          <li><a href="{{url('Topics')}}">Edit Topics Data</a></li>
          </ul>
      </li>
      @endif
          @if(auth()->user()->UserLevelID != 3)
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('/usermangement')}}">Create User</a>
              </li>

              <li><a href="{{url('/Assembly')}}">Create Cell Center</a></li>
              <li><a href="{{url('/District')}}">Create Zone</a></li>
              @if(auth()->user()->UserLevelID==4)
              <li><a href="{{url('/Area')}}">Create Area</a></li>
             <li><a href="{{url('/membertype')}}">Create Member Types</a></li>
              @endif
              <li><a href="{{url('/Indicator')}}">Create Indicator</a></li>
              
              @if(auth()->user()->UserLevelID==10)
              <li><a href="{{url('/National')}}">Create Organization</a></li>
              @endif
             
             
 @if(auth()->user()->UserLevelID == 2 )
    <li><a href="{{url('Finance')}}">Edit Finance Data</a></li>          
    @endif


            </ul>
          </li>
        @endif

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Statistics<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="{{url('/AssemblySearch')}}">Cell Summary Per Indicator</a></li>
            <li><a href="{{url('/cellattendance')}}">Cell Attendance Statistics</a></li>
            <li><a href="{{url('/cellattendance2')}}">Attendance Aggregate</a></li>
            <li><a href="{{url('/topicdiscussed')}}">Cell Event Summary</a></li>
            <li><a href="{{url('/allmembers')}}">Cell Members</a></li>
            @if(auth()->user()->UserLevelID != 3)
            <li><a href="{{url('/DistrictAssembly')}}">Zone Summary Per Indicator</a></li>
             @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
            <li><a href="{{url('/AreaSearch')}}">Area Summary Per Indicator</a></li>
            @endif
            @if(auth()->user()->UserLevelID == 4)
            <li><a href="{{url('/Nationals')}}">Organization Summary Per Indicator</a></li>
            @endif
            @endif
            <li class="divider"></li>
            <li><a href="{{url('/AssemblyDetailedSearch')}}">Cell Detailed Per Indicator</a></li>
            <li><a href="{{url('/cellattendancetotal')}}">Attendance Aggregate (Totals)</a></li>
            <li><a href="{{url('/celldetailedactivity')}}">Cell Detailed Activity</a></li>
            <li class="divider"></li>
            <li><a href="{{url('/AssemblyOverall')}}">Cell Report Per Period</a></li>
            <li><a href="{{url('/cellactivity')}}">Cell Activity Per Period</a></li>
             <li class="divider"></li>
            @if(auth()->user()->UserLevelID != 3)
            <li><a href="{{url('/DistrictOverall')}}">Zone Report Per Period</a></li>
            @endif
             @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
            <li><a href="{{url('/AreaOverall')}}">Area Report Per Period</a></li>
            @if(auth()->user()->UserLevelID == 4)
            <li><a href="{{url('/Nationaloverall')}}">National Report Per Period</a></li>
            @endif
            @endif
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Finance<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="{{url('/incomeexpenditure')}}">Income & Expenditure by Cell</a></li>

            <li><a href="{{url('/assemblyincome')}}">Cell Income & Expenditure Summary Report</a></li>
             @if(auth()->user()->UserLevelID != 3)
            <li><a href="{{url('/districtincome')}}">Zone Income & Expenditure Summary Report</a></li>
            @endif
             @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
            <li><a href="{{url('/areaincome')}}">Area Income & Expenditure Summary Report</a></li>
            @endif
            <li><a href="{{url('/assemblyincomedetailed')}}">Cell Income & Expenditure Detailed Report</a></li>
          </ul>
        </li>


        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cell Centers<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="{{url('/tree')}}">Cell Tree</a></li>
            <li><a href="{{url('/directory')}}">Cell Directory</a></li>
            <li><a href="{{url('/cellstatus')}}">Cell Status</a></li>
          </ul>
        </li>
      

      @if(auth()->user()->UserLevelID == 3)
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cell Membership<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="{{url('/Members')}}">Create Cell Members</a></li>
             <li><a href="{{url('/meetingtype')}}">Create Meeting Types</a></li>
             
             <li><a href="{{url('/cellmeetingmark')}}">Mark Cell Attendance</a></li>
             <li><a href="{{url('/attendancesreport')}}">Attendance Per Period</a></li>
          </ul>
        </li>
      @endif
 @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Leadership<span class="caret"></span></a>
          <ul class="dropdown-menu"> 
            <li><a href="{{url('/Titles')}}">Titles</a></li>
              <li><a href="{{url('/Leaders')}}">Leaders</a></li>
              <li><a href="{{url('/Positions')}}">Cell Position</a></li>
              <li><a href="{{url('/Zonepositions')}}">Zone Position</a></li>
              <li><a href="{{url('/Areapositions')}}">Area Position</a></li>
             <li><a href="{{url('/carrierhistory')}}">Carrier History</a></li>
            <li><a href="{{url('/listleaders')}}">My Leaders</a></li>
            <li><a href="{{url('/mycells')}}">Leadership Statistics</a></li>
          </ul>
        </li>
   @endif   
      @if(auth()->user()->UserLevelID != 3)
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setup Meeting<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/Meeting')}}">Create Meeting</a></li>
            <li><a href="{{url('/Attendance')}}">Mark Attendance</a></li>
            <li><a href="{{url('/meetingattended')}}">Meeting Attendance Report</a></li>
            <li><a href="{{url('/meetingsummary')}}">Meeting Summary Report</a></li>
            <li><a href="{{url('/meetingpattern')}}">Meeting Pattern Report</a></li>
          </ul>
        </li>

      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Uploads<span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="{{url('/upload')}}">Files</a></li>
           
          </ul>
        </li>
    @endif
      </ul>
    
    @endif
      <ul class="nav navbar-nav navbar-right">
       @if (Auth::guest()) 
        <li><a href="{{url('/login')}}"  class="active_link"><span class=""></span> Login</a></li>
    <br>


    @else
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->name }}<span class="caret"></span></a>
          <ul class="dropdown-menu">
        <li><a href="{{ url('/logout') }}"> <i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
 <li><a href="{{url('/resetpassword')}}">Password Reset</a></li>
@endif

          </ul>
        </li>
      </ul>
    </div>
</div>
</nav>
</header>
   @yield('content')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        
    
   
    <script src="{{ asset('ppdu/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('ppdu/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('js/jquery.table2excel.min.js') }}"></script>
    <script type="text/javascript">
      $("#export").click(function(){

        $("#exporttable").table2excel({

      // exclude CSS class

      exclude: ".noExl",

      name: "Worksheet Name",

      filename: "Report" //do not include extension

    });

      });
    </script>
    <style type="text/css" media="print">
    form, #aaa
    { display: none; }
    </style>
</body>
</html>


