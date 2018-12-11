<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Terminal Report Online</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->


    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <!-- for calendar control styling  -->
    <link href="<?php echo e(asset('ppdu/css/jquery-ui.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('ppdu/css/nnastyles.css')); ?>" rel="stylesheet">  <!-- styles for mailing list 2 lists -->
    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
    <!--- new additions for the select boxes  vv-->    
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('ppdu/css/bootstrap.min.css')); ?>">  -->







    <!-- <style>
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
    </style> -->
      <?php echo $__env->yieldContent('header'); ?>
</head>
<body id="app-layout">
<header id="head-wrap">
  <div class="display_color"></div>
   
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  <div class="container">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar">
        </span>
      </button>

      <div style="padding-right:90px;">

                  <a style="color:#fff; margin-left: -70px;" class="navbar-brand" href="index.html">SentaCode Gh <span> Ltd</span></a>
                  <?php /* <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span> */ ?>
                   <?php /* <marquee><a style="color:#fff;" class="navbar-brand" href="index.html">BaTech <span>Limited</span></a></marquee> */ ?>
       </div>

     <?php if(Auth::guest()): ?>

     <?php endif; ?>


 <?php /* <?php if(Auth::guest()): ?> */ ?>
<?php /* <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
<img src="<?php echo e(asset('uploads/me.png')); ?>" class="img_head"/>
</a> */ ?>
<?php /* <?php else: ?>
<a class="navbar-brand" href="<?php echo e(url('/')); ?>">
<img style="margin-top: 0px; margin-right: 0px; border-radius: 50%" src="<?php echo e(asset('uploads/').'/'.(Auth::user()->ImageType)); ?>" alt="" height="30px" width="35px">
</a>
<?php endif; ?> */ ?>

    </div>

