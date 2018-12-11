<?php
//Route::auth();

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 /*  //valid:
Route::get('/', function () {
    return view('welcome');   //************temporary measure.//general landing page.
   
});

*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

  //taken out to stop the not found errors 3rd feb


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'MyhomeController@index');//HomeController@index
    Route::get('/home', 'HomeController@mailbox');//HomeController@index

	 Route::resource('terminalscore2','terminalscoreController@testing');
	
	/***************************************NEW ADDED ROUTE***************************/
		Route::get('/resetpassword','usermangementController@changepassword');
		Route::post('usermangement/resetpassword',['as'=>'usermangement.resetpassword',
		'uses'=>'usermangementController@passwordchangeprocess']);
	    Route::get('usermangement/search',['as'=>'usermangement.search','uses'=>'usermangementController@search']);
		Route::resource('usermangement','usermangementController');

      
      
	/***************************************NEW ENDS HERE***************************/
	    Route::group(['middleware' => 'auth'], function() {
		Route::get('studentreport', 'ReportController@studentreport');
		Route::post('studentreport', 'ReportController@studentreport');
		Route::get('studentreport/search', ['as' => 'studentreport.search', 'uses' => 'ReportController@studentreportsearch']);

		
		Route::get('Previous', 'ReportController@Previous');
		Route::post('Previous', 'ReportController@Previous');
		Route::get('Previous/search', ['as' => 'Previous.search', 'uses' => 'ReportController@PreviousSearch']);
        
        Route::get('studentclass', 'ReportController@studentclass');
		Route::get('studentclass/search', ['as' => 'studentclass.search', 'uses' => 'ReportController@studentclassSearch']);

		Route::post('getstudentclassess', ['as' => 'studentreport.getstudentclassess', 'uses' => 'ClassesController@getstudentclassess']);
		Route::post('studentreport/getstudentclassess', ['as' => 'studentreport.getstudentclassess', 'uses' => 'ClassesController@getstudentclassess']);

		Route::post('getstudentclassessPrevious', ['as' => 'studentreport.getstudentclassessPrevious', 'uses' => 'ClassesController@getstudentclassessPrevious']);
		Route::post('Previous/getstudentclassessPrevious', ['as' => 'studentreport.getstudentclassessPrevious', 'uses' => 'ClassesController@getstudentclassessPrevious']);

		Route::get('parents/search', ['as' => 'parents.search', 'uses' => 'ParentController@parentssearch']);
		Route::post('parents/createparent', ['as' => 'parents.createparent', 'uses' => 'ParentController@store']);
		Route::resource('parents','ParentController');

		Route::get('teacher/search', ['as' => 'teacher.search', 'uses' => 'TeachersController@search']);
		Route::post('teacher/createteacher', ['as' => 'teacher.createteacher', 'uses' => 'TeachersController@store']);
		Route::resource('teacher','TeachersController');


        Route::get('template','ParentController@templateview');

        Route::get('usermanagement2/search', ['as' => 'usermanagement2.search', 'uses' => 'usermanagementController2@search']);
        Route::get('usermanagement2/show', ['as' => 'usermanagement2.show', 'uses' => 'usermanagementController2@show']);
        Route::get('usermanagement2/edit', ['as' => 'usermanagement2.edit', 'uses' => 'usermanagementController2@edit']);
        Route::get('usermanagement2/destroy', ['as' => 'usermanagement2.destroy', 'uses' => 'usermanagementController2@destroy']);
         Route::post('usermanagement2/create', ['as' => 'usermanagement2.create', 'uses' => 'usermanagementController2@create']);
        Route::post('usermanagement2/createuser', ['as' => 'usermanagement2.createuser', 'uses' => 'usermanagementController2@store']);
		Route::resource('usermanagement2','usermanagementController2');

		
        Route::get('studentsinfo/search', ['as' => 'studentsinfo.search', 'uses' => 'StudentInformationController@studentsinfosearch']);
		Route::post('studentsinfo/createparent', ['as' => 'studentinfo.createstudentsinfo', 'uses' => 'StudentInformationController@store']);
		Route::resource('studentsinfo','StudentInformationController');


		  Route::get('schoolinfo/search', ['as' => 'schoolinfo.search', 'uses' => 'SchoolinfoController@schoolinfosearch']);
		 Route::post('schoolinfo/createschoolinfo', ['as' => 'schoolinfo.createschoolinfo', 'uses' => 'SchoolinfoController@store']);
		 Route::resource('schoolinfo','SchoolinfoController');


	Route::get('classes/search', ['as' => 'classes.search', 'uses' => 'classes2Controller@classessearch']);
		Route::post('classes/createclasses', ['as' => 'classes.createclasses', 'uses' => 'classes2Controller@store']);
		Route::resource('classes','classes2Controller');

        
      Route::get('classinfo/search', ['as' => 'classinfo.search', 'uses' => 'classinfoController@classinfosearch']);
	  Route::post('classinfo/createclassinfo', ['as' => 'classesinfo.createclassinfo', 'uses' => 'classinfoController@store']);
		Route::resource('classinfo','classinfoController');

		Route::post('getStudentClass', ['as' => 'usermanagement2.getStudentClass', 'uses' => 'Teacher_ChildrenController@getStudentClass']);
Route::post('terminalscore/getStudentClass', ['as' => 'terminalscore.getStudentClass', 'uses' => 'Teacher_ChildrenController@getStudentClass']);
Route::post('terminalscore/{id}/getStudentClass', ['as' => 'usermanagement2.getStudentClass', 'uses' => 'Teacher_ChildrenController@getStudentClass']);

Route::post('getSubjects', ['as' => 'usermanagement2.getSubjects', 'uses' => 'Teacher_ChildrenController@getSubjects']);
Route::post('terminalscore/getSubjects', ['as' => 'terminalscore.getSubjects', 'uses' => 'Teacher_ChildrenController@getSubjects']);
Route::post('terminalscore/{id}/getSubjects', ['as' => 'usermanagement2.getSubjects', 'uses' => 'Teacher_ChildrenController@getSubjects']);

Route::post('getClassofStudent', ['as' => 'usermanagement2.getClassofStudent', 'uses' => 'Teacher_ChildrenController@getClassofStudent']);
Route::post('studentbehaviour/getClassofStudent', ['as' => 'terminalscore.getClassofStudent', 'uses' => 'Teacher_ChildrenController@getClassofStudent']);
Route::post('studentbehaviour/{id}/getClassofStudent', ['as' => 'usermanagement2.getClassofStudent', 'uses' => 'Teacher_ChildrenController@getClassofStudent']);

// Route::post('getSubjectsAdmin', ['as' => 'usermanagement2.getSubjectsAdmin', 'uses' => 'Teacher_ChildrenController@getSubjectsAdmin']);
// Route::post('terminalscore/getSubjectsAdmin', ['as' => 'terminalscore.getSubjectsAdmin', 'uses' => 'Teacher_ChildrenController@getSubjectsAdmin']);
// Route::post('terminalscore/{id}/getSubjectsAdmin', ['as' => 'usermanagement2.getSubjectsAdmin', 'uses' => 'Teacher_ChildrenController@getSubjectsAdmin']);


	  Route::get('subject/search', ['as' => 'subject.search', 'uses' => 'subjectsController@search']);
	  Route::post('subject/createsubject', ['as' => 'subjects.createsubject', 'uses' => 'subjectsController@store']);
	  Route::resource('subject','subjectsController');

	  Route::get('subject2/search', ['as' => 'subject2.search', 'uses' => 'subject2Controller@search']);
		Route::post('subject2/createsubject2', ['as' => 'subject2.createclasses', 'uses' => 'subject2Controller@store']);
		Route::resource('subject2','subject2Controller');

	
	  Route::get('term/search', ['as' => 'term.search', 'uses' => 'TermController@search']);
	  Route::post('term/createterm', ['as' => 'terms.createterm', 'uses' => 'TermController@store']);
	  Route::resource('term','TermController');

	  
	  Route::get('student/search', ['as' => 'student.search', 'uses' => 'StudentController@search']);
	  Route::post('student/createstudent', ['as' => 'student.createstudent', 'uses' => 'StudentController@store']);
	  Route::resource('student','StudentController');
        
   //      Route::get('promotestudents/search', ['as' => 'promotestudents.search', 'uses' => 'PromotestudentController@search']);
	  // Route::post('promotestudents/createpromotestudents', ['as' => 'promotestudents.createpromotestudents', 'uses' => 'PromotestudentController@store']);
	  // Route::get('promotestudents','PromotestudentController@');

        
    Route::get('terminalscore/search', ['as' => 'terminalscore.search', 'uses' => 'terminalscoreController@search']);
   
	Route::post('terminalscore/createterminalscore', ['as' => 'terminalscore.createterminalscore', 'uses' => 'terminalscoreController@store']);
	 
	  Route::resource('terminalscore','terminalscoreController');

	  

	  Route::get('overalposition/search', ['as' => 'overalposition.search', 'uses' => 'OveralPositionController@search']);

	  Route::get('overalposition/searchStudent', ['as' => 'overalposition.searchStudent', 'uses' => 'OveralPositionController@searchStudent']);
   
	Route::post('overalposition/createoveralposition', ['as' => 'terminalscore.createterminalscore', 'uses' => 'OveralPositionController@store']);
	 
	   Route::resource('overalposition','OveralPositionController');


       Route::get('overalpositionDelete/search', ['as' => 'overalpositionDelete.search', 'uses' => 'OveralPositionController@search']);
   
	Route::post('overalposition/overalpositionDelete', ['as' => 'overalpositionDelete.createterminalscore', 'uses' => 'OveralPositionController@store']);

	  Route::resource('overalpositionDelete','OveralPositionDeleteController');



	    Route::get('teacherclass', 'ReportController@teacherclass');
		Route::get('teacherclass/search', ['as' => 'teacherclass.search', 'uses' => 'ReportController@teacherclasssearch']);
		
		Route::get('listsofclass', 'ReportController@listsofclass');
		Route::get('listsofclass/search', ['as' => 'listsofclass.search', 'uses' => 'ReportController@listsofclasssearch']);

		Route::get('promotestudents', 'PromotestudentController@promotestudents');
		Route::get('promotestudents/search', ['as' => 'promotestudents.search', 'uses' => 'PromotestudentController@promotestudentsSearch']);


        Route::get('Usermanagement3/search', ['as' => 'Usermanagement3.search', 'uses' => 'Usermanagement3Controller@search']);
        Route::get('Usermanagement3/show', ['as' => 'Usermanagement3.show', 'uses' => 'Usermanagement3Controller@show']);
        Route::get('Usermanagement3/edit', ['as' => 'Usermanagement3.edit', 'uses' => 'Usermanagement3Controller@edit']);
        Route::get('Usermanagement3/destroy', ['as' => 'Usermanagement3.destroy', 'uses' => 'Usermanagement3Controller@destroy']);
         Route::post('Usermanagement3/create', ['as' => 'Usermanagement3.create', 'uses' => 'Usermanagement3Controller@create']);
        Route::post('Usermanagement3/create3Cuser', ['as' => 'Usermanagement3.create3Cuser', 'uses' => 'Usermanagement3Controller@store']);
		Route::resource('Usermanagement3','Usermanagement3Controller');


		 Route::get('schoollogo/search', ['as' => 'schoollogo.search', 'uses' => 'schoollogoController@search']);
        Route::get('schoollogo/show', ['as' => 'schoollogo.show', 'uses' => 'schoollogoController@show']);
        Route::get('schoollogo/edit', ['as' => 'schoollogo.edit', 'uses' => 'schoollogoController@edit']);
        Route::get('schoollogo/destroy', ['as' => 'schoollogo.destroy', 'uses' => 'schoollogoController@destroy']);
         Route::post('schoollogo/create', ['as' => 'schoollogo.create', 'uses' => 'schoollogoController@create']);
        Route::post('schoollogo/createSchoolLogo', ['as' => 'schoollogo.createSchoolLogo', 'uses' => 'schoollogoController@store']);
		Route::resource('schoollogo','schoollogoController');
		

	Route::get('studentbehaviour/search', ['as' => 'studentbehaviour.search', 'uses' => 'studentbehaviourController@search']);
	Route::post('studentbehaviour/createstudentbehaviour', ['as' => 'studentbehaviour.createstudentbehaviour', 'uses' => 'studentbehaviourController@store']); 
	  Route::resource('studentbehaviour','studentbehaviourController');

	Route::get('yeartermsetup/search', ['as' => 'yeartermsetup.search', 'uses' => 'yeartermsetupController@search']);
	Route::post('yeartermsetup/createyeartermsetup', ['as' => 'yeartermsetup.createyeartermsetup', 'uses' => 'yeartermsetupController@store']); 

	Route::get('yeartermsetup/transfer', ['as' => 'yeartermsetup.transfer', 'uses' => 'yeartermsetupController@transfer']);

	Route::post('getTransferToHistory','yeartermsetupController@transfer');
	Route::post('yeartermsetup/getTransferToHistory', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'yeartermsetupController@transfer']);
	Route::post('yeartermsetup/{id}/getTransferToHistory', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'yeartermsetupController@transfer']);
	  Route::resource('yeartermsetup','yeartermsetupController');

	  Route::get('sms', ['as' => 'sms', 'uses' => 'SmsController@sms']);
	  Route::post('sendsms', ['as' => 'sms', 'uses' => 'SmsController@sendsms']);
	  Route::get('smsbalance', ['as' => 'smsbalance', 'uses' => 'SmsController@smsbalance']);
	  Route::get('/shortcode', ['as' => 'shortcode', 'uses' => 'SmsController@shortcode']); // create sms shortcode
	Route::post('/shortcode', ['as' => 'Assembly.shortcodesave', 'uses' => 'SmsController@shortcodesave']);// save sms shortcode

	  Route::get('Meeting/search', ['as' => 'Meeting.search', 'uses' => 'MeetingController@search']);
	Route::post('Meeting/createmeeting', ['as' => 'Meeting.createmeeting', 'uses' => 'MeetingController@store']);
	Route::post('Meeting/createmeetingall', ['as' => 'Meeting.createmeetingall', 'uses' => 'MeetingController@createmeetingall']);
	Route::resource('Meeting', 'MeetingController');

	Route::post('searchmemberlists', ['as' => 'searchmemberlists.search', 'uses' => 'SmsController@searchmemberlists']);

