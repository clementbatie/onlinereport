

<?php $__env->startSection('content'); ?>

<div class="container spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-1">
     

      <div id="aaa" class="col-md-9">
      <?php /* <h1 style="text-align: center; text-decoration: #ffffff; font-size: 60px;"><p class="blinking">STUDENT REPORT SEARCH</p></h1> */ ?>

      <div style="padding-left: 200px; font-size: 40px; padding-top: "><a style="text-decoration: #ffffff"  class="active_link"><span class=""></span><strong class="blinking">STUDENT REPORT SEARCH</strong></a></div>
      </div><br>    



   </div>



       <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'studentreport.search')); ?>


    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control','id'=>'studentAD']); ?>

 
       <?php foreach($studentImage as $one): ?>
             <option value="<?php echo e($one->id); ?>" image="<?php echo e($one->ImageType); ?>" regid="<?php echo e($one->StudentName); ?>"><?php echo e($one->StudentName); ?></option>
            <?php endforeach; ?>
      
     </div>
       

   </div>
  
   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('See Report',array('class'=>'btn btn-info','id'=>'student')); ?>

    </div>
  </div>
   <div id="aaa" style="padding-left: 850px">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br>
  <?php echo Form::close(); ?>


</div>
      
      
     
 </div>



<?php /* <div class="col-md-3" style="margin-left: 60px; padding-left: 50px;"> */ ?>
<div class="col-md-19 col-sm-offset-1">

   
  <?php if(Session::has('message')): ?>
  <p style="font-size: 20px;" class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
   <?php echo e(Session::get('message')); ?>

 </p>
 <?php endif; ?>
<?php if(count($output)): ?>



 <div style="width: 1000px;" class="panel panel-default">
  <div class="panel-header"></div>
  <div class="panel-body">
    <div class="table-responsive">
     <table class="table table-striped" id="exporttable">

 <div class="col-md-12">


    
        