<div class="collapse navbar-collapse" id="myNavbar">

  <?php if(Auth::guest()): ?>

                <?php else: ?>

      <ul class="nav navbar-nav">
          <li><a href="<?php echo e(url('/')); ?>">Home</a></li>

           <?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1): ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setup<span class="caret"></span></a>
            <ul class="dropdown-menu">

             <li><a href="<?php echo e(url('/term')); ?>">Create Term</a>

             <li><a href="<?php echo e(url('/classes')); ?>">Create Class</a></li>

              <li><a href="<?php echo e(url('/teachersetup')); ?>">Create Teacher </a>

              <li><a href="<?php echo e(url('/subject2')); ?>">Create Subject</a></li>          

              <li><a href="<?php echo e(route('memberupload')); ?>">Upload Students</a></li>

              <li><a href="<?php echo e(url('/student')); ?>">Create Student</a>

                <li><a href="<?php echo e(url('/usermanagement2')); ?>">Create Users</a></li>

             <!--  <li><a href="<?php echo e(url('/submitreport')); ?>">Submit Report</a></li> -->
            </ul>
          </li>
        <?php endif; ?>

          <?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1): ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrator<span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href="<?php echo e(url('/yeartermsetup')); ?>">Setup Year & Term </a></li>
              <li><a href="<?php echo e(url('/teacher')); ?>">Assign Teacher, Class & Subject</a></li>
              <?php /* <li><a href="<?php echo e(url('/classinfo')); ?>">Setup Class Info</a> */ ?>

                
             <?php /*  <li><a href="<?php echo e(route('memberupload')); ?>">Upload Member</a></li> */ ?>
              
              
             <?php /*  <li><a href="<?php echo e(url('/parents')); ?>">Create Parent</a></li> */ ?>
             <?php /* <li><a href="<?php echo e(url('/classes')); ?>">Create Class</a></li> */ ?>

              <?php /* <li><a href="<?php echo e(url('/teachersetup')); ?>">Create Teacher </a> */ ?>
                 
              <?php /* <li><a href="<?php echo e(url('/term')); ?>">Create Term</a> */ ?>

             <?php /*  <li><a href="<?php echo e(url('/excelfileupload')); ?>">Excel</a> */ ?>

              <?php /* <li><a href="<?php echo e(url('/subject2')); ?>">Create Subject</a></li> */ ?>

               <?php if(auth()->user()->UserLevelID == 1): ?> 

                  <li><a href="<?php echo e(url('/promotestudents')); ?>">Promote Students</a>
              <?php endif; ?>

              <?php /* <li><a href="<?php echo e(url('/student')); ?>">Create Student</a> */ ?>

            <?php if(auth()->user()->UserLevelID == 4): ?>    

             <li><a href="<?php echo e(url('/Usermanagement3')); ?>">Create School User</a></li>
          
             <li><a href="<?php echo e(url('/schoolinfo')); ?>">Create School Information</a></li>
            <?php endif; ?>

             <!--  <li><a href="<?php echo e(url('/submitreport')); ?>">Submit Report</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
       
    <?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1): ?>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Exam Records<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a a href="<?php echo e(url('/terminalscore')); ?>">Enter Student Score</a></li>
              <li><a a href="<?php echo e(url('/overalposition')); ?>">Overal Position In Class</a></li>
              <?php /* <li><a a href="<?php echo e(url('/studentbehaviour')); ?>">Enter Student Behaviour</a></li> */ ?>
            </ul>
          </li>          
    <?php endif; ?>
    <?php if(auth()->user()->UserLevelID == 6): ?>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Exam Records<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a a href="<?php echo e(url('/terminalscore')); ?>">Enter Student Score</a>
              </li>
              
            </ul>
          </li>          
    <?php endif; ?>
    <?php if(auth()->user()->UserLevelID == 2): ?>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Exam Records<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a a href="<?php echo e(url('/terminalscore')); ?>">Enter Terminal Score</a></li>
              <li><a a href="<?php echo e(url('/overalposition')); ?>">Overal Position In Class</a></li>
            <?php /*   <li><a a href="<?php echo e(url('/studentbehaviour')); ?>">Enter Student Behaviour</a></li> */ ?>
              <?php /* <li><a a href="<?php echo e(url('/overalpositionDelete')); ?>">Enter Student Behaviour</a></li> */ ?>
            </ul>
          </li>          
    <?php endif; ?>
   
      
          <?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID == 2): ?>
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/studentreport')); ?>">Terminal Report</a></li>
             <li><a href="<?php echo e(url('/Previous')); ?>">Previous Terms Report</a></li>
        <?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1): ?>
            <li><a href="<?php echo e(url('/studentclass')); ?>">Students in a Class</a></li>
            <li><a href="<?php echo e(url('/teacherclass')); ?>">Teachers and Class</a></li>
            <li><a href="<?php echo e(url('/listsofclass')); ?>">Class & Total Students</a></li>
            <!--  <li><a href="<?php echo e(url('/template')); ?>">Template</a></li> -->
         <?php endif; ?>   
            <?php /* <li class="divider"></li> */ ?>
            
          </ul>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->UserLevelID == 3): ?>
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/studentreport')); ?>">Terminal Report</a></li>
            <li><a href="<?php echo e(url('/Previous')); ?>">Previous Terms Report</a></li>
          </ul>
        </li>
        <?php endif; ?>
<?php if(auth()->user()->UserLevelID == 4 || auth()->user()->UserLevelID == 1): ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/sms')); ?>">Send SMS to Parents/Teachers</a></li>
            <?php /* <li><a href="<?php echo e(url('/smspersonalised')); ?>">Send Personalised SMS to Members</a></li>
            <li><a href="<?php echo e(url('/smsbulk')); ?>">Send SMS to Absentees</a></li>
            <li><a href="<?php echo e(url('/smsbulkpersonalised')); ?>">Send Personalised SMS to Absentees</a></li>
            <?php if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4): ?>
            <li><a href="<?php echo e(url('/leadersms')); ?>">Send SMS to Leaders</a></li>
            <li><a href="<?php echo e(url('/leadersmspersonalised')); ?>">Send Personalised SMS to Leaders</a></li>
             <?php endif; ?>
            <li><a href="<?php echo e(url('/smsbalance')); ?>">SMS Credits Balance</a></li>
            <li><a href="<?php echo e(url('/shortcode')); ?>">SMS Shortcode</a></li>
            <li><a href="<?php echo e(url('/branchcode')); ?>">SMS Branchcode</a></li> */ ?>
       
          </ul>
        </li>
 <?php endif; ?>