Route::get('show', 'StudentController@showAllPicUploaded');

Route::post('getStudentImage','StudentImageController@getStudentImage');
	 Route::post('terminalscore/getStudentImage', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentImage']);
	 Route::post('terminalscore/{id}/getStudentImage', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentImage']);

	 
	 Route::post('getStudentNameDisplay','StudentImageController@getStudentNameDisplay');
	 Route::post('terminalscore/getStudentNameDisplay', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentNameDisplay']);
	 Route::post('terminalscore/{id}/getStudentNameDisplay', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentNameDisplay']);

	  Route::get('teachersetup/search', ['as' => 'teachersetup.search', 'uses' => 'TeachersetupController@search']);
		Route::post('teachersetup/createteachersetup', ['as' => 'teachersetup.createteachersetup', 'uses' => 'TeachersetupController@store']);
		Route::resource('teachersetup','TeachersetupController');

	 Route::post('getStudentClass2','StudentImageController@getStudentClass2');
	 Route::post('studentclass/getStudentClass2', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentClass2']);
	 Route::post('studentclass/{id}/getStudentClass2', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentClass2']);

 Route::post('getStudentSchool','StudentImageController@getStudentSchool');
	 Route::post('studentclass/getStudentSchool', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentSchool']);
	 Route::post('studentclass/{id}/getStudentSchool', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getStudentSchool']);

	  Route::post('getstudentSchool2','StudentImageController@getstudentSchool2');
	 Route::post('studentclass/getstudentSchool2', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getstudentSchool2']);
	 Route::post('studentclass/{id}/getstudentSchool2', ['as' => 'jobassign.getjobtype_technician', 'uses' => 'StudentImageController@getstudentSchool2']);

	 Route::post('getTeacherNames', ['as' => 'usermanagement2.getTeacherNames', 'uses' => 'TeacherNamesController@getTeacherNames']);
Route::post('usermanagement2/getTeacherNames', ['as' => 'usermanagement2.getTeacherNames', 'uses' => 'TeacherNamesController@getTeacherNames']);
Route::post('usermanagement2/{id}/getTeacherNames', ['as' => 'usermanagement2.getTeacherNames', 'uses' => 'TeacherNamesController@getTeacherNames']);

	 
	 /*Delete Multiple With Checkboxes */

	 // Route::post('deleteMultiple',['as'=>'deleteMultiple2', 'uses'=> 'rentController@deleteMultiple']);

		// Route::post('deleteMultiple2','rentController@deleteMultiple');

Route::delete('categories', ['as'=>'categories.destroy', 'uses'=>'StudentController@delete2']);
Route::delete('categories1', ['as'=>'categories1.destroy', 'uses'=>'subjectsController@delete2']);
Route::delete('categories2', ['as'=>'categories2.destroy', 'uses'=>'PromotestudentController@deleteStudent']);
Route::delete('categories3',['as'=>'categories3.deleteMultiple','uses'=>'usermanagementController2@deleteMultiple']);
Route::delete('categories4',['as'=>'categories4.deleteMultiple','uses'=>'TermController@deleteMultiple']);
Route::delete('categories6',['as'=>'categories6.deleteMultiple','uses'=>'TeachersetupController@deleteMultiple']);
Route::delete('categories7',['as'=>'categories7.deleteMultiple','uses'=>'subject2Controller@deleteMultiple']);
Route::delete('categories5',['as'=>'categories5.deleteMultiple','uses'=>'Classes2Controller@deleteMultiple']);
Route::delete('categories8',['as'=>'categories8.deleteMultiple','uses'=>'TeachersController@deleteMultiple']);
Route::delete('categories9',['as'=>'categories9.deleteMultiple','uses'=>'classinfoController@deleteMultiple']);
Route::delete('categories10',['as'=>'categories10.deleteMultiple','uses'=>'terminalscoreController@deleteMultiple']);
Route::delete('categories11',['as'=>'categories11.deleteMultiple','uses'=>'studentbehaviourController@deleteMultiple']);
Route::delete('categories12',['as'=>'categories12.deleteMultiple','uses'=>'SchoolinfoController@deleteMultiple']);
Route::delete('categories13',['as'=>'categories13.deleteMultiple','uses'=>'OveralPositionDeleteController@deleteMultipleClass']);
Route::delete('categories14',['as'=>'categories14.deleteMultiple','uses'=>'Usermanagement3Controller@deleteMultiple']);

Route::get('upload/attendance', 'UploadController@attendanceupload')->name('attendanceupload');
Route::get('excelfileupload', 'UploadController@memberupload')->name('memberupload');

	// Route::get('promotestudents/editStudent', ['as'=>'promotestudents.editStudent', 'uses'=>'PromotestudentController@editStudent']);

	/*End Delete Multiple With Checkboxes */

 /*Excel File Upload*/
 Route::get('FileuploadAA',array('as'=>'excel.import','uses'=>'FileController@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'FileController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'FileController@downloadExcelFile'));
/* End Excel File Upload*/

	 }); // end auth middleware
});

