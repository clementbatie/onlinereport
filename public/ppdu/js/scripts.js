
//this is my custom code --NNA
$(document).ready(


  function(){
   $(".alert").addClass("in").fadeOut(4500);

   /* swap open/close side menu icons */
   $('[data-toggle=collapse]').click(function(){
  	// toggle icon
  	$(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
  });


   /* This is the function that will get executed after the DOM is fully loaded */

   $( "#datepicker" ).datepicker({
     dateFormat: 'yy-mm-dd',
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range

    });

   /* deal with second datepicker in a form */
   $( "#datepicker2" ).datepicker({
     dateFormat: 'yy-mm-dd',
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range

    });
   $('#datepicker2,#datepicker1,#datepicker').keypress(function(e) {
    return false
  });
   $('#datetimepicker6').datetimepicker({
				//use24hours: true,
       format: 'YYYY-MM-DD HH:mm'
     });


   /* deal with fourth datepicker in a form */
   $( "#datepicker4" ).datepicker({
    dateFormat: 'yy-mm-dd',
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range

    });   

   /* deal with fifth datepicker in a form */
   $( "#datepicker5" ).datepicker({
    dateFormat: 'yy-mm-dd',
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range

    });    

   /* deal with one datepicker in a form --in case there is an incorrectly named date picker*/
   $( "#datepicker1" ).datepicker({
    dateFormat: 'yy-mm-dd',
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range

    });

   $(".activitytype").change(function(){

    var title = $('.activitytype').find('option:selected').text();
    console.log(title);
    if (title == "Bussing") {
      $('.tohide').show();
    }else{
      $('.tohide').hide();
    }
  });

   $("#IndicatorType").change(function(){

    var title = $('#IndicatorType').val();
    //alert(title);
    if (title == "F") {
      $('.FinanceType').show();
    }else{
      $('.FinanceType').hide();
    }
  });
//--------------------------------
$(".stats").change(function(){

  var indicator = $("#ftype").val();
  if (indicator == "Topic") {
    $('.comments').show();
    $('.famount').hide();
  }else{
    $('.comments').hide();
    $('.famount').show();
  }
});


$("#classattendancename").change(function(){
  var classname = $('#classattendancename').val();
  var date = $('#datepicker2').val();
  if (date == "") {
    alert('Choose a date');
  }else{
    /*within else statement*/
data.push({classname:classname,date:date});
console.log(data);
  var formData = {

    'classname'      : classname,
    'date'      : date,
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'fetchclassmembers', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Members Records Submitted");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
    /*end else statement*/
  }
});

$('#ie').change(function(){
  var opt = $('#ie').val();

  if (opt == "income") {
    $('#ftype')
    .find('option')
    .remove()
    .end()
    ;
    $.each(incomelabels, function(key, value) {   
     $('#ftype').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
          }); 
  }else if(opt == "expense"){
    $('#ftype')
    .find('option')
    .remove()
    .end()
    ;
    $.each(explabels, function(key, value) {   


     $('#ftype')
     .append($("<option></option>")
      .attr("value",key)
      .text(value)); 
   });
        //  alert('expense');
      }else{
         // alert(opt);
       }
     });

$("#statsadd").click(function(){
//  alert(2);
var fdate = $("#datepicker").val();
if (fdate == "") {
  alert("Date field is required");
  return;
}
var indicator = $("#ftype").val();
if (indicator == "") {
  alert("Indicator field is required");
  return;
}

var topic = $("#fvalue").val();
          //  alert(topic);
          if (indicator == "Topic") {
            if (topic == "") {
              alert("Topic field is required");
              return;
            }
            var facilitator = $("#facilitator").val();
            if (facilitator == "") {
              alert("Facilitator field is required");
              return;
            }

            var comments = $("#fcomments").val();

          }else{
            var amount = $("#famount").val();
           // alert(amount);
           if (amount == "") {
            alert("Amount field is required");
            return;
          }
        }

        var person = {date: fdate, indicators:indicator, amount:amount,comments:comments,topic:topic,facilitator:facilitator};
        data.push(person);
        console.log(data);
        $("#famount").val("");
        if (indicator == "Topic") {
         var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + indicator + "</td><td>" + topic + "</td><td>" + facilitator + "</td><td>" + comments + "</td></tr>";
         $("table tbody").append(markup);
       }else{
         var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + indicator + "</td><td>" + amount + "</td></tr>";
         $("table tbody").append(markup);
       }

     });



//////// Start Script To Retrieve Images And Display /////////////////////////////////////////////////////////


$('#studentname').change(function(){

    var studentname = $("#studentname").val();
    console.log(studentname);
  var formData = {
    'studentname'      : studentname,
    '_token'    : $('input[name=_token]').val()
  };

  $('#regid').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getStudentImage', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

   var opt1 = response.details;

   var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  var opt =  $(".studentimage").attr('src',baseUrl+"/public/uploads/"+opt1);
 //  $('#regid').val(regid);
 //  console.log(opt)
 //  console.log(baseUrl);

 // var opt = response.details;
   
 //         if (2==2) {
 //           $('#regid')
 //           .find('option')
 //           .remove()
 //           .end();

 //             $.each(opt, function(key, value) {   
 //              $('#regid').append($("<option></option>").attr("value",key).text(value)); 
 //             //alert(value);
 //            }); 
 //        }
 //      /*end populate  class field*/
          
    
 //       $('#blah').prop('disabled', false);
 //      return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#studentname').change(function(){

    var studentname = $("#studentname").val();
    console.log(studentname);
  var formData = {
    'studentname'      : studentname,
    '_token'    : $('input[name=_token]').val()
  };

  $('#StudentName').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getStudentNameDisplay', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#StudentName')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#StudentName').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#StudentName').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



// $('#studentname').change(function(){

//     var studentname = $("#studentname").val();
//     console.log(studentname);
//   var formData = {
//     'studentname'      : studentname,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#regid').prop('disabled', true);
//   console.log(formData);   
 
//   $.ajax({

//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getNameOfStudent', // the url where we want to POST        
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server        
//             encode : true
//           }).done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//    var opt1 = response.details;

//    var getUrl = window.location;
//   var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

//   var opt =  $(".studentimage").attr('src',baseUrl+"/public/uploads/"+opt1);
//   $('#regid').val(regid);
//   console.log(opt)
//   console.log(baseUrl);

//  var opt = response.details;
   
//          if (2==2) {
//            $('#regid')
//            .find('option')
//            .remove()
//            .end();

//              $.each(opt, function(key, value) {   
//               $('#regid').append($("<option></option>").attr("value",key).text(value)); 
//              //alert(value);
//             }); 
//         }
//       /*end populate  class field*/
          
    
//        $('#blah').prop('disabled', false);
//       return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });




// $("#studentname").change(function(){
//   var image = $('#studentname').find('option:selected').attr('image');
//   var regid = $('#studentname').find('option:selected').attr('regid');
//   console.log(image);

//   var getUrl = window.location;
//   var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

//   var pic =  $(".studentimage").attr('src',baseUrl+"/public/uploads/"+image);
//   $('#regid').val(regid);
//   console.log(pic)
//   console.log(baseUrl);
// });


// $("#student").change(function(){
//   var image = $('#student').find('option:selected').attr('image');
//   var regid = $('#student').find('option:selected').attr('regid');
//   console.log(image);

//   var getUrl = window.location;
//   var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

//   var pic =  $(".studentimage").attr('src',baseUrl+"/public/uploads/"+image);
//   $('#regid').val(regid);
//   console.log(pic)
//   console.log(baseUrl);
// });
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah2').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp2").change(function() {
  console.log('passed');
  readURL(this);
});


function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  console.log('passed');
  readURL(this);
});



//////// End Script To Retrieve Images And Display /////////////////////////////////////////////////////////



$('#searchString1').change(function(){
    var searchString1 = $("#searchString1").val();
    console.log(searchString1);
  var formData = {
    'searchString1'      : searchString1,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentclass').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getStudentClass2', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#studentclass')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentclass').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentclass').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

$('#searchString1').change(function(){
    var searchString1 = $("#searchString1").val();
    console.log(searchString1);
  var formData = {
    'searchString1'      : searchString1,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentSchool').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getStudentSchool', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#studentSchool')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentSchool').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentSchool').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#studentclass').change(function(){
    var studentclass = $("#studentclass").val();
    console.log(studentclass);
  var formData = {
    'studentclass'      : studentclass,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentSchool').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getstudentSchool2', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#studentSchool')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentSchool').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentSchool').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$("#add3Cuser").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Parent name field is required");
    return;
  }

 var email = $("#useremail").val();
  if (email == "") {
    alert("Email field is required");
    return;
  }

    var schoolname = $("#schoolname").val();
  if (schoolname == "") {
    alert("schoolname field is required");
    return;
  }


  var PhoneNo = $("#PhoneNo").val();
  if (PhoneNo == "") {
    alert("PhoneNo field is required");
    return;
  }

  var UserLevelID2 = $("#UserLevelID2").val();
  if (UserLevelID2 == "") {
    alert("User Level field is required");
    return;
  }
   

 $(document).ready(function (){
    $('#password').change(function (){
        $('.form-control.hidden').removeclass('hidden');
    });
});



  console.log(schoolname);
  var schoolnamedisplay = $("#schoolname").find('option:selected').text();

   console.log(UserLevelID2);
  var Userleveldisplay = $("#UserLevelID2").find('option:selected').text();

  // var userlevel = $("#UserLevelID").find('option:selected').text();

  var person = {name:name, email:email,PhoneNo:PhoneNo,schoolname:schoolname,UserLevelID2:UserLevelID2};
  data.push(person);
  
  $(this).closest('form').find("input[type=text],select, textarea").val("");

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+"</td><td>" + email+"</td><td>"+schoolnamedisplay +"</td><td>" +Userleveldisplay+ "</td></tr>";
  

  $("table tbody").append(markup);
});


$('.create3Cuser').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'create3Cuser', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
        $("table tbody").find('input[name="record"]').each(function(index,value){

           $(this).parents("tr").remove();
          

        });     
         data = [];
         data = new Array;
      // return;
      alert("User created Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmail2.length; i++) {
          alert('Email Exists \n\rEmail: ' + response.UserEmail2[i].email +'\nSchoolCode: ' + response.UserEmail2[i].SchoolCode + "\r\n");
      }
    }
   
  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


// $("#UserLevelID").change(function() {
//         console.log($("#UserLevelID option:selected").val());
//         if ($("#UserLevelID option:selected").val() == 3) {
//             $('#parentchildren2').prop('disabled', false);
//              $('#parentchildren').prop('disabled', 'disabled');

//             // $('#location').val("Outreach");
//             // $('#SoulsWon').val(0);
            
//         } else {
//             $('#parentchildren').prop('disabled', false);
//             $('#parentchildren2').prop('disabled', 'disabled');
//             $('#location').show();
//             $('#SoulsWon').show();
//         }
//     });


$("#addteachersetup").click(function(){
  var name = $("#teachersetupname").val();
  if (name == "") {
    
    var str = "Teacher Name field is required";
      str = str.fontsize("6").fontcolor("#006400").bold();
      bootbox.alert(str);
    return;
  }
  var phonenumber = $("#phonenumber").val();
  if (phonenumber == "") {

    var str = "Phone No field is required";
      str = str.fontsize("6").fontcolor("#006400").bold();
      bootbox.alert(str);
    return;
  }
  
  // var displaychildren = $("#teacherclass").find('option:selected').text();
  // console.log(children);
  
  // var displaysubjects = $("#teachersubject").find('option:selected').text();  
  // console.log(subject);

  var person = {name:name, phonenumber:phonenumber};
  data.push(person);
   $(this).closest('form').find("input[type=text],select, textarea").val("");
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + phonenumber + "</td></tr>";
  $("table tbody").append(markup);
});


$('.createteachersetup').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    // bootbox.alert("Please Add Records");

    var str = "Please Add Records";
      str = str.fontsize("6").fontcolor("#006400").bold();
      bootbox.alert(str);
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createteachersetup', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      var str = "Teacher Saved Successfully";
      str = str.fontsize("6").fontcolor("#006400").bold();
      bootbox.alert(str);
      // return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {

        var str = 'Phone Number Exists<br> \n\rTeacher Name: ' + response.person[i].TeacherSetupName +'<br>\nPhone Number: ' + response.person[i].PhoneNo + "\r\n";
      str = str.fontsize("5").fontcolor("#006400").bold();
      bootbox.alert(str);
        
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


$("#addsubject2").click(function(){
  var subjectname = $("#subject2name").val();
    if (subjectname == "") {
      alert("Subject Name field is required");
      return;
    }
  
    var person = {subjectname:subjectname};
    data.push(person);
      
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +subjectname+ "</td><td>";
    $("table tbody").append(markup);
  });


$('.createsubject2').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsubject2', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
   
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;
       alert("Subject Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Subject Exists \n\r\n\rName: ' + response.person[i].SubjectName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

 $("#UserLevelID").change(function(){

    var title = $("#UserLevelID").val();
    console.log(title);
    if (title == 3) {
      $('.tohide').show();
    }else{
      $('.tohide').hide();
    }
  });

$("#UserLevelID").change(function(){

    var title = $("#UserLevelID").val();
    console.log(title);
    if (title == 2) {
      $('.tohide2').show();
    }else{
      $('.tohide2').hide();
    }
  });


$('#UserLevelID').change(function(){

    var UserLevelID = $("#UserLevelID").val();
    console.log(UserLevelID);
  var formData = {
    'UserLevelID'      : UserLevelID,
    '_token'    : $('input[name=_token]').val()
  };

  $('#nameParentTeacher').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getTeacherNames', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#nameParentTeacher')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#nameParentTeacher').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#nameParentTeacher').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



$('#deletemultiple').change(function(){
alert(3);
    var deletemultiple = $("#deletemultiple").val();
    console.log(deletemultiple);
  var formData = {
    'deletemultiple'      : deletemultiple,
    '_token'    : $('input[name=_token]').val()
  };

  $('#nameParentTeacher').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getTeacherNames', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#nameParentTeacher')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#nameParentTeacher').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#nameParentTeacher').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
// $('#UserLevelID').change(function(){
//       var selectBox = $('#UserLevelID').val();
   
//       if(selectBox == 3){

//          $('#parentchildren2').show(1100).delay(1000);
//          $('#parentchildren').hide(1100).delay(1000);

         
//        }else {
//        $('#parentchildren2').hide(1100).delay(1000);
//          $('#parentchildren').show(1100).delay(1000);


//        }
      
//     });

$("#billduesadd").click(function(){
//  alert(2);
var fdate = $("#datepicker").val();
if (fdate == "") {
  alert("Date field is required");
  return;
}
var amount = $("#amount").val();
if (amount == "") {
  alert("Amount field is required");
  return;
}

var comments = $("#comments").val();


var duestype = $("#duestype").val();
if (duestype == "") {
  alert("Duestype field is required");
  return;
}
var duestypename = $("#duestype").find('option:selected').text();

var member = $("#member").val();
if (member == "") {
 alert("Member field is required");
 return;
}
var membername = $("#member").find('option:selected').text();

var person = {date: fdate, amount:amount, member:member,comments:comments,duestype:duestype};
data.push(person);
console.log(data);

var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + membername + "</td><td>" + fdate + "</td><td>" + amount +  "</td><td>" + duestypename + "</td><td>" + comments +"</td></tr>";
$("table tbody").append(markup);


});



$("#add").click(function(){
  var fdate = $("#datepicker").val();
  if (fdate == "") {
    alert("Date field is required");
    return;
  }
  var indicator = $("#ftype").val();
  if (indicator == "") {
    alert("Indicator field is required");
    return;
  }
  var amount = $("#famount").val();
  if (amount == "") {
    alert("Amount field is required");
    return;
  }
  var person = {date: fdate, indicators:indicator, amount:amount};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + indicator + "</td><td>" + amount + "</td></tr>";
  $("table tbody").append(markup);
});

        // Find and remove selected table rows
        $(".delete-row").click(function(){
          var selecteds = [];
          $("table tbody").find('input[name="record"]').each(function(index,value){
            if($(this).is(":checked")){  
              selecteds.push(index);  
              $(this).parents("tr").remove();
            }
          });
          var reversearray = selecteds.reverse();
          $.each(reversearray,function(index,value){
            console.log("value is " + value);
            data.splice(value,1);
            console.log("data is now");
            console.log(data);
          });
          
        });
        // end of delete button
        $("#addfinance").click(function(){
          var fdate = $("#datepicker").val();
          if (fdate == "") {
            alert("Date field is required");
            return;
          }
          var indicator = $("#ftype").val();
          if (indicator == "") {
            alert("Indicator field is required");
            return;
          }
          var amount = $("#famount").val();
          if (amount == "") {
            alert("Amount field is required");
            return;
          }
          var ie = $("#ie").val();
          if (ie == "") {
            alert("Income/Expenditure field is required");
            return;
          }
          var comments = $("#comment").val();
          var person = {date: fdate, indicators:indicator, amount:amount,ie:ie,comments:comments};
          data.push(person);
          $('form').find("input[type=text],input[type=number],textarea").val("");

          console.log(data);
          var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" 
          + indicator + "</td><td>" + amount + "</td><td>" +ie+ "</td><td>" +comments+ "</td></tr>";
          $("table tbody").append(markup);
        });

        $("#addmeeting").click(function(){
          var fdate = $("#datepicker2").val();
          if (fdate == "") {
            alert("Date field is required");
            return;
          }
          var name = $("#Meeting_Name").val();
          if (name == "") {
            alert("Meeting name field is required");
            return;
          }
          var time = $("#Meeting_Time").val();
          if (time == "") {
            alert("time field is required");
            return;
          }
          var leader = $("#leader").val(); var leadername = $("#leader").find("option:selected").text();
          if (leader == "") {
            alert("Leader must be selected");
            return;
          }
          var person = {date: fdate, Leader_Name:leader, Meeting_Time:time,Meeting_Name:name};
          data.push(person);
          console.log(data);
          var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + name + "</td><td>" + time + "</td><td>" +leadername+ "</td></tr>";
          $("table tbody").append(markup);
        });

  //  (function () {

    $('#btnRight').click(function (e) {

      var selectedOpts = $('#lstBox1 option:selected');
      if (selectedOpts.length == 0) {
        alert("Nothing to move.");
        e.preventDefault();
      }

      $('#lstBox2').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    });

    $('#btnAllRight').click(function (e) {
      var selectedOpts = $('#lstBox1 option');
      if (selectedOpts.length == 0) {
        alert("Nothing to move.");
        e.preventDefault();
      }

      $('#lstBox2').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    });

    $('#btnLeft').click(function (e) {
      var selectedOpts = $('#lstBox2 option:selected');
      if (selectedOpts.length == 0) {
        alert("Nothing to move.");
        e.preventDefault();
      }

      $('#lstBox1').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    });

    $('#btnAllLeft').click(function (e) {
      var selectedOpts = $('#lstBox2 option');
      if (selectedOpts.length == 0) {
        alert("Nothing to move.");
        e.preventDefault();
      }

      $('#lstBox1').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    });
    
   // }(jQuery));
   $("#addposition").click(function(){
    var area = $("#areaname").val();
    if (area == "") {
      alert("Area name field is required");
      return;
    }
    var area2 = $("#areaname").find("option:selected").text();
    var zone = $("#zonename").val();
    if (zone == "") {
      alert("Zone name field is required");
      return;
    }
    var zone2 = $("#zonename").find("option:selected").text();
    var cell = $("#cellname").val();
    if (cell == "") {
      alert("Cell name field is required");
      return;
    }
    var cell2 = $("#cellname").find("option:selected").text();
    var leader = $("#leadername").val();
    if (leader == "") {
      alert("leader name field is required");
      return;
    }
    var leader2 = $("#leadername").find("option:selected").text();
    console.log(leader2);
    var pposition = $("#pposition").val();
    if (pposition == "") {
      alert("Position field is required");
      return;
    }
    var person = {pposition:pposition, leader:leader,leader2:leader2, cell:cell,zone:zone,area:area};
    data.push(person);
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + leader2+"</td><td>" +pposition + "</td><td>" + area2 + "</td><td>" + zone2 +"</td><td>" + cell2+"</td></tr>";
    $("table tbody").append(markup);
  });

/////////////////////////////////////////////////
    $("#addschoolinfo").click(function(){
    var Name = $("#Name").val();
    if (Name == "") {
      alert("Name of School field is required");
      return;
    }
    
     var Address = $("#address").val();
    if (Address == "") {
      alert("Address field is required");
      return;
    }

    var contactNos = $("#contactNos").val();
    if (contactNos == "") {
      alert("ContactNos field is required");
      return;
    }
     var SchoolCode = $("#SchoolCode").val();
    if (SchoolCode == "") {
      alert("School Code field is required");
      return;
    }

    var ReportName = $("#ReportName").val();
    if (ReportName == "") {
      alert("Report Name field is required");
      return;
    }

   
    var person = {Name:Name, Address:Address,contactNos:contactNos, SchoolCode:SchoolCode,ReportName:ReportName};
    data.push(person);
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + Name+"</td><td>" +Address + "</td><td>" + contactNos + "</td><td>" + SchoolCode +"</td><td>" + ReportName+"</td></tr>";
    $("table tbody").append(markup);
  });

  
  $('.createschoolinfo').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createschoolinfo', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Records Submitted");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
}); 


    $("#addclasses2").click(function(){
    var Name = $("#classname").val();
    if (Name == "") {
      bootbox.alert("Class Name field is required");
      return;
    }
    
    //  var schoolcode = $("#schoolcode").val();
    // if (schoolcode == "") {
    //   alert("School Code field is required");
    //   return;
    // }

   
    var person = {Name:Name};
    data.push(person);
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + Name+"</td></tr>";
    $("table tbody").append(markup);
  });



      $('.createclasses2').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    bootbox.alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createclasses', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;
      bootbox.alert("Class Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmailUser.length; i++) {
        bootbox.alert('Class Exists \n\rClass Name: ' + response.UserEmailUser[i].ClassName +'\nSchool Name: ' + response.UserEmailUser[i].Name + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
}); 


   $("#addzoneposition").click(function(){
    var area = $("#areaname").val();
    if (area == "") {
      alert("Area name field is required");
      return;
    }
    var area2 = $("#areaname").find("option:selected").text();
    var zone = $("#zonename").val();
    if (zone == "") {
      alert("Zone name field is required");
      return;
    }
    var zone2 = $("#zonename").find("option:selected").text();
    var leader = $("#leadername").val();
    if (leader == "") {
      alert("leader name field is required");
      return;
    }
    var leader2 = $("#leadername").find("option:selected").text();
    console.log(leader2);
    var pposition = $("#pposition").val();
    if (pposition == "") {
      alert("Position field is required");
      return;
    }
    var person = {pposition:pposition, leader:leader,zone:zone,area:area};
    data.push(person);
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + leader2+"</td><td>" +pposition + "</td><td>" + area2 + "</td><td>" + zone2 +"</td></tr>";
    $("table tbody").append(markup);
  });

   $("#addareaposition").click(function(){
    var area = $("#areaname").val();
    if (area == "") {
      alert("Area name field is required");
      return;
    }
    var area2 = $("#areaname").find("option:selected").text();         
    var leader = $("#leadername").val();
    if (leader == "") {
      alert("leader name field is required");
      return;
    }
    var leader2 = $("#leadername").find("option:selected").text();
    console.log(leader2);
    var pposition = $("#pposition").val();
    if (pposition == "") {
      alert("Position field is required");
      return;
    }
    var person = {pposition:pposition, leader:leader,area:area};
    data.push(person);
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + leader2+"</td><td>" +pposition + "</td><td>" + area2  +"</td></tr>";
    $("table tbody").append(markup);
  });


   $("#addleader").click(function(){
    var leader = $("#leadername").val();
    if (leader == "") {
      alert("Leader name field is required");
      return;
    }
    var contact = $("#contact").val();
    if (contact == "") {
      alert("contact number field is required");
      return;
    }
    var email = $("#email").val();
    if (email == "") {
      alert("email field is required");
      return;
    }
    var address = $("#address").val();
    if (address == "") {
      alert("address name field is required");
      return;
    }
    var areaname = $("#areaid").find("option:selected").text();
    console.log(areaid);
    var areaid = $("#areaid").val();
    if (areaid == "") {
      alert("Area ID field is required");
      return;
    }
    var person = {leader:leader, contact:contact, email:email,address:address,areaid:areaid};
    data.push(person);
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + leader+"</td><td>" +contact + "</td><td>" + email + "</td><td>" + address +"</td><td>" + areaname+"</td></tr>";
    $("table tbody").append(markup);
  });


   $("#addmembersms").click(function(){

    var name = $("#smsmember").val(); var actualname = $("#smsmember").find("option:selected").text();
    if (name == "") {
      alert("Member name field is required");
      return;
    }
    $("#smsmember").prop('selectedIndex',"");
    $("#textmessage").attr("disabled", "disabled");
    var mymessage = $("#textmessage").val();
    var date = $("#datepicker2").val();
    var count =  $("#usedsms").text();
    console.log(mymessage);
    var person = {phone:name,count:count,textmessage:mymessage,date:date};
    data.push(person);

    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + actualname+  "</td></tr>";
    $("table tbody").append(markup);
  });

   $('.querysms').click(function (e) {
    e.preventDefault();
    $('#spinner').show();
    $('#querysms').hide();
    var query = [] ;
   var cellname =  "";//$('#cellname').val();
   var meetingname = "";//$('#meetingname').val();
   var category = $('#category').val();
   var from = $('#datepicker1').val();
   var to = $('#datepicker4').val();
   var person = {cellname:cellname,meetingname:meetingname,category:category,from:from,to:to};
   query.push(person);
   var formData = {
    'data'      : {data:query},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'searchlists', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    $('#spinner').hide();
    $('#querysms').show();
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();
     });     
      data = [];
      data = new Array;
      var date = $("#datepicker2").val();
      var count =  $("#usedsms").text();
      var mymessage = $("#textmessage").val();
        // alert(response.details[0].name);
        for (var i = 0; i < response.details.length; i++) {
         var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + response.details[i].name+ "</td><td>"+ response.details[i].contact+ "</td><td>" + response.details[i].date+ "</td><td>" + response.details[i].AssemblyName+ "</td><td>" + response.details[i].flag+ "</td></tr>";
          //  console.log(response.details[i]);
          $("table tbody").append(markup);

          var person = {phone:response.details[i].contact,count:count,textmessage:mymessage,date:date};
          data.push(person);

        }
        return;
      }else if(response.message == "exists"){
       $('#spinner').hide();
       $('#querysms').show();
       for (var i = 0; i <= response.member_id.length; i++) {
        alert('Member Exists \n\rName: ' + response.details[i].member_id +'\nCellName: ' + response.details[i].member_id + "\r\n");
      }
    }

  })
  .fail(function(response) {
   $('#spinner').hide();
   $('#querysms').show();
   console.log(data);
   console.log(response.responseText); 
   alert("Error");

 });
});

   $('.querymembersms').click(function (e) {
    e.preventDefault();
    $('#spinner').show();
    $('#querymembersms').hide();
    var query = [] ;
    var membertypes = $('#membertypes').val();
    var gender = $('#gender').val();
    var from = $('#datepicker1').val();
    var to = $('#datepicker4').val();
    var person = {gender:gender,membertypes:membertypes,from:from,to:to};
    query.push(person);
    var formData = {
      'data'      : {data:query},
      '_token'    : $('input[name=_token]').val()
    };
    console.log(formData); 

    console.log(data);

    $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'searchmemberlists', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
    .done(function(response) {
      $('#spinner').hide();
      $('#querymembersms').show();
      if (response.message == "correct") {
        $("table tbody").find('input[name="record"]').each(function(index,value){
         $(this).parents("tr").remove();
       });     
        data = [];
        data = new Array;
        var date = $("#datepicker2").val();
        var count =  $("#usedsms").text();
        var mymessage = $("#textmessage").val();
        // alert(response.details[0].name);
        for (var i = 0; i < response.details.length; i++) {
         var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + response.details[i].StudentName+ "</td><td>" +response.details[i].ParentNumber+ "</td><td>" +response.details[i].ClassName+ "</td><td>";
          //  console.log(response.details[i]);
          $("table tbody").append(markup);

          var person = {ParentNumber:response.details[i].ParentNumber,count:count,textmessage:mymessage,date:date};
          data.push(person);

        }
        return;
      }else if(response.message == "exists"){
       $('#spinner').hide();
       $('#querysms').show();
       for (var i = 0; i <= response.member_id.length; i++) {
        alert('Member Exists \n\rName: ' + response.details[i].member_id +'\nCellName: ' + response.details[i].member_id + "\r\n");
      }
    }

  })
    .fail(function(response) {
     $('#spinner').hide();
     $('#querymembersms').show();
     console.log(data);
     console.log(response.responseText); 
     alert("Error");

   });
  });

   $('.queryleadersms').click(function (e) {
    e.preventDefault();
    $('#spinner').show();
    $('#queryleadersms').hide();
    var query = [] ;
    var areaname = $('#areaname').val();
    var title = $('#title').val();

    var person = {areaname:areaname,title:title};
    query.push(person);
    var formData = {
      'data'      : {data:query},
      '_token'    : $('input[name=_token]').val()
    };
    console.log(formData); 

    console.log(data);

    $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'searchleaderlists', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
    .done(function(response) {
      $('#spinner').hide();
      $('#queryleadersms').show();
      if (response.message == "correct") {
        $("table tbody").find('input[name="record"]').each(function(index,value){
         $(this).parents("tr").remove();
       });     
        data = [];
        data = new Array;
        var date = $("#datepicker2").val();
        var count =  $("#usedsms").text();
        var mymessage = $("#textmessage").val();
        // alert(response.details[0].name);
        for (var i = 0; i < response.details.length; i++) {
         var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + response.details[i].name+ "</td><td>" + response.details[i].contact+ "</td><td>" + response.details[i].title+ "</td><td>" + response.details[i].AreaName+ "</td></tr>";
          //  console.log(response.details[i]);
          $("table tbody").append(markup);

          var person = {phone:response.details[i].contact,count:count,textmessage:mymessage,date:date};
          data.push(person);

        }
        return;
      }else if(response.message == "exists"){
       $('#spinner').hide();
       $('#queryleadersms').show();
       for (var i = 0; i <= response.member_id.length; i++) {
        alert('Member Exists \n\rName: ' + response.details[i].member_id +'\nCellName: ' + response.details[i].member_id + "\r\n");
      }
    }

  })
    .fail(function(response) {
     $('#spinner').hide();
     $('#queryleadersms').show();
     console.log(data);
     console.log(response.responseText); 
     alert("Error");

   });
  });


   $("#textmessage").keyup(function(){
     var len =$("#textmessage").val().length;
     $("#display_count").html(len);
     res = len/160;
     smsused =Math.ceil( res);
     $("#usedsms").html(smsused);
     $("#smscount").val(smsused);
   }).focusout(function() {
    var len =$("#textmessage").val().length;
    $("#display_count").html(len);
    res = len/160;
    smsused =Math.ceil( res);
    $("#usedsms").html(smsused);
    $("#smscount").val(smsused);
  }).bind("paste", function(e){
    setTimeout(function () {
      var text = $(element).val();
      var len =$("#textmessage").val().length;
      $("#display_count").html(len);
      res = len/160;
      smsused =Math.ceil( res);
      $("#usedsms").html(smsused);
      $("#smscount").val(smsused);
    }, 100);
  } );

// sending sms 
function sendnextsms(){
  if (data.length < 1) {
   $('#spinner').hide();
   $('#sendsms').show();
   alert("All Sms sent");
   return;
 }
 var textmessage = $('#textmessage').val();
 var tempdata = data;


 var newdata = tempdata[0];
 console.log("newdata is " + newdata);
 var formData = {
  'data'      : {data:newdata,textmessage:textmessage},
  '_token'    : $('input[name=_token]').val(),
};

console.log(formData);
$.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'sendsms', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server

            encode      : true
          })
