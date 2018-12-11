<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Memo Processing System</title>

    <!-- Fonts -->
    <!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    -->

    <link href="{{ asset('layouttemplate/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('layouttemplate/css/lato-fonts-css.css') }}" rel='stylesheet' type='text/css'>


    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  -->
    <link href="{{ asset('layouttemplate/css/bootstrap_3.3.6_css_bootstrap.min.css') }}" rel="stylesheet">
    <!-- for calendar control styling  -->
    <link href="{{ asset('ppdu/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('ppdu/css/nnastyles.css') }}" rel="stylesheet">  <!-- styles for mailing list 2 lists -->

    <!--- new additions for the select boxes  vv-->    
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('ppdu/css/bootstrap.min.css') }}">  -->







    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                <a class="navbar-brand" href="{{ url('/') }}">
                    MPS
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/home') }}">
                    MPS
                </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->

                @if (Auth::guest())

                @else
                <ul class="nav navbar-nav">
                    <!--  <li><a href="{{ url('/') }}">Home</a></li>   -->
                
                    @if (Auth::user()->UserLevelID <=2 || (Auth::user()->UserLevelID >=19 && Auth::user()->UserLevelID <=42) )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Documents <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                                   {{-- <li><a href="{{ url('/documentcirculation') }}">Ciruclate Doc</a>
                                    </li>   --}}

                                    <!-- <li><a href="{{ url('/memo/') }}">Memos</a>
                                    </li>  -->
                                    @if (Auth::user()->UserLevelID !=2)  {{--  2 is records office, thus all ministries --}}                                    
                                    <li><a href="{{ url('/forwardingletter/ministry/create') }}">Forwarding Letter + Memo</a>
                                    </li>
                                    @endif

                                    @if (Auth::user()->UserLevelID ==2)  {{--  2 is records office --}}
                                    <li><a href="{{ url('/forwardingletter/create') }}">Forwarding Letter + Memo</a>
                                    </li>
                                    <li><a href="{{ url('/decisionletter/create') }}">Cab Decision Letter</a>
                                    </li>
                                    <li><a href="{{ url('/agenda/create') }}">Cabinet Agenda</a>
                                    </li>
                                    <li><a href="{{ url('/approvalmemo/create') }}">Exec Approval Memo</a>
                                    </li>
                                    <li><a href="{{ url('/approvaldecisionletter/create') }}">Exec Approval Letter</a>
                                    </li>
                                    <li><a href="{{ url('/committeereport/create') }}">Committe Report</a>
                                    </li>
                                    <li><a href="{{ url('/minutes/create') }}">Cabinet Minutes</a>
                                    </li>
                                    @endif
                            
                        </ul>
                    </li>
                    @endif


                    @if (Auth::user()->UserLevelID ==2)  {{-- 2 is records --}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Meetings <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                
                                    
                                    <li><a href="{{ url('/meeting/create') }}">Meeting Setup </a>
                                    </li>
                                    <li><a href="{{ url('/mailinglist') }}" title="Home" >Setup Meeting Participants</a></li>
                                                                    
                            </ul>
                        </li>



                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Dropdowns <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/contractor') }}">Contractors </a> 
                                    </li>
                                    <li><a href="{{ url('/decisionstatus') }}">Decision Status </a> 
                                    </li>
                                    <li><a href="{{ url('/district') }}">Districts </a> 
                                    </li>
                                    <li><a href="{{ url('/documenttype') }}">Document Types </a> 
                                    </li>
                                    <li><a href="{{ url('/fundingsource') }}">Funding Sources </a> 
                                    </li>
                                    <li><a href="{{ url('/meetingtype') }}">Meeting Types </a> 
                                    </li>
                                    <li><a href="{{ url('/ministry') }}">MDAs </a> 
                                    </li>
                                    <li><a href="{{ url('/priority') }}">Presidential Priorities </a> 
                                    </li>
                                    <li><a href="{{ url('/projectstatus') }}">Project Status </a> 
                                    </li>
                                    
                                    <li><a href="{{ url('/projecttype') }}">Project Types </a> 
                                    </li>
                                    <li><a href="{{ url('/recommendationstatus') }}">Recommendation Status </a> 
                                    </li>
                                   
                                    <li><a href="{{ url('/source') }}">Sources </a> 
                                    </li>

                            </ul>
                        </li>
                        @endif

                        
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                         Projects <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <!--
                                            <li><a href="{{ url('/') }}">By Region</a></li>
                                            <li><a href="{{ url('/') }}" title="Home" >By Ministry</a></li>
                                            <li><a href="{{ url('/') }}" title="Home" >By Department</a></li>
                                            <li><a href="{{ url('/') }}" title="Home" >By Agencies</a></li>
                                            <li><a href="{{ url('/') }}" title="Home" >By Project Status</a></li>
                                            <li class="divider"></li>  -->
                                            <li><a href="{{ url('/project') }}" title="Project" >Projects</a></li>
                                            
                                            <li><a href="{{ url('reports/statistics') }}">Statistics </a></li>
                                            <li><a href="{{ url('reports/projectdetails') }}" title="Home" >Project Detail</a></li>

                                            
                                            
                                    </ul>
                                </li>
                        

                        @if (!(Auth::user()->UserLevelID < 2 || (Auth::user()->UserLevelID >=19 && Auth::user()->UserLevelID <=42) ) )  {{-- is not ministry--}}
                        <li>
                                <a href="{{ url('/document/documentstatus') }}" title="Home" >Reports</a>
                        </li>
                        @endif
                                

                        @if (Auth::user()->UserLevelID == -2)   {{-- disabled for everyone now--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Administration <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/') }}">Update Account </a>
                                        </li>
                                        @if (Auth::user()->id ==2)
                                            <li><a href="{{ url('/') }}">Create User</a> 
                                            </li>
                                            
                                            <li><a href="{{ url('/') }}">Delete User </a>
                                            </li>
                                        @endif
                                                                        
                                </ul>
                            </li>
                        @endif

                @endif

                </ul>  <!--  left side of nav bar  -->



                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a> </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ asset('layouttemplate/js/jquery.min.js') }}"></script>
    <script src="{{ asset('layouttemplate/js/bootstrap.min.js') }}"></script>
    

    
    <!-- Calendar Control  -->
    <script src="{{ asset('ppdu/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('ppdu/js/scripts.js') }}"></script>
    



        


</body>
</html>
