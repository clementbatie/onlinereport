<?php $__env->startSection('content'); ?>

<div class="container spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-1">
     

      <div id="aaa" class="col-md-9">
      <?php /* <h1 style="text-align: center; text-decoration: #ffffff; font-size: 60px;"><p class="blinking">STUDENT REPORT SEARCH</p></h1> */ ?>

      <div style="text-align: center; font-size: 40px; padding-left:100px; "><a style="text-decoration: #ffffff"  class="active_link"><span class=""></span><strong class="blinking">PREVIOUS REPORT SEARCH</strong></a></div>
      </div>    


    <div style="padding-left: 123px; margin-top: 4px; " id="aaa" class="col-md-3">
       <a style="margin-top: 40px; position: fixed;" href="#" id="export" class="btn btn-success"><i class="glyphicon glyphicon-new-window">Export to Excel</i></a>
       <?php /* <a href="#" id="graph" class="btn btn-success"><i class="fa fa-line-chart" onclick="chart()">Graph</i></a> */ ?>
     </div>
     <br><br><br><br>

   </div>

   <?php /* <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'Previous.search')); ?>


    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'studentPrevious', 'placeholder'=>'Select Student Name' ,'data-live-search'=>'true']); ?>

 
       <?php foreach($studentImage as $one): ?>
             <option value="<?php echo e($one->id); ?>" image="<?php echo e($one->ImageType); ?>" regid="<?php echo e($one->StudentName); ?>"><?php echo e($one->StudentName); ?></option>
            <?php endforeach; ?>
      
     </div>
       

   </div>
   <div class="form-group">
     <div class="col-md-2">
       <?php echo Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']); ?>

     </div>
   </div>
   <div class="form-group">
  <?php echo e(--    <div class="col-md-2">
       <?php echo Form::select('term',$terms, null, ['class' => 'form-control selectpicker']); ?>

     </div>
   </div>
     <div class="form-group">
       <div class="col-md-2">
         <select name="year" id="" class="selectpicker form-control" data-live-search="true">
           <?php foreach($year as $one): ?>
            <option value="{{$one); ?>"><?php echo e($one); ?></option>
           <?php endforeach; ?>
         </select>
       </div>
     </div> */ ?>
 <?php /*   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('Generate',array('class'=>'btn btn-info','id'=>'student')); ?>

    </div>
  </div>
   <div id="aaa" style="padding-left: 850px">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br>
  <?php echo Form::close(); ?>


</div> */ ?> 

 <div class="col-md-12">


    
        <?php /*  <div class="pull-left"> <img src="<?php echo e(asset('uploads/me.jpg')); ?>" alt="" height="200px" width="200px"></div>  */ ?>

         <?php /* <img width="560" height="315" src="uploads/p7.jpg"></img> */ ?>

         <?php /* <div class="pull-left"> <img src="uploads/<?php echo e($StuImage2); ?>" alt="" height="200px" width="200px"></div> 
 */ ?>


      <?php /*  <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8" style="padding-left: 85px;">
            <h1 style="font-size: 43px; text-align: center"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
            <h3 style="font-size: 24px; text-align: center"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3>   
       </div> */ ?>
      
      <?php /*  <div cclass="col-md-4" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$StuImage2); ?>" alt="" height="130px" width="130px">
       </div> */ ?>

       <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'Previous.search')); ?>


    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control','id'=>'studentPrevious']); ?>

 
       <?php foreach($studentImage as $one): ?>
             <option value="<?php echo e($one->id); ?>" image="<?php echo e($one->ImageType); ?>" regid="<?php echo e($one->StudentName); ?>"><?php echo e($one->StudentName); ?></option>
            <?php endforeach; ?>
      
     </div>
       

   </div>
   <?php /* <div class="form-group">
     <div class="col-md-2">
       <?php echo Form::select('class',$classes, null, ['class' => 'form-control', 'placeholder'=>'Select Class' ,'id'=> 'studentclass','disabled']); ?>

     </div>
   </div>
   <div class="form-group"> */ ?>
  <?php /*    <div class="col-md-2">
       <?php echo Form::select('term',$terms, null, ['class' => 'form-control selectpicker']); ?>

     </div>
   </div>
     <div class="form-group">
       <div class="col-md-2">
         <select name="year" id="" class="selectpicker form-control" data-live-search="true">
           <?php foreach($year as $one): ?>
            <option value="<?php echo e($one); ?>"><?php echo e($one); ?></option>
           <?php endforeach; ?>
         </select>
       </div>
     </div> */ ?>
   <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('See Report',array('class'=>'btn btn-info','id'=>'student')); ?>

    </div>
  </div>
   <?php /* <div id="aaa" style="padding-left: 850px">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br> */ ?>


      <div id="aaa" style="padding-left: 400px; font-size: 30px; text-decoration-color: red">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger fa fa-home">
          Return
        </a>
      </div><br>
  <?php echo Form::close(); ?>