.done(function(response) {
   // alert(index);

   
   if (response.message == "correct") {
    var details = response.details;
    console.log(details);
    var code = details.substr(0, 4);
    if (code == "1701") {
     data.splice(0,1);
     $("tr").eq(0).remove();
     console.log("Am here sending next sms");
     sendnextsms();
   }
   $('#spinner').hide();
   $('#sendsms').show();
   return ;
 }else if(response.message == "nocredit"){
  console.log(response);
  console.log(response.message);
  $('#spinner').hide();
  $('#sendsms').show();
  alert(response.details);
}
})
.fail(function(response) {
  console.log(data);
  console.log(response.responseText); 
  $('#spinner').hide();
  $('#sendsms').show();
  alert("Error");

});


}

/*personalised*/
// sending sms 
function sendnextsmspersonalised(){
  if (data.length < 1) {
   $('#spinner').hide();
   $('#sendsms').show();
   alert("All Sms sent");
   return;
 }
 var textmessage = $('#textmessage').val();
 if (textmessage == "") { alert('Text message is required'); return ;}
 var tempdata = data;


 var newdata = tempdata[0];
 console.log("newdata is " + newdata);
 var formData = {
  'data'      : {data:newdata,textmessage:textmessage},
  '_token'    : $('input[name=_token]').val(),
};

console.log(formData);
$.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'sendsmspersonalised', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server

            encode      : true
          })
