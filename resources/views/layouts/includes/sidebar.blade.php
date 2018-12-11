            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    @if (Auth::guest())

                    @else
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="{{ url('/') }}"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li class="active"><a href="{{ url('/inbox') }}" title="Home" >Recieve Document</a></li>
                        <li class="active"><a href="{{ url('/sent') }}" title="Home" >Send Document</a></li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Uploads<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               

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
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Setup Meeting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li><a href="{{ url('/meeting') }}">Create Meeting </a>
                                </li>
                                <li><a href="{{ url('/') }}" title="Home" >Setup Meeting Participants</a></li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Create Dropdowns<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/') }}">Presidential Priorities </a> 
                                </li>
                                <li><a href="{{ url('/') }}">Sources </a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Setup Projects<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li><a href="{{ url('/') }}">Create Projects </a> 
                                </li>
                                <li><a href="{{ url('/') }}">Update Projects </a>
                                </li>
                                <li><a href="{{ url('/') }}">Delete Projects </a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        
                        <li>
                            <a href="{{ url('/') }}" title="Home" >Reports</a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}" title="Home" >Statistics</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Administration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li><a href="{{ url('/') }}">Create User</a> 
                                </li>
                                <li><a href="{{ url('/') }}">Update User </a>
                                </li>
                                <li><a href="{{ url('/') }}">Delete User </a>
                                </li>

 




                                <li>
                                    <a href="{{ URL::to('subdistricts')}}">Sub-districts</a>
                                </li>
                                <li>
                                    <a href="#">Health promotion methods</a>
                                </li>
                                <li>
                                    <a href="#">Resource Categories</a>
                                </li><li>
                                    <a href="#">Vaccine Types n Schedules</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Security<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ URL::to('Users') }}">Users</a>
                                </li>
                                

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            
                             <a href="{{ URL::to('logout')}}">Logout</a>
                        </li>


                    </ul>

                    @endif
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->