</div>
     
 </div>

<div class="col-md-11" style="margin-left: 70px;"><br>


   
  <?php if(Session::has('message')): ?>
  <p style="font-size: 20px;" class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>">
   <?php echo e(Session::get('message')); ?>

 </p>
 <?php endif; ?>



<?php if(count($output)): ?>

 <div class="col-md-12">


    
        <?php /*  <div class="pull-left"> <img src="<?php echo e(asset('uploads/me.jpg')); ?>" alt="" height="200px" width="200px"></div>  */ ?>

         <?php /* <img width="560" height="315" src="uploads/p7.jpg"></img> */ ?>

         <?php /* <div class="pull-left"> <img src="uploads/<?php echo e($StuImage2); ?>" alt="" height="200px" width="200px"></div> 
 */ ?>


       <?php /* <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8" style="padding-left: 85px;">
            <h1 style="font-size: 43px; text-align: center"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
            <h3 style="font-size: 24px; text-align: center"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3>   
       </div>
      
       <div cclass="col-md-4" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$StuImage2); ?>" alt="" height="130px" width="130px">
       </div> */ ?>


       <div class="row">

       <?php /* <div class="col-md-1 col-sm-offset-1" style="padding-top: 25px; margin-left: 35px;"> */ ?>

       <div class="col-md-2" style="padding-top: 25px; ">
           <img style="margin-top: -7px; border-radius: 50%; margin-left: 20px;"  src="<?php echo e(asset('uploads/').'/'.$Images2); ?>" alt="" height="130px" width="130px">
       </div>


       <div class="col-md-8">
            <h1 style="font-size: 43px; text-align: center"><?php echo e(isset($schoolinfo->Name) ? $schoolinfo->Name : "---"); ?></h1>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->Address) ? $schoolinfo->Address : "---"); ?></p>
            <p style="font-size: 16px; text-align: center"><?php echo e(isset($schoolinfo->ContactNos) ? $schoolinfo->ContactNos : "---"); ?></p>
            <h3 style="font-size: 28px; text-align: center"><?php echo e(isset($schoolinfo->reportname) ? $schoolinfo->reportname : "---"); ?></h3>  
       </div>

    
      
       <div cclass="col-md-2" style="padding-top: 25px;">
           <img style="margin-top: -7px; border-radius: 50%"  src="<?php echo e(asset('uploads/').'/'.$StuImage2); ?>" alt="" height="130px" width="130px">
       </div>
  </div><br>

    <?php /*    <div class="col-md-10 col-md-offset-1">
    <?php echo Form::open(array('method'=>'GET','route'=>'Previous.search')); ?>


    <div class="form-group">
     <div class="col-md-3">
       <?php echo Form::select('student',$student, null, ['class' => 'form-control selectpicker','id'=>'studentPrevious', 'placeholder'=>'Select Student Name' ,'data-live-search'=>'true']); ?>

 
       <?php foreach($studentImage as $one): ?>
             <option value="<?php echo e($one->id); ?>" image="<?php echo e($one->ImageType); ?>" regid="<?php echo e($one->StudentName); ?>"><?php echo e($one->StudentName); ?></option>
            <?php endforeach; ?>
      
     </div>
       

   </div> */ ?>
   
   <?php /* <div class="form-group">
     <div class="col-md-2">
      <?php echo Form::submit('Get Report',array('class'=>'btn btn-info','id'=>'student')); ?>

    </div>
  </div> */ ?>
   <?php /* <div id="aaa" style="padding-left: 850px">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger btn-block">
          Return
        </a>
      </div><br> */ ?>


     <?php /*  <div id="aaa" style="padding-left: 400px; font-size: 30px; text-decoration-color: red">
     
        <a href="<?php echo e(url('/')); ?>"  class="btn btn-danger fa fa-home">
          Return
        </a>
      </div><br> */ ?>
  <?php /* <?php echo Form::close(); ?> */ ?>