.done(function(response) {
   // alert(index);

   
   if (response.message == "correct") {
    var details = response.details;
    console.log(details);
    var code = details.substr(0, 4);
    if (code == "1701") {
     data.splice(0,1);
     $("tr").eq(0).remove();
     console.log("Am here sending next sms");
     sendnextsmspersonalised();
   }
   $('#spinner').hide();
   $('#sendsms').show();
   return ;
 }else if(response.message == "nocredit"){
  console.log(response);
  console.log(response.message);
  $('#spinner').hide();
  $('#sendsms').show();
  alert(response.details);
}
})
.fail(function(response) {
  console.log(data);
  console.log(response.responseText); 
  $('#spinner').hide();
  $('#sendsms').show();
  alert("Error");

});


}
/*personalised end*/

/*sms for leaders personalised*/
function sendnextleadersmspersonalised(){
  if (data.length < 1) {
   $('#spinner').hide();
   $('#sendsms').show();
   alert("All Sms sent");
   return;
 }
 var textmessage = $('#textmessage').val();
 if (textmessage == "") { alert('Text message is required'); return ;}
 var tempdata = data;


 var newdata = tempdata[0];
 console.log("newdata is " + newdata);
 var formData = {
  'data'      : {data:newdata,textmessage:textmessage},
  '_token'    : $('input[name=_token]').val(),
};

console.log(formData);
$.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'sendleadersmspersonalised', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server

            encode      : true
          })
