<!DOCTYPE html>
<html lang="en">
  <head>
    <!--=============================================== 
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
    ====================================================-->

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>BaTech : Home</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    
    <!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
    

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
    <link href="ppdu/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('ppdu/css___/style.css') }}" rel="stylesheet">

<!-- <link href="css/style.css" rel="stylesheet"> -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--   <style>
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
  -->
  </head>

<body id="app-layout">
<header id="header">
  <div class="menu_area">


  <!-- <div class="display_color"></div> -->
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  <div class="container">
            <div class="navbar-header">
  <!-- <div class="container-fluid"> -->
    <!-- <div class="navbar-header"> -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

       <div style="padding-right: 90px;">
                  <a class="navbar-brand" href="index.html">BaTech <span>Limited</span></a>
       </div>

     @if(Auth::guest())

@endif
    </div>

<div class="collapse navbar-collapse" id="myNavbar">

  @if (Auth::guest())

                @else
               
      <ul class="nav navbar-nav">
          <li><a href="{{url('/')}}">Home</a></li>
    
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
             @if(auth()->user()->UserLevelID == 3)
          <li><a href="{{url('/jobassignreport')}}">View Job Assignments</a></li>
          <li><a href="{{url('/expenses1')}}">View Expenses Payment</a></li>
          
          <li><a href="{{url('/salarypay')}}">View Remuneration</a></li>
           <li><a href="{{url('/incomereport')}}">View Income</a></li>
            <li><a href="{{url('/rentreport')}}">View Rentals</a></li>
            <li><a href="{{url('/expensessummary')}}">Expense Summary</a></li>
             <!-- <li><a href="{{url('/salarypaymentreport')}}">Salary Payment</a></li> -->
          <li><a href="{{url('/incomeexpenditure2')}}">Income And Expenditure</a></li>

         <!--  <li><a href="{{url('/Jeff')}}">Staff</a></li>
          <li><a href="{{url('/listjobrequest')}}">List Maintenance</a></li>
          <li><a href="{{url('/listmaintenance')}}">List Payments</a></li>
          <li><a href="{{url('Topics')}}"></a></li> -->
           @endif
           @if(auth()->user()->UserLevelID == 1)
           <li><a href="{{url('/incomereport')}}">View Income</a></li>
            <li><a href="{{url('/rentreport')}}">View Rentals</a></li>
           @endif

            @if(auth()->user()->UserLevelID == 2)
           <li><a href="{{url('/jobassignreport')}}">View Job Assignments</a></li>
            <li><a href="{{url('/expenses1')}}">View Expenses Payment</a></li>
           @endif

          </ul>
      </li>
     
        <!--   @if(auth()->user()->UserLevelID != 3)
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrationaaaa<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('/usermangement')}}">Create Staff</a>
              </li>

              <li><a href="{{url('/Assembly')}}">Create Client</a></li>
              <li><a href="{{url('/District')}}">Create Technitian</a></li>
              @if(auth()->user()->UserLevelID==4)
              <li><a href="{{url('/Area')}}">Create Maintenance Type</a></li>
             <li><a href="{{url('/membertype')}}">Create User</a></li>
              @endif
              
             
             
 @if(auth()->user()->UserLevelID == 2 )
    <li><a href="{{url('Finance')}}">Edit Finance Data</a></li>          
    @endif

 
            </ul>
          </li>
        @endif -->

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Maintenance<span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(auth()->user()->UserLevelID == 3 || auth()->user()->UserLevelID==2)
             <li><a href="{{url('/job')}}">Create New Job Request</a></li>
             <li><a href="{{url('/jobassign')}}">Create a Job Assignment</a></li>
             <li><a href="{{url('/Maintenance')}}">Job Completion Form</a></li>
              
             <li><a href="{{url('/attendancesreport')}}"></a></li>
            @endif
             
        <!--    <li class="divider"></li>
            @if(auth()->user()->UserLevelID != 3)
            <li><a href="{{url('/DistrictAssembly')}}">Zone Summary Per Indicator</a></li>
            <li><a href="{{url('/DistrictOverall')}}">Zone Report Per Period</a></li>
             @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
            <li><a href="{{url('/AreaSearch')}}">Area Summary Per Indicator</a></li>
            <li><a href="{{url('/AreaOverall')}}">Area Report Per Period</a></li>
            @endif
            @if(auth()->user()->UserLevelID == 4)
            <li><a href="{{url('/Nationals')}}">Organization Summary Per Indicator</a></li>
             <li><a href="{{url('/Nationaloverall')}}">Organization Report Per Period</a></li>
            @endif
            @endif -->
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rental<span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(auth()->user()->UserLevelID == 3)
             <li><a href="{{url('/FloorSpace')}}">Create Rental Unit</a></li>

            <li><a href="{{url('/rent')}}">Rent a Unit</a></li>
            @endif

            @if(auth()->user()->UserLevelID == 2)
             <li><a href="{{url('/FloorSpace')}}">Create Rental Unit</a></li>
            @endif

         <!--     @if(auth()->user()->UserLevelID != 3)

           <li><a href="{{url('/districtincome')}}">Zone Income & Expenditure Summary Report</a></li>
            @endif
             @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
            <li><a href="{{url('/areaincome')}}">Area Income & Expenditure Summary Report</a></li>
            @endif
            <li><a href="{{url('/assemblyincomedetailed')}}">Cell Income & Expenditure Detailed Report</a></li> -->
            

          </ul>
        </li>


        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaction<span class="caret"></span></a>
          <ul class="dropdown-menu">
               @if(auth()->user()->UserLevelID == 3)
             <!-- <li><a href="{{url('/tree')}}">Issue Invoice</a></li>-->

            <li><a href="{{url('/receivepayment')}}">Rent Payment</a></li> 

            <li><a href="{{url('/expenses')}}">Job Request Payment</a></li>
            <li><a href="{{url('/general')}}">General Expenses</a></li>
             <li><a href="{{url('/Salarypayment')}}">Remuneration Payment</a></li>
             @endif

              @if(auth()->user()->UserLevelID == 1)
               <li><a href="{{url('/receivepayment')}}">Rent Payment</a></li> 
              @endif
              @if(auth()->user()->UserLevelID == 2)
               <li><a href="{{url('/expenses')}}">Job Request Payment</a></li>
               <li><a href="{{url('/general')}}">General Expenses</a></li>
              @endif
          </ul>
        </li>
      

       
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrator<span class="caret"></span></a>
          <ul class="dropdown-menu">
           
            
            @if(auth()->user()->UserLevelID == 3)
              <li><a href="{{url('/Staff')}}">Create Staff</a></li>
             <li><a href="{{url('/Technician')}}">Create Technician</a></li>
             <li><a href="{{url('/jobcompletion')}}">Create Job Type</a></li>
             <!-- <li><a href="{{url('/Maintenance')}}">Create Maintenance Type</a></li> -->
             <li><a href="{{url('/Members')}}">Create Tenant</a></li>
             <li><a href="{{url('/Createusers')}}">Create User</a></li>
                   <!-- <li><a href="{{url('/job')}}">Create a Job</a></li>-->
              @endif

              @if(auth()->user()->UserLevelID == 1)
               <li><a href="{{url('/Building')}}">Create Property</a></li>
               <li><a href="{{url('/Members')}}">Create Tenant</a></li>
                <li><a href="{{url('/jobcompletion')}}">Create Job Type</a></li>
               @endif

               @if(auth()->user()->UserLevelID == 2)
             
               <li><a href="{{url('/Technician')}}">Create Technician</a></li>
                <li><a href="{{url('/jobcompletion')}}">Create Job Type</a></li>
               @endif
          </ul>
        </li>
     
 <!-- @if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4)
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
      @endif    -->
      @if(auth()->user()->UserLevelID != 3)
    <!--      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setup Meeting<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/Meeting')}}">Create Meeting</a></li>
            <li><a href="{{url('/Attendance')}}">Mark Attendance</a></li>
            <li><a href="{{url('/meetingattended')}}">Meeting Attendance Report</a></li>
            <li><a href="{{url('/meetingsummary')}}">Meeting Summary Report</a></li>
            <li><a href="{{url('/meetingpattern')}}">Meeting Pattern Report</a></li>
          </ul>
        </li> -->

      <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Uploads<span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="{{url('/upload')}}">Files</a></li>
           
          </ul>
        </li> -->
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