<?php /* </div> */ ?>
     
 </div>



 <div class="panel panel-default">
  <?php /* <div class="panel-header"></div> */ ?>
  <?php /* <div class="panel-body"> */ ?>
   <?php /*  <div class="table-responsive"> */ ?>
    <table class="table table-striped" id="exporttable">

       <tr >
        <td colspan="8">  
          <span class="col-md-6"><strong>Student Name</strong>: <span style="margin-left: 10px; margin-right:10px; font-size: 25px;"><?php echo e(isset($selectedstudent->StudentName) ? $selectedstudent->StudentName : "---"); ?></span> </span>
          <span class="col-md-6"><strong>Year</strong>: <span style="margin-left: 10px; margin-right:10px;"><?php echo e(isset($classinfo->Year) ? $classinfo->Year : "---"); ?></span> </span>
        </td>
       </tr>
     
       <tr>
        <?php /* <tr>
          <td colspan="8">
            <span class="col-md-4"><strong>Term</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myterm->TermName) ? $classinfo->myterm->TermName : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Class</strong>: <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->myclass->ClassName) ? $classinfo->myclass->ClassName : "---"); ?></span> </span>
            <span class="col-md-4"><strong>No on Roll</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->OnRoll) ? $classinfo->OnRoll : "---"); ?></span> </span>
          </td>
        </tr> */ ?>