.done(function(response) {
   // alert(index);

   
   if (response.message == "correct") {
    var details = response.details;
    console.log(details);
    var code = details.substr(0, 4);
    if (code == "1701") {
     data.splice(0,1);
     $("tr").eq(0).remove();
     console.log("Am here sending next sms");
     sendnextsmspersonalised();
   }
   $('#spinner').hide();
   $('#sendsms').show();
   return ;
 }else if(response.message == "nocredit"){
  console.log(response);
  console.log(response.message);
  $('#spinner').hide();
  $('#sendsms').show();
  alert(response.details);
}
})
.fail(function(response) {
  console.log(data);
  console.log(response.responseText); 
  $('#spinner').hide();
  $('#sendsms').show();
  alert("Error");

});


}

$('.sendleadersmspersonalised').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var date = $('#datepicker2').val();
  if (date == "") {
    alert("Please Choose Date");
    return;
  }
  $('#spinner').show();
  $('#sendsms').hide();
  console.log(date + " sending date ");
  sendnextleadersmspersonalised();
});

/*sms end for leaders personalised*/
$('.sendsms').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var date = $('#datepicker2').val();
  if (date == "") {
    alert("Please Choose Date");
    return;
  }
  $('#spinner').show();
  $('#sendsms').hide();
  console.log(date + " sending date ");
  sendnextsms();
});

$('.sendsmspersonalised').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var date = $('#datepicker2').val();
  if (date == "") {
    alert("Please Choose Date");
    return;
  }
  $('#spinner').show();
  $('#sendsms').hide();
  console.log(date + " sending date ");
  sendnextsmspersonalised();
});

$("#addmember").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Member name field is required");
    return;
  }

  var gender = $("#gender").val();
  if (gender == "") {
    alert("Member gender field is required");
    return;
  }


  var contact = $("#contact").val();
  if (contact == "") {
    alert("contact number field is required");
    return;
  }
  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }

  var membertype = $("#membertype").val();
  if (membertype == "") {
    alert("Member Type field is required");
    return;
  }
  var typename = $("#membertype").find('option:selected').text();

  var dob = $("#datepicker1").val();


  var comments = $("#comment").val();


  var community = $("#community").val();
  if (community == "") {
    alert("community field is required");
    return;
  }

  var homeaddress = $("#homeaddress").val();
  if (homeaddress == "") {
    alert("home address field is required");
    return;
  }

  var person = {name:name,gender:gender,contact:contact,date:date,membertype:membertype,dob:dob,comments:comments,community:community,homeaddress:homeaddress};
  data.push(person);
  

  $(this).closest('form').find("input[type=text],select, textarea").val("");

  

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+ "</td><td>" + gender+"</td><td>" +contact + "</td><td>" +dob + "</td><td>" + date + "</td><td>" + typename + "</td><td>" + community + "</td><td>" + homeaddress + "</td></tr>";
  $("table tbody").append(markup);
});

$("#addclassmember").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Member name field is required");
    return;
  }

  var gender = $("#gender").val();
  if (gender == "") {
    alert("Member gender field is required");
    return;
  }


  var contact = $("#contact").val();
  if (contact == "") {
    alert("contact number field is required");
    return;
  }
  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }

  var classname = $("#classname").val();
  if (classname == "") {
    alert("Class field is required");
    return;
  }
  var typename = $("#classname").find('option:selected').text();

  var dob = $("#datepicker1").val();


  var comments = $("#comment").val();


  var community = $("#community").val();
  if (community == "") {
    alert("community field is required");
    return;
  }

  var homeaddress = $("#homeaddress").val();
  if (homeaddress == "") {
    alert("home address field is required");
    return;
  }

  var person = {name:name,gender:gender,contact:contact,date:date,classname:classname,dob:dob,comments:comments,community:community,homeaddress:homeaddress};
  data.push(person);
  

  $(this).closest('form').find("input[type=text],select, textarea").val("");

  

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+ "</td><td>" + gender+"</td><td>" +contact + "</td><td>" +dob + "</td><td>" + date + "</td><td>" + typename + "</td><td>" + community + "</td><td>" + homeaddress + "</td></tr>";
  $("table tbody").append(markup);
});

$("#addsoulmember").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Member name field is required");
    return;
  }

  var soultype = $("#soultype").val();
  if (soultype == "") {
    alert("Soultype field is required");
    return;
  }
  var soultypename = $("#soultype").find('option:selected').text(); 

  var gender = $("#gender").val();
  if (gender == "") {
    alert("Member gender field is required");
    return;
  }


  var contact = $("#contact").val();
  if (contact == "") {
    alert("contact number field is required");
    return;
  }
  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }

  

  var dob = $("#datepicker1").val();


  var comments = $("#comment").val();


  var community = $("#community").val();
  if (community == "") {
    alert("community field is required");
    return;
  }

  var homeaddress = $("#homeaddress").val();
  if (homeaddress == "") {
    alert("home address field is required");
    return;
  }

  var person = {name:name,soultype:soultype,gender:gender,contact:contact,date:date,dob:dob,comments:comments,community:community,homeaddress:homeaddress};
  data.push(person);
  

  $(this).closest('form').find("input[type=text],select, textarea").val("");

  

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+ "</td><td>" + gender+"</td><td>" +contact + "</td><td>" +dob + "</td><td>" + date  + "</td><td>" + community + "</td><td>" + homeaddress + "</td></tr>";
  $("table tbody").append(markup);
});

$("#addmembertop").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Member name field is required");
    return;
  }

  var gender = $("#gender").val();
  if (gender == "") {
    alert("Member gender field is required");
    return;
  }

  var contact = $("#contact").val();
  if (contact == "") {
    alert("contact number field is required");
    return;
  }
  var dob = $("#datepicker1").val();
  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }

  var membertype = $("#membertype").val();
  if (membertype == "") {
    alert("Member Type field is required");
    return;
  }
  var typename = $("#membertype").find('option:selected').text();

  var comments = $("#comment").val();
  

  var community = $("#community").val();
  if (community == "") {
    alert("community field is required");
    return;
  }

  var homeaddress = $("#homeaddress").val();
  if (homeaddress == "") {
    alert("home address field is required");
    return;
  }

  var assembly = $("#assembly").val();   
  if (assembly == "") {
    alert("Cell must be selected");
    return;
  }
  var assemblyname = $("#assembly").find('option:selected').text();   
  var person = {name:name,gender:gender,contact:contact,date:date,membertype:membertype,dob:dob,comments:comments,community:community,homeaddress:homeaddress,assembly:assembly};
  data.push(person);
  
  $(this).closest('form').find("input[type=text],select, textarea").val("");

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+"</td><td>" + gender+"</td><td>" +contact + "</td><td>" + dob + "</td><td>"+ date + "</td><td>" + typename + "</td><td>" + community + "</td><td>" + homeaddress +"</td><td>" + assemblyname + "</td></tr>";
  $("table tbody").append(markup);

});

$("#addsoulmembertop").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Member name field is required");
    return;
  }

  var soultype = $("#soultype").val();
  if (soultype == "") {
    alert("Soultype field is required");
    return;
  }
  var soultypename = $("#soultype").find('option:selected').text(); 

  var gender = $("#gender").val();
  if (gender == "") {
    alert("Member gender field is required");
    return;
  }

  var contact = $("#contact").val();
  if (contact == "") {
    alert("contact number field is required");
    return;
  }
  var dob = $("#datepicker1").val();
  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }



  var comments = $("#comment").val();


  var community = $("#community").val();
  if (community == "") {
    alert("community field is required");
    return;
  }

  var homeaddress = $("#homeaddress").val();
  if (homeaddress == "") {
    alert("home address field is required");
    return;
  }

  var assembly = $("#assembly").val();   
  if (assembly == "") {
    alert("Cell must be selected");
    return;
  }
  var assemblyname = $("#assembly").find('option:selected').text();   
  var person = {name:name,soultype:soultype,gender:gender,contact:contact,date:date,dob:dob,comments:comments,community:community,homeaddress:homeaddress,assembly:assembly};
  data.push(person);
  
  $(this).closest('form').find("input[type=text],select, textarea").val("");

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+"</td><td>" + gender+"</td><td>" +contact + "</td><td>" + dob + "</td><td>"+ date + "</td><td>" + community + "</td><td>" + homeaddress +"</td><td>" + assemblyname + "</td></tr>";
  $("table tbody").append(markup);

});


