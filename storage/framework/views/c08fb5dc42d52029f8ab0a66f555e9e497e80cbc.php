<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cell Meeting</title>

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
      <?php echo $__env->yieldContent('header'); ?>
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
     <?php if(Auth::guest()): ?>
<a class="navbar-brand" href="<?php echo e(url('/')); ?>">
<img src="<?php echo e(asset('img/cop_client.png')); ?>" class="img_head"/>
</a>
<?php else: ?>
<a class="navbar-brand" href="<?php echo e(url('/')); ?>">
<img src="<?php echo e(asset('img/cop_client.png')); ?>" class="img_head"/>
</a>
<?php endif; ?>
    </div>

<div class="collapse navbar-collapse" id="myNavbar">

  <?php if(Auth::guest()): ?>

                <?php else: ?>

      <ul class="nav navbar-nav">
          <li><a href="<?php echo e(url('/')); ?>">Home</a></li>

          <?php if(auth()->user()->UserLevelID == 4): ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration<span class="caret"></span></a>
            <ul class="dropdown-menu">

               <li><a href="<?php echo e(url('/yeartermsetup')); ?>">Year Term Setup</a></li>

              <li><a href="<?php echo e(url('/usermanagement2')); ?>">Create User</a></li>
              
              <li><a href="<?php echo e(url('/parents')); ?>">Create Parent</a></li>

              <li><a href="<?php echo e(url('/teacher')); ?>">Create Teacher</a></li>

              <li><a href="<?php echo e(url('/classinfo')); ?>">Create Class Info</a>

              <li><a href="<?php echo e(url('/term')); ?>">Create Term</a>

              <li><a href="<?php echo e(url('/subject')); ?>">Create Subject</a>

              <li><a href="<?php echo e(url('/student')); ?>">Create Student</a>

                 <li><a href="<?php echo e(url('/schoolinfo')); ?>">Create School Information</a></li>

             <!--  <li><a href="<?php echo e(url('/submitreport')); ?>">Submit Report</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
<?php if(auth()->user()->UserLevelID == 4 ): ?>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Exam Details<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a a href="<?php echo e(url('/terminalscore')); ?>">Enter Terminal Score</a>
              </li>
              <li><a a href="<?php echo e(url('/studentbehaviour')); ?>">Enter Student Behaviour</a></li>
            </ul>
          </li>          
    <?php endif; ?>
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/studentreport')); ?>">Terminal Report</a></li>
            <li><a href="<?php echo e(url('/studentclass')); ?>">Student in a Class</a></li>
            <!--  <li><a href="<?php echo e(url('/template')); ?>">Template</a></li> -->
            
            <li class="divider"></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo e(url('/sms')); ?>">Send SMS to Members</a></li>
            <li><a href="<?php echo e(url('/smspersonalised')); ?>">Send Personalised SMS to Members</a></li>
            <li><a href="<?php echo e(url('/smsbulk')); ?>">Send SMS to Absentees</a></li>
            <li><a href="<?php echo e(url('/smsbulkpersonalised')); ?>">Send Personalised SMS to Absentees</a></li>
            <?php if(auth()->user()->UserLevelID == 1 || auth()->user()->UserLevelID==4): ?>
            <li><a href="<?php echo e(url('/leadersms')); ?>">Send SMS to Leaders</a></li>
            <li><a href="<?php echo e(url('/leadersmspersonalised')); ?>">Send Personalised SMS to Leaders</a></li>
             <?php endif; ?>
            <li><a href="<?php echo e(url('/smsbalance')); ?>">SMS Credits Balance</a></li>
            <li><a href="<?php echo e(url('/shortcode')); ?>">SMS Shortcode</a></li>
            <li><a href="<?php echo e(url('/branchcode')); ?>">SMS Branchcode</a></li>
       
          </ul>
        </li>

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
        <li><a href="<?php echo e(url('/login')); ?>"  class="active_link"><span class=""></span> Login</a></li>
    <br>


    <?php else: ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo e(Auth::user()->name); ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
        <li><a href="<?php echo e(url('/logout')); ?>"> <i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
 <li><a href="<?php echo e(url('/resetpassword')); ?>">Password Reset</a></li>
<?php endif; ?>

          </ul>
        </li>
      </ul>
    </div>
</div>
</nav>
</header>
   <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
   
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
    </script>
    <style type="text/css" media="print">
    form, #aaa
    { display: none; }
    </style>
</body>
</html>


