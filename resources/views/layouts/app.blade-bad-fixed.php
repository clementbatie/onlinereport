<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Memo Processing System and Dashboard</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="{{ url('ppdu/css/bootstrap.min.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <![endif]-->
          <link href="{{ url('ppdu/css/styles.css') }}" rel="stylesheet">
          <!-- date picker - untested -->
          <link href="{{ url('datepicker/css/datepicker.css') }}" rel="stylesheet">
          <link href="{{ url('datepicker/less/datepicker.less') }}" rel="stylesheet">

          <!--  cc -->


          <!-- c -->
      </head>
      <body>
        <!-- header -->
        <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
                            <ul id="g-account-menu" class="dropdown-menu" role="menu">
                                <li><a href="#">My Profile</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <!-- /container -->
        </div>
        <!-- /Header -->

        <!-- Main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <!-- Left column -->
                    <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a>

                    <!-- ***************************individual menus -first group -->
                    <hr>
                    <ul class="nav nav-stacked">
                        <li class="active"><a href="{{ url('/') }}" title="Home" >Home</a></li>
                        <li class="active"><a href="{{ url('/inbox') }}" title="Home" >Recieve Document</a></li>
                        <li class="active"><a href="{{ url('/sent') }}" title="Home" >Send Document</a></li>
                        {{--
                        <li><a href="statistics.html" title="Statistics" >Statistics</a></li>
                        <li><a href="detailprojects.html">Detail Projects</a></li>
                        --}}    
                    </ul>


                    <!-- ***************************individual menus -second group -->
                    <hr>
                    <ul class="nav nav-stacked">

                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"> Uploads <i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu2">
                                <li><a href="{{ url('/memo') }}">Memo </a>
                                </li>
                                <li><a href="{{ url('/forwardingletter') }}">Forwarding Letter</a>
                                </li>
                                <li><a href="{{ url('/decisionletter') }}">Cab Decision Letter</a>
                                </li>
                                <li><a href="{{ url('/agenda') }}">Cabinet Agenda</a>
                                </li>
                                <li><a href="{{ url('/approvalmemo') }}">Exec Approval Memo</a>
                                </li>
                                <li><a href="{{ url('/approvaldecisionletter') }}">Exec Approval Letter</a>
                                </li>
                                <li><a href="{{ url('/committeereport') }}">Committe Report</a>
                                </li>
                                <li><a href="{{ url('/minutes') }}">Cabinet Minutes</a>
                                </li>
                            </ul>
                        </li>


                    </ul>


                    <!---  another group ---->

                    <ul class="nav nav-stacked">

                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu3"> Set up Meeting <i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu3">
                                <li><a href="{{ url('/meeting') }}">Create Meeting </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-stacked">
                        <li class="active"><a href="{{ url('/') }}" title="Home" >Setup Meeting Participants</a></li>
                    </ul>

                    <!---  another group ---->

                    <ul class="nav nav-stacked">

                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu4">Create Dropdowns<i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu4">
                                <li><a href="{{ url('/') }}">Presidential Priorities </a> 
                                </li>
                                <li><a href="{{ url('/') }}">Sources </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-stacked">

                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5">Setup Projects<i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu5">
                                <li><a href="{{ url('/') }}">Create Projects </a> 
                                </li>
                                <li><a href="{{ url('/') }}">Update Projects </a>
                                </li>
                                <li><a href="{{ url('/') }}">Delete Projects </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-stacked">
                        <li class="active"><a href="{{ url('/') }}" title="Home" >Reports</a></li>
                    </ul>

                    <ul class="nav nav-stacked">
                        <li class="active"><a href="{{ url('/') }}" title="Home" >Statistics</a></li>
                    </ul>

                    <ul class="nav nav-stacked">

                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu6">Administration<i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu6">
                                <li><a href="{{ url('/') }}">Create User</a> 
                                </li>
                                <li><a href="{{ url('/') }}">Update User </a>
                                </li>
                                <li><a href="{{ url('/') }}">Delete User </a>
                                </li>
                            </ul>
                        </li>
                    </ul>            


                    {{--
                    <ul class="nav nav-stacked">
                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">Settings <i class="glyphicon glyphicon-chevron-right"></i></a>
                            <ul class="nav nav-stacked collapse" id="userMenu">

                                <li><a href="#"> Districts</a></li>
                                <li><a href="#"> Ministries</a></li>
                                <li><a href="#"> Project Type</a></li>
                                <li><a href="#"> Status Types</a></li>

                            </ul>
                        </li>
                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"> Reports <i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu2">
                                <li><a href="#">Regions &amp Districts </a>
                                </li>
                                <li><a href="#">Ministries &amp Districts</a>
                                </li>
                                <li><a href="#"> Departments</a>
                                </li>
                                <li><a href="#">Agencies</a>
                                </li>
                                <li><a href="#">Project Status</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    --}}

                </div>
                <!-- /col-2 -->
                <!-- ***************************individual menus -third group -->

                <div class="col-sm-10">

                    <!-- column 2 -->

                    <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> The Memo Processing System</strong></a>


                    <!-- *************************** -main body group -->

                    <hr>


                    <div class="row">
                        <!-- center left-->
                        <div class="col-md-6">


                            <!-- *************************** your forms will appear here when you extend **************  -->
                            <div>

                              @yield('content')
                          </div>

                      </div>

                      <!--/row-->
                      <div class="row">
                        <div class="col-md-12">
                           <!-- put stuff here accross bottom  -->
                       </div>
                   </div>
               </div>
               <!--/col-span-10-->
           </div>
       </div>
       </div>
       <!-- /Main -->

       <footer class="text-center">Memo Processing System</footer>



       <!-- script references -->
       <!--script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script -->
       <script src="{{ url('ppdu/js/jquery-1.11.3.min.js') }}"></script>
       <script src="{{ url('ppdu/js/bootstrap.min.js') }}"></script>
       <script src="{{ url('ppdu/js/scripts.js') }}"></script>
       <!-- date picker - untested -->
       <script src="{{ url('datepicker/js/bootstrap-datepicker.js') }}"></script>

   </body>
   </html>