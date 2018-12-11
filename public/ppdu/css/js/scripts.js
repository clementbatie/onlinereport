
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
          $("table tbody").find('input[name="record"]').each(function(index,value){
            if($(this).is(":checked")){    
              $(this).parents("tr").remove();
              data.splice(index,1);
              console.log(data);
            }
          });
        });
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


  $("#addmember").click(function(){
    var name = $("#name").val();
    if (name == "") {
      alert("Company name field is required");
      return;
    }

    var building9 = $("#building9").val();
    if (building9 == "") {
      alert("Building Name field is required");
      return;
    }

     var buildingname = $("#building9").find("option:selected").text();
     console.log(building9);

    var gender = $("#gender").val();
    if (gender == "") {
      alert(" Number required at Company Contact");
      return;
    }


    var comments = $("#comment").val();
    if (comments == "") {
      alert("Contact person field is required");
      return;
    }
    var contact = $("#contact").val();
    if (contact == "") {
      alert(" Locateion Address field is required");
      return;
    }

    var address = $("#address").val();
    if (address == "") {
      alert(" location Address field is required");
      return;
    }

   

    var person = {building9:building9,name:name,gender:gender,comments:comments,contact:contact,address:address};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + buildingname+ "</td><td>" +name +"</td><td>"+ gender+"</td><td>" +comments + "</td><td>" + contact + "</td><td>" + address  + "</td><td>" ;
    $("table tbody").append(markup);
  });


   $("#addbuilding").click(function(){
    var name = $("#name").val();
    if (name == "") {
      alert("Building Name field is required");
      return;
    }

    var location = $("#location").val();
    if (location == "") {
      alert("Location field is required");
      return;
    }


    var description = $("#description").val();
    if (description == "") {
      alert("Building Description field is required");
      return;
    }
  
    var person = {name:name,location:location,description:description};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +name+ "</td><td>" +location+"</td><td>" +description+ "</td><td>";
    $("table tbody").append(markup);
  });



  $("#addjobassign").click(function(){
  var building5 = $("#building5").val();
    if (building5 == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#building5").find("option:selected").text();
     console.log(building5);

    
    var Job_Code7 = $("#Job_Code8").val();
     if (Job_Code7 == "") {
       alert("Job Code field is required");
       return;
     }


     var RequestID = $("#RequestID").val();


     var jobtype = $("#jobtype").val();
    if (jobtype == "") {
      alert("Job Type field is required");
      return;
    }

     var request_typename = $("#jobtype").find("option:selected").text();
     console.log(jobtype);

    var tech = $("#tech").val();
    if (tech == "") {
      alert("Job Assign To field is required");
      return;
    }

     var technician_name = $("#tech").find("option:selected").text();
     console.log(tech);


    var date1 = $("#datepicker").val();
    if (date1 == "") {
      alert("Start Date field is required");
      return;
    }
    var enddate = $("#datepicker2").val();
    if (enddate == "") {
      alert("End Date field is required");
      return;
    }

    var stat = $("#stat").val();
    if (stat == "") {
      alert(" Job Status field is required");
      return;
    }

    var jobstatus = $("#stat").find("option:selected").text();
     console.log(stat);

     var cost = $("#cost").val();
    if (cost == "") {
      alert(" Job Cost field is required");
      return;
    }

     var comment = $("#comment").val();
    if (comment == "") {
      alert(" Comment field is required");
      return;
    }

    var person = {building5:building5,Job_Code7:Job_Code7,RequestID:RequestID,jobtype:jobtype,stat:stat,date1:date1,enddate:enddate,tech:tech ,cost:cost,comment:comment};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+Job_Code7+ "</td><td>"+RequestID+ "</td><td>" +request_typename+"</td><td>"+technician_name+"</td><td>" +date1 + "</td><td>" + enddate + "</td><td>" + jobstatus + "</td><td>"+ cost  + "</td><td>"+ comment  + "</td><td>" ;
    $("table tbody").append(markup);
  });
     

    $("#addexpenses").click(function(){
    var buildingA = $("#buildingA").val();
    if (buildingA == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#buildingA").find("option:selected").text();
     console.log(buildingA);

    var transaction = $("#datepicker1").val();
    if (transaction == "") {
      alert("Transaction Date field is required");
      return;
    }

     // var account = $("#account").val();
    
    var Job_Code = $("#Job_Code2").val();
    if (Job_Code == "") {
      alert("Job Code field is required");
      return;
    }

    var jobtypeB = $("#jobtypeB").val();
    if (jobtypeB == "") {
      alert("Payment Type field is required");
      return;
    }

    var jobtypename = $("#jobtypeB").find("option:selected").text();
     console.log(jobtypeB);

    var mode = $("#mode").val();
    if (mode == "") {
      alert("Payment Mode field is required");
      return;
    }
    var bank = $("#bank").val();  

    var cheque = $("#cheque").val();

     var amount = $("#amount").val();
    if (amount == "") {
      alert(" Provide Number at Amount Paid");
      return;
    }

     var narration = $("#narration").val();
    if (narration == "") {
      alert(" Narration field is required");
      return;
    }

     var voucher = $("#voucher").val();
    if (voucher == "") {
      alert(" Voucher Number field is required");
      return;
    }

    var person = {buildingA:buildingA,transaction:transaction,Job_Code:Job_Code,jobtypeB:jobtypeB,mode:mode,bank:bank,cheque:cheque,amount:amount,narration:narration,voucher:voucher};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+transaction+ "</td><td>"+Job_Code+ "</td><td>" +jobtypename+"</td><td>"+mode+"</td><td>" +  amount+ "</td><td>" +   voucher+ "</td><td>"+  narration+ "</td><td>"+ bank  + "</td><td>"+ cheque + "</td><td>"  ;
    $("table tbody").append(markup);
  });

///// start jobrequest //////


///// General Expenses /////
 
 $("#addgeneral").click(function(){
    var buildingA = $("#buildingA").val();
    if (buildingA == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#buildingA").find("option:selected").text();
     console.log(buildingA);

    var transaction = $("#datepicker1").val();
    if (transaction == "") {
      alert("Transaction Date field is required");
      return;
    }

     // var account = $("#account").val();
    
    // var Job_Code = $("#Job_Code2").val();
    // if (Job_Code == "") {
    //   alert("Job Code field is required");
    //   return;
    // }

    var jobtypeB = $("#jobtypeB").val();
    if (jobtypeB == "") {
      alert("Payment Type field is required");
      return;
    }

    var jobtypename = $("#jobtypeB").find("option:selected").text();
     console.log(jobtypeB);

    var mode = $("#mode").val();
    if (mode == "") {
      alert("Payment Mode field is required");
      return;
    }
    var bank = $("#bank").val();  

    var cheque = $("#cheque").val();

     var amount = $("#amount").val();
    if (amount == "") {
      alert(" Provide Number at Amount Paid");
      return;
    }

     var narration = $("#narration").val();
    if (narration == "") {
      alert(" Narration field is required");
      return;
    }

     var voucher = $("#voucher").val();
    if (voucher == "") {
      alert(" Voucher Number field is required");
      return;
    }

    var person = {buildingA:buildingA,transaction:transaction,jobtypeB:jobtypeB,mode:mode,bank:bank,cheque:cheque,amount:amount,narration:narration,voucher:voucher};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+transaction+"</td><td>" +jobtypename+"</td><td>"+mode+"</td><td>" +  amount+ "</td><td>" +   voucher+ "</td><td>"+  narration+ "</td><td>"+ bank  + "</td><td>"+ cheque + "</td><td>"  ;
    $("table tbody").append(markup);
  });


$('.creategeneral').click(function (e) {
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
            url         : 'creategeneral', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("General Expense Saved Succesfully");
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
//// End General Expenses ///


// $('#buildingA').change(function(){
//     var buildingA = $("#buildingA").val();
//     console.log(buildingA);
//   var formData = {
//     'buildingA'      : buildingA,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#Job_Code2').prop('disabled', true);
//   console.log(formData);   

//   $.ajax({
//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getjobtype_technician3', // the url where we want to POST
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server
//             encode      : true
//           })

//   .done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//             var opt = response.details;
//         if (2==2) {
//           $('#Job_Code2')
//           .find('option')
//           .remove()
//           .end();

//             $.each(opt, function(key, value) {   
//              $('#Job_Code2').append($("<option></option>").attr("value",key).text(value)); 
//             //  alert(key);
//            }); 
//        }
//       /*end populate  class field*/
          
    
//       $('#Job_Code2').prop('disabled', false);
//      return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });


$('#Job_Code').change(function(){
    var Job_Code = $("#Job_Code").val();
    console.log(Job_Code);
  var formData = {
    'Job_Code'      : Job_Code,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobtype').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getjobtype_technician', // the url where we want to POST
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
          $('#jobtype')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobtype').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobtype').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



$('#Job_Code').change(function(){
    var Job_Code = $("#Job_Code").val();
    console.log(Job_Code);
  var formData = {
    'Job_Code'      : Job_Code,
    '_token'    : $('input[name=_token]').val()
  };

  $('#tech').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'gettechnician', // the url where we want to POST
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
          $('#tech')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#tech').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#tech').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#Job_Code7').change(function(){
    var Job_Code7 = $("#Job_Code7").val();
    console.log(Job_Code7);
  var formData = {
    'Job_Code7'      : Job_Code7,
    '_token'    : $('input[name=_token]').val()
  };

  $('#RequestID').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'RequestID', // the url where we want to POST
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
          $('#RequestID')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#RequestID').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#RequestID').prop('disabled', true);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#Job_Code8').change(function(){
    var Job_Code8 = $("#Job_Code8").val();
    console.log(Job_Code8);
  var formData = {
    'Job_Code8'      : Job_Code8,
    '_token'    : $('input[name=_token]').val()
  };

  $('#RequestID').prop('disabled', true);
  console.log(formData);   

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'RequestID2', // the url where we want to POST
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
          $('#RequestID')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#RequestID').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#RequestID').prop('disabled', true);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

 $('#jobcode').change(function(){
    var jobcode = $("#jobcode").val();
    console.log(jobcode);
  var formData = {
    'jobcode'      : jobcode,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobtype').prop('disabled', true);
  console.log(formData); 
  

  $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'RequestID', // the url where we want to POST
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
          $('#jobtype')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobtype').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobtype').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });



 $('#Job_Code2').change(function(){
    var Job_Code2 = $("#Job_Code2").val();
    console.log(Job_Code2);
  var formData = {
    'Job_Code2'      : Job_Code2,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobtypeB').prop('disabled', true);
  console.log(formData);   

  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getExpenses', // the url where we want to POST
           
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#jobtypeB')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobtypeB').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobtypeB').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
///// end jobrequest //////

 /////// income ////////
  $('#building1').change(function(){
    var building1 = $("#building1").val();
    console.log(building1);
  var formData = {
    'building1'      : building1,
    '_token'    : $('input[name=_token]').val()
  };

  $('#floorspace').prop('disabled', true);
  console.log(formData);   

  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getFloorspace', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#floorspace')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#floorspace').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#floorspace').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

   $('#building1').change(function(){
    var building1 = $("#building1").val();
    console.log(building1);
  var formData = {
    'building1'      : building1,
    '_token'    : $('input[name=_token]').val()
  };

  $('#client').prop('disabled', true);
  console.log(formData);   

  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getClient', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#client')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#client').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#client').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
 //////end income ///////


///// start SalaryPayment //////
// $('#building2').change(function(){

//     var building2 = $("#building2").val();
//     console.log(building2);
//   var formData = {
//     'building2'      : building2,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#staff').prop('disabled', true);
//   console.log(formData);   
 
//   $.ajax({

//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getStaff', // the url where we want to POST        
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server        
//             encode : true
//           }).done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//             var opt = response.details;
//         if (2==2) {
//           $('#staff')
//           .find('option')
//           .remove()
//           .end();

//             $.each(opt, function(key, value) {   
//              $('#staff').append($("<option></option>").attr("value",key).text(value)); 
//             //  alert(key);
//            }); 
//        }
//       /*end populate  class field*/
          
    
//       $('#staff').prop('disabled', false);
//      return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });

/////end SalaryPayment ///////


////// Rent ////////

$('#building3').change(function(){

    var building3 = $("#building3").val();
    console.log(building3);
  var formData = {
    'building3'      : building3,
    '_token'    : $('input[name=_token]').val()
  };

  $('#space').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getSpace', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#space')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#space').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#space').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

$('#building3').change(function(){

    var building3 = $("#building3").val();
    console.log(building3);
  var formData = {
    'building3'      : building3,
    '_token'    : $('input[name=_token]').val()
  };

  $('#client').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getClients', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#client')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#client').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#client').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

///// end Rent //////

////// start jobrequest //////


// $('#building4').change(function(){

//     var building4 = $("#building4").val();
//     console.log(building4);
//   var formData = {
//     'building4'      : building4,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#desc').prop('disabled', true);
//   console.log(formData);   
 
//   $.ajax({

//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getJobtype', // the url where we want to POST        
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server        
//             encode : true
//           }).done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//             var opt = response.details;
//         if (2==2) {
//           $('#desc')
//           .find('option')
//           .remove()
//           .end();

//             $.each(opt, function(key, value) {   
//              $('#desc').append($("<option></option>").attr("value",key).text(value)); 
//             //  alert(key);
//            }); 
//        }
//       /*end populate  class field*/
          
    
//       $('#desc').prop('disabled', false);
//      return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });


$('#building4').change(function(){

    var building4 = $("#building4").val();
    console.log(building4);
  var formData = {
    'building4'      : building4,
    '_token'    : $('input[name=_token]').val()
  };

  $('#client').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getClients2', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#client')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#client').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#client').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

 
////// end jobrequest /////

///// strat jobassignment /////
$('#building5').change(function(){

    var building5 = $("#building5").val();
    console.log(building5);
  var formData = {
    'building5'      : building5,
    '_token'    : $('input[name=_token]').val()
  };

  $('#Job_Code8').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getJobcode', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#Job_Code8')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#Job_Code8').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#Job_Code8').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

$('#Job_Code8').change(function(){

    var Job_Code8 = $("#Job_Code8").val();
    console.log(Job_Code8);
  var formData = {
    'Job_Code8'      : Job_Code8,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobtype').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getJobcode2', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#jobtype')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobtype').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobtype').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });


$('#building5').change(function(){

    var building5 = $("#building5").val();
    console.log(building5);
  var formData = {
    'building5'      : building5,
    '_token'    : $('input[name=_token]').val()
  };

  $('#tech').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getJobcode3', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#tech')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#tech').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#tech').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
/////end jobassignment /////

///// start jobcompletion ////
$('#building6').change(function(){

    var building6 = $("#building6").val();
    console.log(building6);
  var formData = {
    'building6'      : building6,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobcode').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getJobcode4', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#jobcode')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobcode').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobcode').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });

$('#building6').change(function(){

    var building6 = $("#building6").val();
    console.log(building6);
  var formData = {
    'building6'      : building6,
    '_token'    : $('input[name=_token]').val()
  };

  $('#jobtype').prop('disabled', true);
  console.log(formData);   
 
  $.ajax({

            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'getJobcode5', // the url where we want to POST        
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server        
            encode : true
          }).done(function(response) {
    console.log(response);
    if (response.message == "correct") {
      /*populate  class field*/

            var opt = response.details;
        if (2==2) {
          $('#jobtype')
          .find('option')
          .remove()
          .end();

            $.each(opt, function(key, value) {   
             $('#jobtype').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
           }); 
       }
      /*end populate  class field*/
          
    
      $('#jobtype').prop('disabled', false);
     return;
   }
})
  .fail(function(response) {
    console.log(response);
    console.log(response); 
    alert("Error");
  });

  });
///// end jobcompletion /////

///// start maintenance ////
// $('#buildingB').change(function(){

//     var buildingB = $("#buildingB").val();
//     console.log(buildingB);
//   var formData = {
//     'buildingB'      : buildingB,
//     '_token'    : $('input[name=_token]').val()
//   };

//   $('#requesttype').prop('disabled', true);
//   console.log(formData);   
 
//   $.ajax({

//             type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
//             url         : 'getMaintenance', // the url where we want to POST        
//             data        : formData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server        
//             encode : true
//           }).done(function(response) {
//     console.log(response);
//     if (response.message == "correct") {
//       /*populate  class field*/

//             var opt = response.details;
//         if (2==2) {
//           $('#requesttype')
//           .find('option')
//           .remove()
//           .end();

//             $.each(opt, function(key, value) {   
//              $('#requesttype').append($("<option></option>").attr("value",key).text(value)); 
//             //  alert(key);
//            }); 
//        }
//       /*end populate  class field*/
          
    
//       $('#requesttype').prop('disabled', false);
//      return;
//    }
// })
//   .fail(function(response) {
//     console.log(response);
//     console.log(response); 
//     alert("Error");
//   });

//   });
//// end maintenance  ///// 

$("#addsalarypayment").click(function(){
  var building2 = $("#building2").val();
    if (building2 == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#building2").find("option:selected").text();
     console.log(building2);

     var staff = $("#staff").val();
    if (staff == "") {
      alert("Staff field is required");
      return;
    }

     var staffname = $("#staff").find("option:selected").text();
     console.log(staff);

    var paymenttype = $("#paymenttype").val();
    if (paymenttype == "") {
      alert("Payment Type field is required");
      return;
    }

     var jobtypename = $("#paymenttype").find("option:selected").text();
     console.log(paymenttype);

    var transaction = $("#datepicker2").val();
    if (transaction == "") {
      alert("Transaction Date field is required");
      return;
    }
  
    var payment = $("#payment").val();
    if (payment == "") {
      alert("Payment Mode field is required");
      return;
    }

    var cheque = $("#cheque").val();
    

    var bank = $("#bank").val();
    

     var voucher = $("#voucher").val();
    if (voucher == "") {
      alert(" Voucher Number field is required");
      return;
    }

     var amount = $("#amount").val();
    if (amount == "") {
      alert(" Provide number at Payment Amount");
      return;
    }

     var narration = $("#narration").val();
    if (narration == "") {
      alert(" Narration field is required");
      return;
    }

    

    var person = {building2:building2,payment:payment ,paymenttype:paymenttype,staff:staff,transaction:transaction,cheque:cheque,bank:bank,voucher:voucher,amount:amount,narration:narration};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +staffname+ "</td><td>"+buildingname+ "</td><td>"+jobtypename+ "</td><td>" +transaction+"</td><td>"+payment+"</td><td>" +amount + "</td><td>" + voucher + "</td><td>" +narration+ "</td><td>"+cheque+ "</td><td>"+bank+ "</td><td>" ;
    $("table tbody").append(markup);
  });

////////////////////////////////////////

$("#addreceivepayment").click(function(){
  var building1 = $("#building1").val();
    if (building1 == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#building1").find("option:selected").text();
     console.log(building1);

     var datepicker1 = $("#datepicker1").val();
    if (datepicker1 == "") {
      alert("Transaction Date field is required");
      return;
    }

    var floorspace = $("#floorspace").val();
    if (floorspace == "") {
      alert("Floor Space Date field is required");
      return;
    }

    var floorspacename = $("#floorspace").find("option:selected").text();
     console.log(floorspace);
  
    var client = $("#client").val();
    if (client == "") {
      alert("Client Type field is required");
      return;
    }

    var clientname = $("#client").find("option:selected").text();
     console.log(client);

     var amountpaid = $("#amountpaid").val();
    if (amountpaid == "") {
      alert(" Provide Number at Amount Paid");
      return;
    }

     var paymentreceived = $("#paymentreceived").val();
    if (paymentreceived == "") {
      alert(" Payment Received field is required");
      return;
    }

     var narration = $("#narration").val();
    if (narration == "") {
      alert(" Narration field is required");
      return;
    }

    var person = {building1:building1,datepicker1:datepicker1,floorspace:floorspace,client:client,amountpaid:amountpaid,paymentreceived:paymentreceived,narration:narration};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+datepicker1+ "</td><td>" +floorspacename+"</td><td>"+clientname+"</td><td>" +amountpaid + "</td><td>" + paymentreceived + "</td><td>" + narration  + "</td><td>";
    $("table tbody").append(markup);
  });


$('.createreceivepayment').click(function (e) {
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
            url         : 'createreceivepayment', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Income Saved Succesfully");
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


$("#addrent").click(function(){
    var building3 = $("#building3").val();
    if (building3 == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#building3").find("option:selected").text();
     console.log(building3);

    var space = $("#space").val();
    if (space == "") {
      alert("Rent Space field is required");
      return;
    }

    var spacename = $("#space").find("option:selected").text();
     console.log(space);

    var date1 = $("#datepicker").val();
    if (date1 == "") {
      alert("Rent From field is required");
      return;
    }


    var date2 = $("#datepicker2").val();
    if (date2 == "") {
      alert("Rent To field is required");
      return;
    }
    var client1 = $("#client").val();
    if (client1 == "") {
      alert(" Client Name field is required");
      return;
    }

     var clientname = $("#client").find("option:selected").text();
     console.log(client);

    var amount1 = $("#amount").val();
    if (amount1 == "") {
      alert(" Rent Amount field is required");
      return;
    }
    
    var comment1 = $("#comment").val();
    if (comment1 == "") {
      alert(" Comment field is required");
      return;
    }
   

    var person = {building3:building3,space:space,date1:date1,date2:date2,client1:client1,amount1:amount1,comment1:comment1};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+spacename+ "</td><td>" +date1+"</td><td>" +date2+ "</td><td>" +clientname+ "</td><td>" +amount1+ "</td><td>" +comment1+ "</td><td>" ;
    $("table tbody").append(markup);
  });



  $("#addjob").click(function(){
    var building4 = $("#building4").val();
    if (building4 == "") {
      alert("Building field is required");
      return;
    }

     var buildingname = $("#building4").find("option:selected").text();
     console.log(building4);

    var name = $("#desc").val();
    if (name == "") {
      alert("Description field is required");
      return;
    }

     var jobtypename = $("#desc").find("option:selected").text();
     console.log(desc);

    var date = $("#datepicker").val();
    if (date == "") {
      alert("Requested Date field is required");
      return;
    }


    var by = $("#by").val();
    if (by == "") {
      alert("Requested By field is required");
      return;
    }

    var client = $("#client").val();
    if (client == "") {
      alert(" Client Name field is required");
      return;
    }

     var clientname = $("#client").find("option:selected").text();
     console.log(client);

    var comment = $("#comment").val();
    if (comment == "") {
      alert(" Comment field is required");
      return;
    }

     var code = $("#code").val();
    if (code == "") {
      alert(" Comment field is required");
      return;
    }

    var person = {building4:building4,name:name,date:date,by:by,client:client,code:code,comment:comment};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + buildingname+ "</td><td>"+ jobtypename+ "</td><td>" + date +"</td><td>" + by + "</td><td>" + clientname + "</td><td>" + code  + "</td><td>" + comment  + "</td><td>" ;
    $("table tbody").append(markup);
  });


  $("#addjobcompletion").click(function(){

    var jobtype = $("#jobtype").val();
    if (jobtype == "") {
      alert("Job Code field is required");
      return;
    }

    var flag = $("#flag").val();
    if(flag == ""){
      alert("Flag field is required");
      return;
    }

    var flagname = $("#flag").find("option:selected").text();
     console.log(flag);

    var person = {jobtype:jobtype,flag:flag};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +jobtype+ "</td><td>"+flagname+ "</td><td>" ;
    $("table tbody").append(markup);
  });


 $("#addstaffs").click(function(){
    // var building = $("#building").val();
    // if (building == "") {
    //   alert("Building Name field is required");
    //   return;
    // }

     // var buildingname = $("#building").find("option:selected").text();
     // console.log(building);

    var names = $("#name").val();
    if (names == "") {
      alert("Name field is required");
      return;
    }

    var gender = $("#gender").val();
    if (gender == "") {
      alert("Gender field is required");
      return;
    }


    var contacts = $("#contact").val();
    if (contacts == "") {
      alert("Number at Contact is required");
      return;
    }
    var dob = $("#datepicker1").val();
    if (dob == "") {
      alert(" DateOfBirth field is required");
      return;
    }

    var address = $("#address").val();
    if (address == "") {
      alert(" Address field is required");
      return;
    }
    
    var email = $("#emails").val();
    if (email == "") {
      alert(" Put A Valid Email Address");
      return;
    }

   

    var person = {names:names,gender:gender,contacts:contacts,dob:dob,address:address,email:email};
    data.push(person);
  
  
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>"+ names+ "</td><td>" + gender+"</td><td>" +contacts+ "</td><td>" + dob + "</td><td>" + address  + "</td><td> "+email+" <td></td>" ;
    $("table tbody").append(markup);
  });



  $("#addfloorspace").click(function(){
    var building = $("#building").val();
    if (building == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#building").find("option:selected").text();
     console.log(building);

    var name = $("#nameofspace").val();
    if (name == "") {
      alert("Name Of Space field is required");
      return;
    }

    var des = $("#description").val();
    if (des == "") {
      alert("Description field is required");
      return;
    }

    var surf = $("#surfacearea").val();
    if (surf == "") {
      alert("Enter Number At Surface Area");
      return;
    }

    var com = $("#comment").val();
    if (com == "") {
      alert(" Comment field is required");
      return;
    }


    var person = {building:building,name:name,des:des,surf:surf,com:com};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+"</td><td>"+name+ "</td><td>" + des+"</td><td>" +surf+ "</td><td>" + com + "<td></td>" ;
    $("table tbody").append(markup);
  });



    $("#addmaintenance").click(function(){

      var buildingB = $("#buildingB").val();
    if (buildingB == "") {
      alert("Building Name field is required");
      return;
    }

    var buildingname = $("#buildingB").find("option:selected").text();
     console.log(buildingB);

    var requesttype = $("#requesttype").val();
    if (requesttype == "") {
      alert("Requrest Type field is required");
      return;
    }

    var jobtypename = $("#requesttype").find("option:selected").text();
     console.log(requesttype);

    var jobstatus = $("#jobstatus").val();
    if (jobstatus == "") {
      alert("Requrest Type field is required");
      return;
    }

    var jobstatusname = $("#jobstatus").find("option:selected").text();
     console.log(jobstatus);

    var start = $("#datepicker2").val();
    if (start == "") {
      alert("Start Date field is required");
      return;
    }


    var dob = $("#datepicker1").val();
    if (dob == "") {
      alert("End Date field is required");
      return;
    }
  
    var datejoined = $("#clientcontact").val();
    if (datejoined == "") {
      alert(" Provide number at Client Contact");
      return;
    }

    var community = $("#community").val();
    if (community == "") {
      alert(" Supervised By(client) field is required");
      return;
    }
    
    var homeaddress = $("#homeaddress").val();
    if (homeaddress == "") {
      alert(" Supervised By(Staff) field is required");
      return;
      }



    var person = {buildingB:buildingB,requesttype:requesttype,jobstatus:jobstatus,start:start,dob:dob,datejoined:datejoined,community:community,homeaddress:homeaddress};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
  
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +buildingname+ "</td><td>"+jobtypename+ "</td><td>"+jobstatusname+ "</td><td>" +start+"</td><td>"+dob+"</td><td>" + datejoined + "</td><td>" + community + "</td><td> "+ homeaddress+" </td><td>" ;
    $("table tbody").append(markup);
  });



     $('#mode').change(function(){
      var selectBox = $('#mode').val();
   
      if(selectBox == 'Cheque'){

         $('#bank').show(1100).delay(1000);
         $('#cheque').show(1100).delay(1000);
         $('#account').show(1100).delay(1000);
         
       } else{
          $('#bank').hide(1100);
          $('#cheque').hide(1100);
          $('#account').hide(1100);

       }
      
    });

      $('#payment').change(function(){
      var selectBox = $('#payment').val();
      if(selectBox == 'Cheque'){

         $('#bank').show(2000);
         $('#cheque').show(2000);
       } else{
          $('#bank').hide(2000);
          $('#cheque').hide(2000);
       }
      
    });
   
    $('#jobtype1').change(function(){
      var opt = $('#jobtype1').val();

        if (opt == "1") {
          $('#tech')
          .find('option')
          .remove()
          .end();

            $.each(electricaltechnicians, function(key, value) {   
             $('#tech').append($("<option></option>").attr("value",key).text(value)); 
            //  alert(key);
            }); 
          }else if(opt == "3"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(tilerstechnicians, function(key, value) {   
             

             $('#tech').append($("<option></option>").attr("value",key).text(value)); 
  });
        //  alert('expense');
        }else if(opt == "2"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(plumbingtechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }else if(opt == "4"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(steelbendertechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }else if(opt == "5"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(airconditiontechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }else if(opt == "6"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(septictanktechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }else if(opt == "7"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(liftmaintenancetechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }else if(opt == "8"){
          $('#tech')
         .find('option')
         .remove()
         .end();

            $.each(cleanerstechnicians, function(key, value) {   
             

             $('#tech')
              .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
  });
        //  alert('expense');
        }




    });


  $("#addtechnician").click(function(){
 // var building = $("#building").val();
 //    if (building == "") {
 //      alert("Building Name field is required");
 //      return;
 //    }

  // var buildingname = $("#building").find("option:selected").text();
  // console.log(building);

    var names = $("#name").val();
    if (names == "") {
      alert("Name field is required");
      return;
    }

    var contacts1 = $("#contact").val();
    if (contacts1 == "") {
      alert("Provide Number At Contact");
      return;
    }

    var jobtype12 = $("#jobtype12").val();
    if (jobtype12 == "") {
      alert("name field is required");
      return;
    }

     var jobtypename = $("#jobtype12").find("option:selected").text();
     console.log(jobtype12);

    var email = $("#emails").val();
    if (email == "") {
      alert("Input a Valid Email Address");
      return;
    }
    var address = $("#address").val();
    if (address == "") {
      alert(" Address field is required");
      return;
    }

    var addresslocation = $("#addresslocation").val();
    if (addresslocation == "") {
      alert(" Location Address field is required");
      return;
    }

    var person = {names:names,contacts1:contacts1,jobtype12:jobtype12,email:email,address:address,addresslocation:addresslocation};
    data.push(person);
  
    
    $(this).closest('form').find("input[type=text],select, textarea").val("");
    
  
    
    console.log(data);
    var markup = "<tr><td><input type='checkbox' name='record'></td><td>"+ names + "</td><td>" + contacts1 +"</td><td>" + jobtypename + "</td><td>" + email + "</td><td>" + address + "</td><td>" + addresslocation  + "</td><td>" ;
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
    if (comments == "") {
      alert("Comments field is required");
      return;
    }

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
  .done(function(data) {
    alert("Members Records Submitted");
    console.log(data);
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
    alert("Tenant Saved Succesfully");
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

$('.createExpenses').click(function (e) {
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
            url         : 'createExpenses', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Expense Saved Succesfully");
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

$('.createSalarypayment').click(function (e) {
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
            url         : 'createSalarypayment', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Salary Payment Saved Succesfully");
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

$('.createbuilding').click(function (e) {
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
            url         : 'createbuilding', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Building Saved Succesfully");
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



$('.Createusers').click(function (e) {
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
            url         : 'Createusers', // the url where we want to POST
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


$('.createjobcompletion').click(function (e) {
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
            url         : 'createjobcompletion', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Job Type Saved Succesfully");
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

$('.createjobassign').click(function (e) {
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
            url         : 'createjobassign', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Job Assignment Saved Succesfully");
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

$('.createrent').click(function (e) {
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
            url         : 'createrent', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Rent Saved Succesfully");
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


$('.createjob').click(function (e) {
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
            url         : 'createjob', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Job Request Saved Succesfully");
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



$('.createfloor').click(function (e) {
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
            url         : 'createfloor', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Floor Space Saved Succesfully");
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



$('.createstaffs').click(function (e) {
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
            url         : 'createstaffs', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Staff Saved Succesfully");
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



$('.createmaintenance').click(function (e) {
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
            url         : 'createmaintenance', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Job Completion Saved Succesfully");
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


$('.createtechnician').click(function (e) {

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
            url         : 'createtechnician', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
  .done(function(response) {
    alert("Technician Saved Succesfully");
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
        data = [];
         
          var person = {date: fdate,Meeting_Time:time,Meeting_Name:name};
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
    data = new Array;
    console.log(data);
    console.log(response.responseText); 
    alert("Error");
    $("table tbody").find('input[name="record"]').each(function(index,value){

      $(this).parents("tr").remove();
    });
  });
}
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
  data = new Array;
  console.log(data);
  console.log(response.responseText); 
  alert("Error");
  $("table tbody").find('input[name="record"]').each(function(index,value){

    $(this).parents("tr").remove();
  });
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
    }
     })
            .fail(function(response) {
             $("#spinner").hide();
     $("#save").show();
     alert("Error Occured");
 });
});

$("#inviteall").on("click",function(){
  
  if ($(this).prop('checked')==true){ 
    tempo = [];
     tempo = data;
   
    $("#addmeeting").hide();
    $(".leaderform").hide();
   $(".meetingpanel").hide();
  }  else {
    $("#addmeeting").show();
    $(".leaderform").show();
    $(".meetingpanel").show();
    data = [];
    data = tempo;
  }
});

//-------------------------------add own functions above this ---
//do not edit
$("#declineprocess").on("click",function(){
	$(".hide-comment").fadeIn("fast");
	
});

$("#Hidebox").on("click",function(){
	$(".hide-comment").fadeOut("fast");
	
});

});