<div class="row">

      
       <div class="col-md-2" style="padding-top: 25px; ">
           <img style="margin-top: -7px; border-radius: 50%; margin-left: 20px;"  src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8">
            <h1 style="font-size: 43px; text-align: center"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
            <h3 style="font-size: 28px; text-align: center"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3><br>  
       </div>

    
      
       <div cclass="col-md-2" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$StuImage2); ?>" alt="" height="130px" width="130px">
       </div>
  </div>
     
 </div>
       <tr>
        <td colspan="7">  
          <span class="col-md-6"><strong>Name</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($selectedstudent->StudentName) ? $selectedstudent->StudentName : "---"); ?></span> </span>
          <span class="col-md-6"><strong>Year</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($yearget) ? $yearget : "---"); ?></span> </span>
        </td>
       </tr>
     
       
        <tr>
          <td colspan="7">
            <span class="col-md-4"><strong>Term</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($termsname) ? $termsname : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Class</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($StudentNameGet) ? $StudentNameGet : "---"); ?></span> </span>
            <?php /* <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->OnRoll) ? $classinfo->OnRoll : "---"); ?></span> </span> */ ?>
            

            <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($totalNo) ? $totalNo : "---"); ?></span> </span>
          </td>
        </tr>

        <tr>
          <td colspan="7">
            <span class="col-md-4"><strong>School Closes</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($schends) ? $schends : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Next term begins</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($schbegins) ? $schbegins : "---"); ?></span></span>
            <?php /* <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->a) ? $classinfo->a : "---"); ?></span> </span> */ ?>

            <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($OverallpositionInClass[0]->Position) ? $OverallpositionInClass[0]->Position : "---"); ?></span> </span>

            <?php /* <span class="col-md-4"><strong>Overall Total</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($OverallpositionInClass[0]->OverallTotal) ? $OverallpositionInClass[0]->OverallTotal : "---"); ?></span> </span> */ ?>
          </td>
        </tr>

       <tr style="background-color: rgb(192,192,192)" class="row-border">
         <th style="text-align: center;">Subject</th>
         <th style="text-align: center;">Class Score</th>
         <th style="text-align: center;">Exams Score</th>
         <th style="text-align: center;">Total</th>
         <th style="text-align: center;">Grade</th>
         <th style="text-align: center;">Position</th>
         <th style="text-align: center;">Remark</th>
        </tr>
         
      <?php foreach($output as $row): ?>
        <tr class="row-border">
          <td style="text-align: center;"><?php echo e($row->SubjectName); ?></td>
          <td style="text-align: center;"><?php echo e($row->classscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->examscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->classscore + $row->examscore); ?></td>
          <td style="text-align: center;"><?php echo e($row->Grade); ?></td>
          <td style="text-align: center;"><?php echo e($row->position); ?></td>
          <td style="text-align: center;"><?php echo e($row->remarks); ?></td>
        </tr>
      <?php endforeach; ?>
   
     </table>
     <span style="padding-left: 470px; font-weight: bold;" class="col-md-9"><strong>Overall Total :</strong><span style="margin-left: 10px; margin-right:10px; font-size: 25px;"> <?php echo e(isset($OverallpositionInClass[0]->OverallTotal) ? $OverallpositionInClass[0]->OverallTotal : "---"); ?></span> </span><br><br>
     <legend></legend>
   </div>
 </div>
 <div style="margin-left: 80px;" class="container">
   <div class="col-md-5"><strong>Promoted To / Repeated To :</strong>  <span><?php echo e(isset($studentperformance->PromotedTo) ? $studentperformance->PromotedTo : "---"); ?></span> </div>
   <div class="col-md-5"><strong>No of days opened for the term :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->AttendanceExpected) ? $studentperformance->AttendanceExpected : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Attendance</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ActualAttendance) ? $studentperformance->ActualAttendance : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Conduct</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->CharacterOfStu) ? $studentperformance->CharacterOfStu : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Interest</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->Interest) ? $studentperformance->Interest : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Class Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ClassTeacherRemarks) ? $studentperformance->ClassTeacherRemarks : "---"); ?></span> </div>
   <div class="col-md-5"><strong>Head Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->HeadTeacherRemarks) ? $studentperformance->HeadTeacherRemarks : "---"); ?></span> </div>
   
 </div><br><br>
 <legend style="padding-left: 400px;"><strong>School Grading System</strong></legend>
 <?php /* <strong>
   <div style="margin: 20px;" class="row">
    
    <div class="col-sm-3">
     <tr>  
        <th><span style="margin-right: 20px;">80 - 100</span>A</th><br>
        <th><span style="margin-right: 15px;">70 - 80</span>B</th><br>
        <th><span style="margin-right: 20px;">60 - 70</span>C</th><br>
        <th><span style="margin-right: 15px;">50 - 60</span>D</th><br>
        <th><span style="margin-right: 20px;">C</span> Average</th><br>
     </tr>
   </div>
   <div class="col-sm-4">
     <tr>  
        <th><span style="margin-right: 20px;">A</span> Excellent</th><br>
        <th><span style="margin-right: 15px;">B+</span> Very Good</th><br>
        <th><span style="margin-right: 20px;">B</span> Good</th><br>
        <th><span style="margin-right: 15px;">C+</span> Above Average</th><br>
        <th><span style="margin-right: 20px;">C</span> Average</th><br>
     </tr>
   </div>
   <div {{-- style="margin-left: 450px;" */ ?> <?php /* class="col-sm-3"> */ ?>
     <?php /* <tr>  
        <th style="margin: 80px;"><span style="margin-right: 20px;">A</span> Excellent</th><br>
        <th style="margin: 80px;"><span style="margin-right: 15px;">B+</span> Very Good</th><br>
        <th style="margin: 80px;"><span style="margin-right: 20px;">B</span> Good</th><br>
        <th style="margin: 80px;"><span style="margin-right: 15px;">C+</span> Above Average</th><br>
        <th style="margin: 80px;"><span style="margin-right: 20px;">C</span> Average</th><br>
     </tr>
   </div>
   <div class="col-sm-0">
      <tr>  
         <th style="margin: 70px;"><span style="margin-right: 15px;">D+</span> Pass</th><br>
        <th style="margin: 70px;"><span style="margin-right: 20px;">D</span> Satisfactory</th><br>
        <th style="margin: 70px;"><span style="margin-right: 20px;">E</span> Needs Improvement</th><br>
        <th style="margin: 70px;"><span style="margin-right: 20px;">F</span><span style="margin-right: 20px;"> Fail</th><br><br>
        
      </tr>
    </div>
</div> 
</strong>  */ ?>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
</head>
<body>

<?php /* <h2>Collapsed Borders</h2>
<p>If you want the borders to collapse into one border, add the CSS border-collapse property.</p>
 */ ?>
<table style="margin-left: 90px; width:80%; text-align: center;">
  <tr>
    <td colspan="8"><strong>Range</strong></td>
    <td><strong>Grade</strong></td> 
    <td><strong>Remarks</strong></td>
  </tr>
  <tr>
    <td colspan="8">100 - 80</td>
    <td>A</td>
    <td>Excellent</td>
  </tr>
  <tr>
    <td colspan="8">70 - 80</td>
    <td>B</td>
    <td>Very Good</td>
  </tr>
  <tr>
    <td colspan="8">60 - 70</td>
    <td>C</td>
    <td>Good</td>
  </tr>
  <tr>
    <td colspan="8">50 - 60</td>
    <td>D</td>
    <td>Pass</td>
  </tr>
  <tr>
    <td colspan="8">10 - 50</td>
    <td>F</td>
    <td>Fail</td>
  </tr>
</table><br><br>
  <?php /* <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
</div>
<?php else: ?> 
<div class="col-md-19" style="padding-left:20px;">
    <strong>There Are No Records To Show</strong> 
</div>
<?php endif; ?>

</div>
</div>
</div>
<div class="container" id="piechart"></div>
<script type="text/javascript">
// Load google charts



// Draw the chart and set the chart values

</script>
<script>
    function blinker(){
        $('.blinking').fadeOut(200);
        $('.blinking').fadeIn(200);
    }
    setInterval(blinker, 1000);
</script>
<style>
  .row-border td{
    border: 1px solid black;
  }
  .row-border th{
    border: 1px solid black;
  }
</style>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>