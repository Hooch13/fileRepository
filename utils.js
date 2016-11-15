function fadeMe(){

   $('.sessions').fadeOut();
}

function myFCourse(){
   $('#focusCourseAdd').load('updateCourseFocus.php #focusCourseAdd').fadeOut().fadeIn("fast");
   $('#courseDivInner').load('updateCourse.php #courseDivInner').fadeOut().fadeIn("fast");

}

function myFSpecialty(){

   $('#focusSpecialtyAdd').load('updateSpecialtyFocus.php #focusSpecialtyAdd').fadeOut().fadeIn("fast");
   $('#specialtyDivInner').load('updateSpecialty.php #specialtyDivInner').fadeOut().fadeIn("fast");

}

function myFSubject(){

   $('#focusSubjectAdd').load('updateSubjectFocus.php #focusSubjectAdd').fadeOut().fadeIn("fast");
   $('#subjectDivInner').load('updateSubject.php #subjectDivInner').fadeOut().fadeIn("fast");
}


function myCourse(){
   $('#courseDivInner').load('updateCourse.php #courseDivInner').fadeOut().fadeIn("fast");
   $('#focusCourseAdd').load('updateCourseFocus.php #focusCourseAdd').fadeOut().fadeIn("fast");
}

function mySpecialty(){
   $('#specialtyDivInner').load('updateSpecialty.php #specialtyDivInner').fadeOut().fadeIn("fast");
   $('#focusSpecialtyAdd').load('updateSpecialtyFocus.php #focusSpecialtyAdd').fadeOut().fadeIn("fast");

}

function mySubject(){

   $('#focusSubjectAdd').load('updateSubjectFocus.php #focusSubjectAdd').fadeOut().fadeIn("fast");
   $('#subjectDivInner').load('updateSubject.php #subjectDivInner').fadeOut().fadeIn("fast");
}

<!-- ---------------------Add SUBJECT DB----------------------- -->
    $(document).ready(function () {
    $("#btnAddSubject").click(function () {
      var msg = $('#txtSubjectAdd').val();
       if (msg == null || msg == "") {
          alert("Please enter a subject to add.");
          return false;
       }else{
      $.ajax({

         type : "POST",
         url  : "updateSubject.php",
         data : "txtSubjectAdd=" + msg
      });

setTimeout(mySubject,500);
          setTimeout(fadeMe,5000);
      document.getElementById('txtSubjectAdd').value = "";
       };
   });


});


<!-- ---------------------Add SPECIALTY DB----------------------- -->


$(document).ready(function() {
   $("#btnAddSpecialty").click(function () {
      var msg = $('#txtSpecialtyAdd').val();
      if (msg == null || msg == "") {
         alert("Please enter a specialty to add.");
         return false;
      }else {

         $.ajax({
            type: "POST",
            url: "updateSpecialty.php",
            data: "txtSpecialtyAdd=" + msg
         });
         setTimeout(mySpecialty,500);
         setTimeout(fadeMe,5000);
         document.getElementById('txtSpecialtyAdd').value = "";
      };
   });
});

   <!-- ---------------------Add COURSE DB----------------------- -->

$(document).ready(function() {
   $("#btnAddCourse").click(function () {
      var msg = $('#txtCourseAdd').val();
      if (msg == null || msg == "") {
         alert("Please enter a course to add.");
         return false;
      }else {

         $.ajax({
            type: "POST",
            url: "updateCourse.php",
            data: "txtCourseAdd=" + msg
         });

         setTimeout(myCourse,500);
         setTimeout(fadeMe,5000);
         document.getElementById('txtCourseAdd').value = "";
      };
   });
});


   <!-- ---------------------Add SUBJECTFOCUS DB----------------------- -->

$(document).ready(function() {
   $("#btnAddSubjectFocus").click(function () {
      var msg = $('#txtSubjectFocusAdd').val();
      if (msg == null || msg == "") {
         alert("Please enter a focus subject to add.");
         return false;
      }else {

         $.ajax({
            type: "POST",
            url: "updateSubjectFocus.php",
            data: "txtSubjectFocusAdd=" + msg
         });

         setTimeout(myFSubject,500);
         setTimeout(fadeMe,5000);
         document.getElementById('txtSubjectFocusAdd').value = "";
      };
   });
});


   <!-- ---------------------Add SPECIALTYFOCUS DB----------------------- -->

$(document).ready(function() {
   $("#btnAddSpecialtyFocus").click(function () {
      var msg = $('#txtSpecialtyFocusAdd').val();
      if (msg == null || msg == "") {
         alert("Please enter a focus specialty to add.");
         return false;
      }else {

         $.ajax({
            type: "POST",
            url: "updateSpecialtyFocus.php",
            data: "txtSpecialtyFocusAdd=" + msg
         });

         setTimeout(myFSpecialty,500);
         setTimeout(fadeMe,5000);
         document.getElementById('txtSpecialtyFocusAdd').value = "";
      };
   });
});



   <!-- ---------------------Add COURSEFOCUS DB----------------------- -->

$(document).ready(function() {
   $("#btnAddCourseFocus").click(function () {
      var msg = $('#txtCourseFocusAdd').val();
      if (msg == null || msg == "") {
         alert("Please enter a focus course to add.");
         return false;
      }else {

         $.ajax({
            type: "POST",
            url: "updateCourseFocus.php",
            data: "txtCourseFocusAdd=" + msg
         });


         setTimeout(myFCourse,500);
         setTimeout(fadeMe,5000);
         document.getElementById('txtCourseFocusAdd').value = "";
      };
   });
});