$("#addtitle").click(function(){
  var title = $("#titlename").val();
  if (title == "") {
    alert("Title field is required");
    return;
  }

  var person = {title:title};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + title+"</td></tr>";
  $("table tbody").append(markup);
});


$("#addmeetingtype").click(function(){
  var meetingtype = $("#typename").val();
  if (meetingtype == "") {
    alert("Title field is required");
    return;
  }

  var person = {typename:meetingtype};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + meetingtype+"</td></tr>";
  $("table tbody").append(markup);
});


$("#addmembertype").click(function(){
  var membertype = $("#membertypename").val();
  if (membertype == "") {
    alert("Member type field is required");
    return;
  }

  var person = {membertype:membertype};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + membertype+"</td></tr>";
  $("table tbody").append(markup);
});

$("#addcellmeeting").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Name field is required");
    return;
  }
  var viewname = $("#name").find("option:selected").text()

  var date = $("#datepicker2").val();
  if (date == "") {
    alert("Date field is required");
    return;
  }

  var meetingtype = $("#meetingtype").val();
  if (meetingtype == "") {
    alert("Member Type field is required");
    return;
  }
  var viewtype = $("#meetingtype").find("option:selected").text()

  var flag = $("#flag").val();
  if (flag == "") {
    alert("Flag Type field is required");
    return;
  }

  var comments = $("#comments").val();


  var person = {name:name,date:date,meetingtype:meetingtype,flag:flag,comments:comments};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + date+ "</td><td>"+ viewname +"</td><td>"+ viewtype +"</td><td>"+ flag +"</td><td>"+ comments +"</td></tr>";
  $("table tbody").append(markup);
});

//----------vv------saving the mailing list ----------
//saveMailingList
$('.saveMailingList').click(function (e) {
  //alert ("clicked");
  e.preventDefault();
  
  data = $('saveMailingListForm').serialize()
  var selectedParticipantsArray = []; 

  $('#lstBox2 option').each(function() {
    selectedParticipantsArray.push($(this).val());
            //console.log("vals: " + $(this).val());
          });
  var formData = {
    'MailingListName'              : $('input[name=MailingListName]').val(),
    'selectedParticipants'             : selectedParticipantsArray,
    '_token'    : $('input[name=_token]').val()


  };


        //console.log($("#lstBox2").val());
        //console.log($("#lstBox1").val());
        //var selectedOpts = $('#lstBox2 option:selected');
        // console.log( selectedOpts );
        console.log(selectedParticipantsArray)
        
        console.log(formData); 

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'saveparticipantlist', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data); 
                window.location.href= '../mailinglist';
                
              })
            .fail(function(response) {

                // log data to the console so we can see
                console.log(response.responseText); 

                // here we will handle errors and validation messages
              });

        // stop the form from submitting the normal way and refreshing the page
        //////event.preventDefault();
        //return ff json for redirection: {"redirect":true,"redirect_url":"https://example.com/go/to/somewhere.html"}
        //success: function (response) {
    // redirect must be defined and must be true. In the ajax in .done/.success, use:
      /*  if (response.redirect !== undefined && response.redirect) {
                  window.location.href = response.redirect_url;
              }
          }
          */
        });

$('.markcellattendance').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'markcellattendance', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {

    console.log(data);
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
    alert("Members Records Submitted");     
    if (response.url != "") {
      window.location.href = response.url;
    }
  })
  .fail(function(response) {
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
    });
  });
});

$('.createmembers').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createmembers', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Members Records Submitted");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('.createclassmembers').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createclassmembers', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      alert("Members Records Submitted");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nClass Name: ' + response.person[i].classname + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('.createsoulmembers').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsoulmembers', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Members Records Submitted");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('.creatememberstop').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 

  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'creatememberstop', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      alert("Members Records Submitted");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('.createsoulmemberstop').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 

  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsoulmemberstop', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      alert("Members Records Submitted");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('.createmeeting').click(function (e) {
  e.preventDefault();
  if ($("#inviteall").prop('checked')==true){
   var fdate = $("#datepicker2").val();
   if (fdate == "") {
    alert("Date field is required");
    return;
  }
  var name = $("#Meeting_Name").val();
  if (name == "") {
    alert("Meeting name field is required");
    return;
  }
  var time = $("#Meeting_Time").val();
  if (time == "") {
    alert("time field is required");
    return;
  }

  var titles = $("#titles").val();
  
  if (titles == null) {
    alert("Participants Title field is required");
    return;
  }

  if (titles.length < 1) {
    alert("Participants Title field is required");
    return;
  }
  //console.log(titles);
  data = [];

  var person = {date: fdate,Meeting_Time:time,Meeting_Name:name,titles:titles};
  data.push(person);
  console.log("Data is " + data);
  var postfields = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val(),
  };
  console.log("form dtat is " + postfields);
  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createmeetingall', // the url where we want to POST
            data        : postfields, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
   data = [];
   
   $('form').find("input[type=text], textarea").val("");
   console.log(response);
   $("table tbody").find('input[name="record"]').each(function(index,value){
    $(this).parents("tr").remove();
  });     
   alert("Meeting Records Submitted");
 })
  .fail(function(response) {
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){
      $(this).parents("tr").remove();
    });
  });
} else {
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createmeeting', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(data) {


    console.log(data);
    $('form').find("input[type=text], textarea").val("");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });     alert("Meeting Records Submitted");
  })
  .fail(function(response) {

    console.log(data);
    console.log(response.responseText); 
    alert("Error");
  });
}
});


$('.billduesubmit').click(function (e) {
  e.preventDefault();
  if ($("#billallmembers").prop('checked')==true){
   var fdate = $("#datepicker").val();
   if (fdate == "") {
    alert("Date field is required");
    return;
  }
  var comments = $("#comments").val();

  var amount = $("#amount").val();
  if (amount == "") {
    alert("Amount to bill field is required");
    return;
  }

  var duestype = $("#duestype").val();
  if (duestype == "") {
    alert("Duestype field is required");
    return;
  }

  data = [];

  var person = {date: fdate,comments:comments,amount:amount,duestype:duestype};
  data.push(person);
  console.log("Data is " + data);
  var postfields = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val(),
  };
  console.log("form dtat is " + postfields);
  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'billduesall', // the url where we want to POST
            data        : postfields, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {

   if (response.message == "correct") {
   	$('form').find("input[type=text], select").val("");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });     alert("Dues Records Submitted");
  }
})
  .fail(function(response) {

    console.log(data);
    console.log(response); 
    alert("Error");

  });
} else {
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'billdues', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {

   if (response.message == "correct") {
   	$('form').find("input[type=text], select").val("");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });     alert("Dues Records Submitted");
  }

})
  .fail(function(response) {

    console.log(data);
    console.log(response.responseText); 
    alert("Error");

  });
}
});


$('.duespayment').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 

  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'duespayment', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      alert("Members Records Submitted");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});



$('#markattendance').click(function (e) {
  e.preventDefault();
 // alert(1);
 if (data.length < 1) {
  alert("Please Add Records");
  return;
}
var formData = {

  'data'      : {data:data},
  '_token'    : $('input[name=_token]').val()
};
console.log(formData); 
data = new Array;
console.log(data);

$.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'markattendance', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
.done(function(data) {
  alert("Meeting Records Submitted");
  console.log(data);
  $("table tbody").find('input[name="record"]').each(function(index,value){

    $(this).parents("tr").remove();
    data = [];

  });     
})
.fail(function(response) {
  console.log(data);
  console.log(response.responseText); 
  alert("Error");
});
});

$('.createmembertype').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };

  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createmembertype', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {

    alert("Member Types Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();


    });
  });
});

$('.createtitle').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };

  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'titlecreate', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {

    alert("Title Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();


    });
  });
});

$('.createmeetingtype').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };

  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createmeetingtype', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {

    alert("Meeting Type Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();


    });
  });
});

$('.createposition').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  

  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()


  };

  console.log(formData); 
  data = new Array;
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'positioncreate', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {
    var data = [];
    alert("Position Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    console.log(response.responseText); 
    var data = [];
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
  });
});

$('.createzoneposition').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  

  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()


  };
  data = new Array;
  console.log(data);
  console.log(formData); 

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'positioncreate', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(response) {
   data = [];
   alert("Position Records Submitted");
   $("table tbody").find('input[name="record"]').each(function(index,value){

    $(this).parents("tr").remove();
    data = [];

  });

 })
  .fail(function(response) {
   data = [];
   console.log(response.responseText); 
   alert("Error");
   $("table tbody").find('input[name="record"]').each(function(index,value){

    $(this).parents("tr").remove();
    data = [];

  });
 });
});

$('.createareaposition').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  

  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()


  };
  data = new Array;
  console.log(data);
  console.log(formData); 

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'positioncreate', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {

    alert("Position Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
  });
});

$('.createleader').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  

  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()


  };
  data = new Array;
  console.log(data);
  console.log(formData); 

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'leaderscreate', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })

  .done(function(data) {

    alert("Leader Records Submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });

  })
  .fail(function(response) {
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
  });
});

$('.submitstatsdata').click(function (e) {
  e.preventDefault();
  if (data.length == 0) {
    alert("No data added");
    return;
  }
  console.log(data);
  var formData = {data:data};
  data = new Array;
  console.log(data);
  console.log(formData)
  $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitstatsdata', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })
  .done(function(data) {
    alert("submitted");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
    console.log(data); 
  })
  .fail(function(response) {
    alert(response.responseText);
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
      data = [];

    });
    console.log(response.responseText); 
  });
});

$('.submitstats').click(function (e) {
  e.preventDefault();
  if (data.length == 0) {
    alert("No data added");
    return;
  }
  //alert('am verified');
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  $("#save").hide();
  $("#spinner").show();
  $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitstats', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })
  .done(function(response) {
    var res = response;

    if (res.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();

     });     
      $(this).closest('form').find("input[type=text], textarea").val("");
      data = [];
      data = new Array;
      $("#save").show();
      $("#spinner").hide();
      alert('Records Submitted');return;
      
      
    }else if(res.message == "exists"){
     $("#save").show();
     $("#spinner").hide();

     alert(res.details);
   }
 })
  .fail(function(response) {
    alert("Error Occured");
    $("#spinner").hide();
    $("#save").show();

  });
});

