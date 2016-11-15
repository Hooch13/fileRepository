<?php session_start();
include("loginCheck.php");
include("nav.php");
include("library.php");
error_reporting(0);
$var = $_SESSION['UserID'];

?>
<html>
<head>
   <!--<meta http-equiv="refresh" content="7;url=http://masterzcreations.com/college/capstone/members.php?rid=<? //echo $var ?>"> -->

</head>
<body>
<?PHP
//print_r($_POST);
//print_r($_FILES);

// a bit of cleaning on  posted variables
$assignmentNum = $_SESSION['editAssignment'];
$subject = $_POST['subject'];
$subjectFocus = $_POST['subjectFocus'];
$course = $_POST['course'];
$courseFocus = $_POST['courseFocus'];
$specialty = $_POST['specialty'];
$specialtyFocus = $_POST['specialtyFocus'];
$title = cleaning($_POST['title']);
$comments = cleaning($_POST['comments']);
$description = cleaning($_POST['description']);
$gradeAssignment = $_POST['gradeAssignment'];
$rubricAvailable = $_POST['rubricAvailable'];
$fileName = cleaning($_FILES["fileToUpload"]["name"]);

// if a submit happened, create an assignment.
if (isset($_POST['submit'])) {
    $assignment->AssignmentNum = $AssignmentNum;
    $assignment->Title = $title;
    $assignment->Description = $description;
    $assignment->Comments = $comments;
    $assignment->File = $fileName;
    if ($_POST['gradeAssignment'] === "on") {
        $assignment->WillBeGraded = "Y";
    } else {
        $assignment->WillBeGraded = "N";
    }
    if ($_POST['rubricAvailable'] === "on") {
        $assignment->RubricIncluded = "Y";
    } else {
        $assignment->RubricIncluded = "N";
    }
    $assignment->DateTimeUploaded;
    $assignment->UserID = $_SESSION['UserID'];
    $assignment->Subject = $subject;
    $assignment->SubjectFocus = $subjectFocus;
    $assignment->Specialty = $specialty;
    $assignment->SpecialtyFocus = $specialtyFocus;
    $assignment->Course = $course;
    $assignment->CourseFocus = $courseFocus;
}

?>
</pre>

<div class="container">
    <div class="jumbotron text-center">
        <h1>File Editor</h1>
    </div>
    <?php
    // storing the upload
    $userID = $_SESSION['UserID'];
    $userIDString = (string)$userID;
    //echo 'UserID as a string ' . $userIDString;

    // create a folder for the user based on their userID and store the file in it.
    // if the folder is already available, store the file in the folder.

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $theFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if (isset($_POST["submit"])) {
        $wipeInter = "DELETE FROM tAssignment_IntermediateSSC WHERE AssignmentID = $assignmentNum";//Wipe all old Associations
        $deleted = $dbc->query($wipeInter);//execute Wipe
        $uploadOk = 1;
        InsertIntermediate($assignmentNum, $subject, $specialty, $course, $subjectFocus, $specialtyFocus, $courseFocus, $dbc);
        //UpdateAssignment($assignment, $dbc);
        $update = "UPDATE tAssignment SET ";
        if (strlen($title) > 0) {
            $update .= "Title = " . "'" . $title . "'" . "";
        }
        if (strlen(($comments)) > 0) {
            $update .= ", Comments = " . "'" . $comments . "'" . "";
        }
        if (strlen(($description)) > 0) {
            $update .= ", Description = " . "'" . $description . "'" . "";
        }
        //$update = "UPDATE tAssignment SET Title = " . "'" . $title . "'" . ", Comments = " . "'" . $comments . "'" . ",Description = " . "'" . $description . "'" . " WHERE AssignmentID = 150";
        $update .= " WHERE AssignmentID = " . $assignmentNum;
        //$update .= "UPDATE tAssignment SET Description = "."'" .$_POST['description'] ."'" . " WHERE AssignmentID = 150";
        //echo $update . "<br> We made it";
        if ($dbc->query($update) === true) {
            //echo $update . "<br> We made it";
            echo "<div class='alert alert-success text-center'> The file has been updated! </div>";


        } else {
            echo "<div class='alert alert-danger text-center'> connection to the database failed </div>";


        }

    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger text-center'>" . "Sorry, there was an error updating your file." . "</div>";
    // if everything is ok, try to upload file
    }


    ?>
    <div class="alert alert-success text-center">Please follow the <a href="http://masterzcreations.com/college/capstone/members.php?rid=<? echo $var ?>">Link to your profile page</a></div>

</div>
</body>
</html>