<!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Setup<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/schoolinfo')); ?>">School Information</a></li>
            <li><a href="<?php echo e(url('/classes')); ?>">Class</a></li>
            <li><a href="<?php echo e(url('/studentreport')); ?>">Term</a></li>
            <li><a href="<?php echo e(url('/studentreport')); ?>">Subject</a></li>


            <!--  <li><a href="<?php echo e(url('/template')); ?>">Template</a></li> -->
            
 <!-- <li class="divider"></li>
            
          </ul>
        </li> --> 


      </ul>
    
    <?php endif; ?>
      <ul class="nav navbar-nav navbar-right">
       <?php if(Auth::guest()): ?> 
        <?php /* <li><a href="<?php echo e(url('/login')); ?>"  class="active_link"><span class=""></span> Login</a></li> */ ?>
             <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
              <li><a a href="<?php echo e(url('/terminalscore2')); ?>">About Us</a></li>
              <li><a a href="<?php echo e(url('/studentbehaviour2')); ?>">Contact Us</a></li>
          
        
    <br>


    <?php else: ?>
    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
<img style="margin-top: -7px; border-radius: 50%; margin-right: -27px;" src="<?php echo e(asset('uploads/').'/'.(Auth::user()->ImageType)); ?>" alt="" height="35px" width="40px">
</a>
        <li class="dropdown">
          <td > <button style="position: fixed;margin-left: 1100px; font-size:15px;cursor:pointer" onclick="openNav2()" class="btn btn-primary">&#9776;  Check Calender 2</button></td>

          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo e(Auth::user()->name); ?><span class="caret"></span></a>

          <ul class="dropdown-menu">
 
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Comments</a></li>
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Responds</a></li>
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Updates</a></li>
<li><a style="margin-bottom: 2px;"></a></li>
 <li><a href="<?php echo e(url('/logout')); ?>"> <i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Password Reset</a></li>
 <?php /* <a href="#">Services</a>
  <a href="#"></a>
  <a href="#"></a> */ ?>



<?php endif; ?>



          </ul>
        </li>
      </ul>
    </div>
</div>
</nav>

</header>

<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav2 {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav2 a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav2 a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.sidenav2 .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media  screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

@media  screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav2 a {font-size: 18px;}
}
</style>
</head>


<div id="mySidenav2" class="sidenav2"><br><br><br>
  <a style="padding-top: 70px" href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <a href="#">About 2</a>
  <a a href="<?php echo e(url('/studentreport')); ?>">Contact Us</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
   <?php /* <li class="dropdown">
        
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo e(Auth::user()->name); ?><span class="caret"></span></a>

          <ul class="dropdown-menu">
        <li><a href="<?php echo e(url('/logout')); ?>"> <i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Password Reset</a></li>




          </ul>
        </li> */ ?>
</div>

<div id="mySidenav" class="sidenav"><br><br><br>
  <a style="padding-top: 70px;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a a href="<?php echo e(url('/studentreport')); ?>">Contact Us</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>


<br><br><br>
<?php /* <span style="position: fixed; font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Check Calender</span> */ ?>
<td > <button style="position: fixed;margin-left: 45px; font-size:15px;cursor:pointer" onclick="openNav()" class="btn btn-primary">&#9776;  Check Calender</button></td>

<td > <button style="position: fixed;margin-left: 1200px; font-size:15px;cursor:pointer" onclick="openNav2()" class="btn btn-primary">&#9776;  Check Calender 2</button></td>
     
   <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
   
    <script src="<?php echo e(asset('ppdu/js/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('ppdu/js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('ppdu/js/scripts.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?php echo e(asset('js/jquery.table2excel.min.js')); ?>"></script>
    <script type="text/javascript">
      $("#export").click(function(){

        $("#exporttable").table2excel({

      // exclude CSS class

      exclude: ".noExl",

      name: "Worksheet Name",

      filename: "Report" //do not include extension

    });

      });

      function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

   function openNav2() {
    document.getElementById("mySidenav2").style.width = "250px";
}

function closeNav2() {
    document.getElementById("mySidenav2").style.width = "0";
}
    </script>
    <style type="text/css" media="print">
    form, #aaa
    { display: none; }
    </style>
</body>
</html>