$('.submitstatsauto').click(function (e) {
  e.preventDefault();
  if (data.length == 0) {
    alert("No data added");
    return;
  }
  //alert('am verified');
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  $("#save").hide();
  $("#spinner").show();
  $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitstatsauto', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })
  .done(function(response) {
    var res = response;

    if (res.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();

     });     
      $(this).closest('form').find("input[type=text], textarea").val("");
      data = [];
      data = new Array;
      $("#save").show();
      $("#spinner").hide();
      alert('Records Submitted');return;
      
      
    }else if(res.message == "exists"){
     $("#save").show();
     $("#spinner").hide();

     alert(res.details);
   }
 })
  .fail(function(response) {
    alert("Error Occured");
    $("#spinner").hide();
    $("#save").show();

  });
});


$('.submitfinance').click(function (e) {
  e.preventDefault();
  if (data.length == 0) {
    alert("No data added");
    return;
  }
  var formData = {data:data};
  data = new Array;
  console.log(data);
  $("#save").hide();
  $("#spinner").show();        
  $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitfinance', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })

  .done(function(response) {
    var res = response;
    if (res.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();

     });     
      $('form').find("input[type=text],input[type=number], select").val("");
      data = [];
      data = new Array;
      $("#save").show();
      $("#spinner").hide();
      alert('Records Submitted');return;
      
      
    }else if(res.message == "exists"){
     $("#save").show();
     $("#spinner").hide();

     alert(res.details);
   }else if(res.message == "donationexists"){
     $("#save").show();
     $("#spinner").hide();

     alert(res.details);
     /*confirming*/
     if(confirm('donation exists')){
       $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitfinancedonationsave', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
          })

       .done(function(response) {}).fail(function(response) {
         $("#spinner").hide();
         $("#save").show();
         alert("Error Occured");
       });
     }
     /*confirming end*/
   }
 })
  .fail(function(response) {
   $("#spinner").hide();
   $("#save").show();
   alert("Error Occured");
 });
});

$("#addoutreach").click(function(){
  var fdate = $("#datepicker2").val();
  if (fdate == "") {
    alert("Date field is required");
    return;
  }
  var activitytype = $("#activitytype").val();
  if (activitytype == "") {
    alert("Activitytype field is required");
    return;
  }
  var activitytypename = $("#activitytype").find("option:selected").text();

  var member = $("#member").val();
  if (member[0] == "" ) {
    member.splice(0,1);
    return;
  }else{
    alert(1);
  }
  var membername = $("#member").find("option:selected").text();
  console.log(member);
  var visitor = $("#visitor").val();
          /*if (visitor == "") {
            alert("visitor field is required");
            return;
          }*/
          var visitorname = $("#visitor").find("option:selected").text();

          var status = $("#status").val();
          if (status == "") {
            alert("Status field is required");
            return;
          }

          var comments = $("#comments").val();
          

          var person = {date: fdate,status:status, activitytype:activitytype, member:member,visitor:visitor,comments:comments};
          data.push(person);
          console.log(data);
          var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + membername + "</td><td>" + visitorname + "</td><td>" +activitytypename+"</td><td>" +status+ "</td><td>" +comments+ "</td></tr>";
          $("table tbody").append(markup);
        });

$("#addsoulswon").click(function(){
  var fdate = $("#datepicker2").val();
  if (fdate == "") {
    alert("Date field is required");
    return;
  }


  var member = $("#member").val();
  if (member == "") {
    alert("Member field is required");
    return;
  }
  var membername = $("#member").find("option:selected").text();
  console.log(member);

  var visitor = $("#visitor").val();
  if (visitor == "") {
    alert("Visitor field is required");
    return;
  }
  var visitorname = $("#visitor").find("option:selected").text();

  var activitytype = $("#activitytype").val();
  if (activitytype == "") {
    alert("activitytype field is required");
    return;
  }
  var activitytypename = $("#activitytype").find("option:selected").text();        

  var to = $("#to").val();
  if (activitytypename == "Bussing") {
    if (to == "") {
      alert("to field is required");
      return;
    }
  }
  var toname = $("#to").find("option:selected").text();

  var comments = $("#comments").val();
  var status = $("#status").val();


  var person = {date: fdate,member:member,comments:comments,visitor:visitor,activitytype:activitytype,status:status,to:to};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + fdate + "</td><td>" + membername + "</td><td>" + visitorname + "</td><td>" +activitytypename+"</td><td>" +status+ "</td><td>" +comments+ "</td></tr>";
  $("table tbody").append(markup);
});


$('.createsoulswon').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsoulswon', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      $(this).closest('form').find("input[type=text],select, textarea").val("");
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      alert("Members Records Submitted");
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Activity Exists \n\r \n\rName: ' + response.person[i].name+ '\nDate: '+ response.person[i].date +'\nActivity: ' + response.person[i].activitytype + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


$("#inviteall").on("click",function(){

  if ($(this).prop('checked')==true){ 
    tempo = [];
    tempo = data;

    $(".titles").show();
    $("#addmeeting").hide();
    $(".leaderform").hide();
    $(".meetingpanel").hide();
    console.log($("#titles").val());
  }  else {
    $(".titles").hide();
    $("#addmeeting").show();
    $(".leaderform").show();
    $(".meetingpanel").show();
    data = [];
    data = tempo;
  }
});

$("#paymentmode").change(function(){
  var title = $('#paymentmode').val();
    //alert(title);
    if (title == "1") {
      $('.bank').show();
      $('.cheque').hide();
    }else if (title == "3"){
      $('.bank').hide();
      $('.cheque').hide();
    }else {
      $('.bank').hide();
      $('.cheque').hide();
    }
  });

$("#billallmembers").on("click",function(){

  if ($(this).prop('checked')==true){ 
    tempo = [];
    tempo = data;

   // $("#comments").hide();
   $(".tohide").hide();

 }  else {
  $(".tohide").show();
  data = [];
  data = tempo;
}
});

$("#addbusroute").click(function(){
  var route = $("#comments").val();
  if (route == "") {
    alert("Route field is required");
    return;
  }

  var person = {route:route};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + route + "</td></tr>";
  $(this).closest('form').find("input[type=text],select, textarea").val("");
  $("table tbody").append(markup);
});

$("#addclasses").click(function(){
  var classes = $("#classname").val();
  if (classes == "") {
    alert("Class field is required");
    return;
  }

  var person = {classname:classes};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + classes + "</td></tr>";
  $(this).closest('form').find("input[type=text],select, textarea").val("");
  $("table tbody").append(markup);
});

$("#addsoultype").click(function(){
  var name = $("#soultypename").val();
  if (name == "") {
    alert("Name field is required");
    return;
  }

  var person = {name:name};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td></tr>";
  $(this).closest('form').find("input[type=text],select, textarea").val("");
  $("table tbody").append(markup);
});

$('.createbusroute').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createbusroute', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
     $("Form").find("input[type=text],select, textarea").val("");
     $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();
     });     
     data = [];
     data = new Array;
     alert("Bus route Records Submitted");
     return;
   }else if(response.message == "exists"){
    for (var i = 0; i <= response.person.length; i++) {
      alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
    }
  }
})
  .fail(function(response) {
    console.log(data);
    console.log(response); 
    alert("Error");
  });
});


$('.createclasses').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createclasses', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
     $("Form").find("input[type=text],select, textarea").val("");
     $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();
     });     
     data = [];
     data = new Array;
     alert("Class Records Submitted");
     return;
   }else if(response.message == "exists"){
    for (var i = 0; i <= response.person.length; i++) {
      alert('Class Exists \n\rName: ' + response.person[i].classname + "\r\n");
    }
  }
})
  .fail(function(response) {
    console.log(data);
    console.log(response); 
    alert("Error");
  });
});

$('.createsoultype').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsoultype', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
     $("Form").find("input[type=text],select, textarea").val("");
     $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();
     });     
     data = [];
     data = new Array;
     alert("Class Records Submitted");
     return;
   }else if(response.message == "exists"){
    for (var i = 0; i <= response.person.length; i++) {
      alert('Class Exists \n\rName: ' + response.person[i].name + "\r\n");
    }
  }
})
  .fail(function(response) {
    console.log(data);
    console.log(response); 
    alert("Error");
  });
});

$("#addpickuplocation").click(function(){
  var route = $("#comments").val();
  if (route == "") {
    alert("Pickup location field is required");
    return;
  }

  var busroute = $("#busroute").val();
  if (busroute == "") {
    alert("Busroute field is required");
    return;
  }
  var busname = $("#busroute").find('option:selected').text();

  var person = {pickuplocation:route,busroute:busroute};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + route + "</td><td>" + busname + "</td></tr>";
  $(this).closest('form').find("input[type=text],select, textarea").val("");
  $("table tbody").append(markup);
});

$('.createpickuplocation').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {
    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createpickuplocation', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
     $("Form").find("input[type=text],select, textarea").val("");
     $("table tbody").find('input[name="record"]').each(function(index,value){
       $(this).parents("tr").remove();
     });     
     data = [];
     data = new Array;
     alert("Pickuplocation Records Submitted");
     return;
   }else if(response.message == "exists"){
    for (var i = 0; i <= response.person.length; i++) {
      alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
    }
  }
})
  .fail(function(response) {
    console.log(data);
    console.log(response); 
    alert("Error");
  });
});
//-------------------------------add own functions above this ---
//do not edit
$("#declineprocess").on("click",function(){
	$(".hide-comment").fadeIn("fast");
	
});

$("#Hidebox").on("click",function(){
	$(".hide-comment").fadeOut("fast");
	
});