<?php /* 
        <tr>
          <td colspan="8">
            <span class="col-md-4"><strong>School Closes</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->SchoolCloses) ? $classinfo->SchoolCloses : "---"); ?></span> </span>
            <span class="col-md-4"><strong>Next term begins</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->NextTermBegins) ? $classinfo->NextTermBegins : "---"); ?></span></span>
            <span class="col-md-4"><strong>Position</strong> : <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($classinfo->a) ? $classinfo->a : "---"); ?></span> </span>
          </td>
        </tr> */ ?>

       <?php /* <tr style="background-color: rgb(192,192,192)" >
         <th style="text-align:">Subject</th>
         <th style="text-align:">Class Score</th>
         <th style="text-align:">Exams Score</th>
         <th style="text-align:">Total</th>
         <th style="text-align:">Position</th>
         <th style="text-align:">Remark</th>
         
        </tr> */ ?>
        <div class="panel panel-default">
        <table class="table table-striped" id="exporttable">
           <?php foreach($output as $i=>$collection): ?>
              <tr>
                <tr style="background-color: rgb(192,192,192)" >
                     <th style="text-align:center">Subject</th>
                     <th style="text-align:center">Class Score</th>
                     <th style="text-align:center">Exams Score</th>
                     <th style="text-align:center">Total</th>
                     <th style="text-align:center">Grade</th>
                     <th style="text-align:center">Remark</th>
                     <?php /* <th style="text-align:center">Term</th>
                     <th style="text-align:center">Class</th> */ ?>
                </tr>
            <tr>
                 <th colspan="20" style="padding-left: 350px; font-size: 20px"><?php echo e($arra3[$i]); ?>--<?php echo e($arra2[$i]); ?> Academic Year<br></th>
           </tr>

         <?php /*   <?php foreach($arra3 as $r=>$item): ?>
                 <?php for($is=0; $is<count($is); $is++): ?>

                 <th colspan="20"><?php echo e($arra3[$r]); ?></th>
           
                 <?php endfor; ?>
             <?php endforeach; ?> */ ?>
              </tr>

            <?php $header = null ?>
            <?php $header1 = null ?>
            <?php $header2 = null ?>

             <?php foreach($collection as $item): ?>
             <?php /*  <?php foreach($item as $r=>$item): ?>
                 <?php for($is=0; $is<count($is); $is++): ?>

                 <th colspan="20"><?php echo e($arra3[$is]); ?></th>
            
                 <?php endfor; ?>
             <?php endforeach; ?> */ ?>
      <?php if(count($termName) === 3): ?>
            <?php if($item->TermName === $termName[0]): ?>             
               <tr>
                <?php if($header != $item->TermName): ?>
                  <th><?php echo e($termName[0]); ?></th>
                  <?$header = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <?php /* <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
               <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>


            <?php if($item->TermName === $termName[1]): ?>             
             <tr>
                <?php if($header1 != $item->TermName): ?>
                  <th><?php echo e($termName[1]); ?></th>
                  <?$header1 = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
               <?php /* <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>

            <?php if($item->TermName === $termName[2]): ?>             
              <tr>
                <?php if($header2 != $item->TermName): ?>
                  <th><?php echo e($termName[2]); ?></th>
                  <?$header2 = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
             <?php /*   <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>
     <?php endif; ?>

     <?php if(count($termName) === 1): ?>
           <?php if($item->TermName === $termName[0]): ?>             
               <tr>
                <?php if($header != $item->TermName): ?>
                  <th><?php echo e($termName[0]); ?></th>
                  <?$header = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
               <?php /* <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>

     <?php endif; ?>
     <?php if(count($termName) === 2): ?>
           <?php if($item->TermName === $termName[0]): ?>             
               <tr>
                <?php if($header != $item->TermName): ?>
                  <th><?php echo e($termName[0]); ?></th>
                  <?$header = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
               <?php /* <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>

             <?php if($item->TermName === $termName[1]): ?>             
             <tr>
                <?php if($header1 != $item->TermName): ?>
                  <th><?php echo e($termName[1]); ?></th>
                  <?$header1 = $item->TermName;?>

                <?php endif; ?>
               </tr>
               <td style="text-align: center;"><?php echo e($item->SubjectName); ?></td>
               <td style="text-align: center;"><?php echo e($item->classscore); ?></td>
               <td style="text-align: center;"><?php echo e($item->examscore); ?></td>
               <td style="text-align: center;"><?php echo e(($item->examscore)+($item->classscore)); ?></td>
               <td style="text-align: center;"><?php echo e($item->Grade); ?></td>
               <td style="text-align: center;"><?php echo e($item->remarks); ?></td>
               <?php /* <th style="text-align: center;"><?php echo e($item->TermName); ?></th>
               <th style="text-align: center;"><?php echo e($item->ClassName); ?></th><tr> */ ?>
            <?php endif; ?>

     <?php endif; ?>
           <?php endforeach; ?> 
           <?php endforeach; ?>  

     </table>
   </div>
 </div>
 <?php /* <div class="container">
   <div class="col-md-6"><strong>Promoted To / Repeated To :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->PromotedTo) ? $studentperformance->PromotedTo : "---"); ?></span> </div>
   <div class="col-md-6"><strong>No of days opened for the term :</strong>  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->AttendanceExpected) ? $studentperformance->AttendanceExpected : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Attendance</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ActualAttendance) ? $studentperformance->ActualAttendance : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Conduct</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->CharacterOfStu) ? $studentperformance->CharacterOfStu : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Interest</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->Interest) ? $studentperformance->Interest : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Class Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->ClassTeacherRemarks) ? $studentperformance->ClassTeacherRemarks : "---"); ?></span> </div>
   <div class="col-md-6"><strong>Head Teacher's Remark</strong> :  <span style="margin-left: 10px; margin-right:10px"><?php echo e(isset($studentperformance->HeadTeacherRemarks) ? $studentperformance->HeadTeacherRemarks : "---"); ?></span> </div>
   
 </div> */ ?>
  <?php /* <?php echo $__env->make('trademark', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
</div>
<?php else: ?> 
There Are No Records
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