/*starting school info*/
  $('#student').change(function(){
    var student = $("#student").val();
    console.log(student);
  var formData = {
    'student'      : student,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentclass').prop('disabled', true);
  console.log(formData); 
  

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getstudentclassess', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/
            var opt = response.details;
        if (2==2) {
          $('#studentclass')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentclass').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentclass').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



  $('#studentPrevious').change(function(){
    var studentPrevious = $("#studentPrevious").val();
    console.log(studentPrevious);
  var formData = {
    'studentPrevious'      : studentPrevious,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentclass').prop('disabled', true);
  console.log(formData); 
  

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getstudentclassessPrevious', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/
            var opt = response.details;
        if (2==2) {
          $('#studentclass')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentclass').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentclass').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
  // end get class search

$("#addparent").click(function(){
  var name = $("#parentname").val();
  if (name == "") {
    alert("Parent name field is required");
    return;
  }
  var phone = $("#parentphonenumber").val();
  if (phone == "") {
    alert("Phone field is required");
    return;
  }
  var children = $("#parentchildren").val();
  if (children == "") {
    alert("Children field is required");
    return;
  }
  console.log(children);
  var displaychildren = $("#parentchildren").find('option:selected').text();
  var person = {name:name, phone:phone, children:children};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + phone + "</td><td>" + displaychildren + "</td></tr>";
  $("table tbody").append(markup);
});






$('.createparent').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createparent', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Parent Saved Successfully");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

// $("#addteacher").click(function(){
//   var name = $("#teachername").val();
//   if (name == "") {
//     alert("Teacher Name field is required");
//     return;
//   }
//   var phone = $("#teacherphonenumber").val();
//   if (phone == "") {
//     alert("Phone field is required");
//     return;
//   }
//   var children = $("#teacherclass").val();
//   if (children == "") {
//     alert("Class field is required");
//     return;
//   }
//   console.log(children);
//   var displaychildren = $("#teacherclass").find('option:selected').text();
//   var person = {name: name, phone:phone, children:children};
//   data.push(person);
//   console.log(data);
//   var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + phone + "</td><td>" + displaychildren + "</td></tr>";
//   $("table tbody").append(markup);
// });

$("#addteacher").click(function(){
  var name = $("#teachername").val();
  if (name == "") {
    alert("Teacher Name field is required");
    return;
  }
  // var phone = $("#teacherphonenumber").val();
  // if (phone == "") {
  //   alert("Phone field is required");
  //   return;
  // }
  var children = $("#teacherclass").val();
  if (children == "") {
    alert("Class field is required");
    return;
  }

   var subject = $("#teachersubject").val();
  if (subject == "") {
    alert("Subject field is required");
    return;
  }

  var displaychildren = $("#teacherclass").find('option:selected').text();
  console.log(children);

  var displayteacher = $("#teachername").find('option:selected').text();
  console.log(teachername);
  
  var displaysubjects = $("#teachersubject").find('option:selected').text();  
  console.log(subject);

  var person = {name:name,children:children,subject:subject};
  data.push(person);
  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + displayteacher + "</td><td>"+ displaychildren + "</td><td>" + displaysubjects+ "</td></tr>";
  $("table tbody").append(markup);
});


$('.createteacher').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createteacher', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
     alert("Teacher Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Teacher Record Already Exist \n\rTeacher Name: ' + response.person[i].TeacherSetupName +'\nClass Name: ' + response.person[i].ClassName +'\nSubject Name: ' + response.person[i].SubjectName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


$("#adduser").click(function(){
  var name = $("#name").val();
  if (name == "") {
    alert("Name field is required");
    return;
  }

   var nameParentTeacher = $("#nameParentTeacher").val();
  if (nameParentTeacher == "") {
    alert("Parent name field is required");
    return;
  }
  

 var email = $("#useremail").val();
  if (email == "") {
    alert("Email field is required");
    return;
  }

    var password = $("#password").val();
  if (password == "") {
    alert("password field is required");
    return;
  }

 var password2 = "";

  var PhoneNo = $("#PhoneNo").val();
  if (PhoneNo == "") {
    alert("PhoneNo field is required");
    return;
  }
   
    var parentchildren = $("#parentchildren").val();
  if (parentchildren == "") {
    alert("Children field is required");
    return;
   }

  var UserLevelID = $("#UserLevelID").val();
  if (UserLevelID == "") {
    alert("User Level field is required");
    return;
  }

  

  var classteacher = $("#classteacher").val();
  if (classteacher == "") {
    alert("Class Name field is required");
    return;
  }
 
 $(document).ready(function (){
    $('#password').change(function (){
        $('.form-control.hidden').removeclass('hidden');
    });
});



  console.log(parentchildren);
  var displaychildren = $("#parentchildren").find('option:selected').text();

  console.log(nameParentTeacher);
  var displayName = $("#nameParentTeacher").find('option:selected').text();

  

  var userlevel = $("#UserLevelID").find('option:selected').text();

  var person = {name:name, nameParentTeacher:nameParentTeacher,email:email,PhoneNo:PhoneNo,UserLevelID:UserLevelID,classteacher:classteacher,parentchildren:parentchildren};
  data.push(person);
  
  $(this).closest('form').find("input[type=text],select, textarea").val("");

  console.log(data);
  var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name+"</td><td>"+email+"</td><td>" +userlevel+"</td><td>"+classteacher+ "</td><td>" +displayName+ "</td><td>" +displaychildren+ "</td><td>"+ password2 + "</td></tr>";
  // var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + phone + "</td><td>" +PhoneNo+ "</td><td>"+UserLevelID+ "</td><td>"+displaychildren+ "</td></tr>";

  $("table tbody").append(markup);
});





$("#addclassinfo").click(function(){
  var classid = $("#classid").val();
    if (classid == "") {
      alert("Class Name field is required");
      return;
    }

    var classname = $("#classid").find("option:selected").text();
     console.log(classid);

    
    var onroll = $("#onroll").val();
     if (onroll == "") {
       alert("Number on Roll field is required");
       return;
     }

    var begindate = $("#datepicker").val();
    if (begindate == "") {
      alert("Begin Date field is required");
      return;
    }

    var closedate = $("#datepicker2").val();
    if (closedate == "") {
      alert("Close Date field is required");
      return;
    }

    // var year = $("#year").val();
    // if (year == "") {
    //   alert(" Year field is required");
    //   return;
    // }

    //  var term = $("#term").val();
    // if (term == "") {
    //   alert(" Term field is required");
    //   return;
    // }

    // var termName = $("#term").find("option:selected").text();
    //  console.log(term);

    //  var schoolcode = $("#schoolcode").val();
    // if (schoolcode == "") {
    //   alert(" School Code field is required");
    //   return;
    // }

    var person = {classid:classid,onroll:onroll,begindate:begindate,closedate:closedate};
    data.push(person);
  
    
    //$(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    // var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +classname+ "</td><td>"+onroll+ "</td><td>"+begindate+ "</td><td>" +closedate+"</td><td>"+year+"</td><td>" +termName + "</td><td>" ;
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +classname+ "</td><td>"+onroll+ "</td><td>"+begindate+ "</td><td>" +closedate+"</td><td>" ;
    $("table tbody").append(markup);
  });


$('.createclassinfo').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createclassinfo', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;
      alert("Class Information Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Class Information Exists \n\r\n\rClass Name: ' + response.person[i].ClassName +'\nTerm Name: ' + response.person[0].TermName+ "\r\n");
        // alert('Class Exists \n\rClass Name: ' + response.UserEmailUser[i].ClassName +'\nSchool Name: ' + response.UserEmailUser[i].Name + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


$("#addterminalscore").click(function(){
  // var year = $("#year").val();
  //   if (year == "") {
  //     alert("Year field is required");
  //     return;
  //   }

  //   var term = $("#term").val();
  //    if (term == "") {
  //      alert("Term field is required");
  //      return;
  //    }

    var Class = $("#Class").val();
    if (Class == "") {
      alert("Class field is required");
      return;
    }

    var classname = $("#Class").find("option:selected").text();
     console.log(Class);

    var studentname = $("#studentname").val();
    if (studentname == "") {
      alert("Student Name field is required");
      return;
    }

     var NameOfStudent = $("#studentname").find("option:selected").text();
     console.log(studentname);

    var subjectname = $("#subjectname").val();
    if (subjectname == "") {
      alert(" Subject field is required");
      return;
    }

     var NameOfSubject = $("#subjectname").find("option:selected").text();
     console.log(subjectname);

     var classscore = $("#classscore").val();
    if (classscore == "") {
      alert(" Class Score field is required");
      return;
    }

     var examscore = $("#examscore").val();
    if (examscore == "") {
      alert(" Exam Score field is required");
      return;
    }

    //  var position = $("#position").val();
    // if (position == "") {
    //   alert(" Position field is required");
    //   return;
    // }
    

    //  var remarks = $("#remarks").val();
    // if (remarks == "") {
    //   alert(" Remarks field is required");
    //   return;
    // }


    var person = {Class:Class,studentname:studentname,subjectname:subjectname,classscore:classscore,examscore:examscore};
    data.push(person);
  
    
    // $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +classname+ "</td><td>" +NameOfStudent+"</td><td>"+NameOfSubject+"</td><td>" +classscore + "</td><td>" + examscore +"</td><td>" ;
    $("table tbody").append(markup);
  });


// $('.createterminalscore').click(function (e) {
//   e.preventDefault();
//   if (data.length < 1) {
//     alert("Please Add Records");
//     return;
//   }
//   var formData = {

//     'data'      : {data:data},
//     '_token'    : $('input[name=_token]').val()
//   };
//   console.log(formData); 
  
//   console.log(data);

//   $.ajax({
//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'createterminalscore', // the url where we want to POST
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server
//             encode      : true
//           })
//   .done(function(response) {
//     alert("Terminal Score Saved Successfully");
//     console.log(response);
//     if (response.message == "correct") {
//       $("table tbody").find('input[name="record"]').each(function(index,value){

//        $(this).parents("tr").remove();


//      });     
//       data = [];
//       data = new Array;
//       return;
//     }else if(response.message == "exists"){
//       for (var i = 0; i <= response.person.length; i++) {
//         alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
//       }
//     }

//   })
//   .fail(function(response) {
//     console.log(data);
//     console.log(response.responseText); 
//     alert("Error");
    
//   });
// });

$('.createterminalscore').click(function (e) {

  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createterminalscore', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
     alert("Terminal Score Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmailUser.length; i++) {
        alert('Subject Exists For This Student \n\rSubject Name: ' + response.UserEmailUser[i].SubjectName +'\nStudent Name: ' + response.UserEmailUser[i].StudentName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

$('#Class').change(function(){

    var Class = $("#Class").val();
    console.log(Class);
  var formData = {
    'Class'      : Class,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentname').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getStudentClass', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#studentname')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentname').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentname').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#Class').change(function(){

    var Class = $("#Class").val();
    console.log(Class);
  var formData = {
    'Class'      : Class,
    '_token'    : $('input[name=_token]').val()
  };

  $('#subjectname').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getSubjects', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#subjectname')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#subjectname').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#subjectname').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#ClassofStudent').change(function(){

    var ClassofStudent = $("#ClassofStudent").val();
    console.log(ClassofStudent);
  var formData = {
    'ClassofStudent'      : ClassofStudent,
    '_token'    : $('input[name=_token]').val()
  };

  $('#studentnameA').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getClassofStudent', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#studentnameA')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#studentnameA').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#studentnameA').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



// $('#ClassAdmin').change(function(){

//     var ClassAdmin = $("#ClassAdmin").val();
//     console.log(ClassAdmin);
//   var formData = {
//     'ClassAdmin'      : ClassAdmin,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#subjectname').prop('disabled', true);
//   console.log(formData);   
 
//   $.ajax({

//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getSubjectsAdmin', // the url where we want to POST        
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server        
//             encode : true
//           }).done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//             var opt = response.details;
//         if (2==2) {
//           $('#subjectname')
//           .find('option')
//           .remove()
//           .end();

//             $.each(opt, function(key, value) {   
//              $('#subjectname').append($("<option></option>").attr("value",key).text(value)); 
//             //  alert(key);
//            }); 
//        }
//       /*end populate  class field*/
          
    
//       $('#subjectname').prop('disabled', false);
//      return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });


$("#addstudentbehaviour").click(function(){
  // var year = $("#year").val();
  //   if (year == "") {
  //     alert("Year field is required");
  //     return;
  //   }

  //   var term = $("#term").val();
  //    if (term == "") {
  //      alert("Term field is required");
  //      return;
  //    }

    // var TermName = $("#term").find("option:selected").text();
    //  console.log(term);

    var ClassofStudent = $("#ClassofStudent").val();
    if (ClassofStudent == "") {
      alert("Class field is required");
      return;
    }

    var classname = $("#ClassofStudent").find("option:selected").text();
     console.log(ClassofStudent);

    var studentname = $("#studentnameA").val();
    if (studentname == "") {
      alert("Student Name field is required");
      return;
    }

     var NameOfStudent = $("#studentnameA").find("option:selected").text();
     console.log(studentname);

    // var PromotedTo = $("#PromotedTo").val();
    

     // var promotedto = $("#PromotedTo").find("option:selected").text();
     // console.log(PromotedTo);

     var AttendanceExpected = $("#AttendanceExpected").val();
    if (AttendanceExpected == "") {
      alert(" Attendance Expected field is required");
      return;
    }

     var ActualAttendance = $("#ActualAttendance").val();
    if (ActualAttendance == "") {
      alert(" Actual Attendance field is required");
      return;
    }

     var Interest = $("#Interest").val();
    if (Interest == "") {
      alert(" Interest field is required");
      return;
    }
    

     var CharacterOfStu = $("#CharacterOfStu").val();
    if (CharacterOfStu == "") {
      alert(" Conduct field is required");
      return;
    }


     var ClassTeacherRemarks = $("#ClassTeacherRemarks").val();
    if (ClassTeacherRemarks == "") {
      alert(" Class Teachers Remarks field is required");
      return;
    }

    var HeadTeacherRemarks = $("#HeadTeacherRemarks").val();
    if (HeadTeacherRemarks == "") {
      alert(" Head Teacher Remarks field is required");
      return;
    }


    var person = {ClassofStudent:ClassofStudent,studentname:studentname,AttendanceExpected:AttendanceExpected,ActualAttendance:ActualAttendance,Interest:Interest,CharacterOfStu:CharacterOfStu,ClassTeacherRemarks:ClassTeacherRemarks,HeadTeacherRemarks:HeadTeacherRemarks};
    data.push(person);
  
    
    // $(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +classname+ "</td><td>" +NameOfStudent+"</td><td>" +AttendanceExpected + "</td><td>" + ActualAttendance + "</td><td>"+ Interest + "</td><td>"+ CharacterOfStu + "</td><td>"+ClassTeacherRemarks + "</td><td>"+HeadTeacherRemarks + "</td><td>";
    $("table tbody").append(markup);
  });


$('.createstudentbehaviour').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    bootbox.alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createstudentbehaviour', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;

      bootbox.alert("Student Behaviour Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmailUser.length; i++) {
        bootbox.alert('Behaviour For This Student Exit<br> \n\rStudent Name: ' + response.UserEmailUser[i].StudentName +'<br>\nClass: ' + response.UserEmailUser[i].ClassName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});



$("#addyeartermsetup").click(function(){
  var year = $("#yearsetup").val();
    if (year == "") {
      alert("Year field is required");
      return;
    }

    var Yearsetup2 = $("#yearsetup").find("option:selected").text();
     console.log(yearsetup);

    var term = $("#termsetup").val();
     if (term == "") {
       alert("Term field is required");
       return;
     }

     var SchoolCode = $("#schoolcode").val();
     if (SchoolCode == "") {
       alert("Term field is required");
       return;
     }

     var Termsetup2 = $("#termsetup").find("option:selected").text();
     console.log(termsetup);

     var SchoolNameShow = $("#schoolcode").find("option:selected").text();
     console.log(SchoolCode);


    var person = {year:year,term:term,SchoolCode:SchoolCode};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +year+ "</td><td>"+Termsetup2+ "</td><td>"+SchoolNameShow+ "</td><td>";
    $("table tbody").append(markup);
  });


$('.createyeartermsetup').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createyeartermsetup', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
   
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;

       alert("Year/Term Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.yeartermsetup.length; i++) {
        alert('Selected School Has Been Setup Already \n\rSchool Name: ' + response.yeartermsetup[i].Name +'\nTerm Name: ' + response.yeartermsetup[i].TermName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});




$("#addsubject").click(function(){
  var subjectname = $("#subjectname").val();
    if (subjectname == "") {
      alert("Subject Name field is required");
      return;
    }

    var subjectnamedisplay = $("#subjectname").find("option:selected").text();
    console.log(subjectname);

    
    var classID = $("#classid").val();
     if (classID == "") {
       alert("Class Name field is required");
       return;
     }

   var classname = $("#classid").find("option:selected").text();
     console.log(classid);

   
    // var schoolcode = $("#schoolcode").val();
    // if (schoolcode == "") {
    //   alert("Begin Date field is required");
    //   return;
    // }

  
    var person = {subjectname:subjectname,classID:classID};
    data.push(person);
  
    //$(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +subjectnamedisplay+ "</td><td>"+classname+"</td><td>" ;
    $("table tbody").append(markup);
  });


$('.createsubject').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createsubject', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Subject Saved Successfully");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});



$("#addterm").click(function(){
  var termid = $("#termid").val();
    if (termid == "") {
      bootbox.alert("Enter Term Name");
      return;
    }

    // var classname = $("#classid").find("option:selected").text();
    //  console.log(classid);

    
    // var schoolcode = $("#schoolcode").val();
    //  if (schoolcode == "") {
    //    alert("Class Name field is required");
    //    return;
    //  }

  
    var person = {termid:termid};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +termid+ "</td><td>";
    $("table tbody").append(markup);
  });


$('.createterm').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    bootbox.alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createterm', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      // return;
      
     bootbox.alert("Term Has Been Saved Successfully", function(response){console.log('jjh');});
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmailUser.length; i++) {
        bootbox.alert('Term Name Exists<br> \n\rTerm Name: ' + response.UserEmailUser[i].TermName +'<br>\nSchool Name: ' + response.UserEmailUser[i].Name + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});



$("#addstudent").click(function(){
  var studentnames = $("#studentnames").val();
    if (studentnames == "") {
      alert("student Name field is required");
      return;
    }

    
    var classnameID = $("#classnameID").val();
    if (classnameID == "") {
      alert("Class Name field is required");
      return;
    }

    var gender = $("#gender").val();
    if (gender == "") {
      alert("Gender field is required");
      return;
    }

    var dob = $("#datepicker").val();
    if (dob == "") {
      alert("Date Of Birth field is required");
      return;
    }

     var className2 = $("#classnameID").find("option:selected").text();
     console.log(classnameID);


     var parentnumber = $("#parentnumber").val();
     if (parentnumber == "") {
       alert("Parent Number field is required");
       return;
     }

     var parentname = $("#parentname").val();
     if (parentname == "") {
       alert("Parent Name field is required");
       return;
     }

     

     // var year = $("#year").val();
     // if (year == "") {
     //   alert("Year field is required");
     //   return;
     // }

       var imgInp = $("#imgInp").val();
     if (imgInp == "") {
       alert("Image field is required");
       return;
     }

        var className55 = $("#imgInp").find("option:selected").text();
     console.log(imgInp);

     // var term = $("#term").val();
     // if (term == "") {
     //   alert("Term field is required");
     //   return;
     // }

     // var termname = $("#term").find("option:selected").text();
     // console.log(term);

    // var schoolcode = $("#schoolcode").val();
    //  if (schoolcode == "") {
    //    alert("SchoolCode field is required");
    //    return;
    //  }

  
    var person = {studentnames:studentnames,gender:gender,dob:dob,classnameID:classnameID,parentname:parentname,parentnumber:parentnumber,imgInp:imgInp};
    data.push(person);
   
    //$(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +studentnames+ "</td><td>"+gender+ "</td><td>"+dob+ "</td><td>"+className2+ "</td><td>"+parentname+ "</td><td>"+parentnumber+ "</td><td>" ;
    $("table tbody").append(markup);
  });


$('.createstudent').click(function (e) {

  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createstudent', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Student Saved Successfully");
    console.log(response);
    if (response.message == "correct") {
      $("table tbody").find('input[name="record"]').each(function(index,value){

       $(this).parents("tr").remove();


     });     
      data = [];
      data = new Array;
      return;
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.person.length; i++) {
        alert('Member Exists \n\rName: ' + response.person[i].name +'\nCellName: ' + response.person[i].AssemblyName + "\r\n");
      }
    }

  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});

//// select all checkbox to delete /////
$('#selectAll').click(function(e){

  var table= $(e.target).closest('table');
$('td input:checkbox',table).prop('checked',this.checked);
  });
//// end multiple select checkbox /////

$('.createuser').click(function (e) {
  e.preventDefault();
  if (data.length < 1) {
    alert("Please Add Records");
    return;
  }
  var formData = {

    'data'      : {data:data},
    '_token'    : $('input[name=_token]').val()
  };
  console.log(formData); 
  
  console.log(data);

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'createuser', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    
    console.log(response);
    if (response.message == "correct") {
        $("table tbody").find('input[name="record"]').each(function(index,value){

           $(this).parents("tr").remove();
          

        });     
         data = [];
         data = new Array;
      // return;

      alert("User Saved Successfully");
    }else if(response.message == "exists"){
      for (var i = 0; i <= response.UserEmailUser.length; i++) {
          alert('Email Exists \n\rEmail: ' + response.UserEmailUser[i].email +'\nSchoolCode: ' + response.UserEmailUser[i].SchoolCode + "\r\n");
      }
    }
   
  })
  .fail(function(response) {
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    
  });
});


$(".createyeartermsetup2").click(function (e){
      
   var x=window.confirm("THIS WILL MOVE ALL RELATED TABLES'S RECORDS TO HISTORY")

      if (x)
         return confirm("WOULD YOU LIKE TO CONTINUE? THIS ACTION CANNOT BE REVERSED"); 
      else
        return false;
            window.location = "/terminalreport/public/yeartermsetup";
      
    });


});
