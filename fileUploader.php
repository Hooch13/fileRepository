<?php session_start();
include("loginCheck.php");
include("nav.php");
include("library.php");
error_reporting(0);
$var = $_SESSION['UserID'];
?>

<pre>
	<head>
		<!-- <meta http-equiv="refresh" content="7;url=http://masterzcreations.com/college/capstone/members.php?rid=<? //echo $var ?>"> -->

	</head>
<?PHP
//print_r($_POST);
//print_r($_FILES);

// a bit of cleaning on  posted variables
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
if(isset($_POST['submit'])) {
	$assignment = new Assignment();
	$assignment->Title = $title;
	$assignment->Description = $description;
	$assignment->Comments = $comments;
	$assignment->File = $fileName;
	if($_POST['gradeAssignment'] === "on") {
		$assignment->WillBeGraded = "Y";
	}
	else {
		$assignment->WillBeGraded = "N";
	}
	if($_POST['rubricAvailable'] === "on") {
		$assignment->RubricIncluded = "Y";
	}
	else{
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
		<h1>File Uploader</h1>
	</div>
	<?php
	// storing the upload
	$userID = $_SESSION['UserID'];
	$userIDString = (string)$userID;
	//echo 'UserID as a string ' . $userIDString;

	// create a folder for the user based on their userID and store the file in it.
	// if the folder is already available, store the file in the folder.
	if (!file_exists('assignments/' . $userIDString)) {
		mkdir('assignments/' . $userIDString, 0777, true);
		$target_dir = 'assignments/' . $userIDString . '/';
	}

	else {
		$target_dir = 'assignments/' . $userIDString . '/';
		//echo 'target directory = ' . $target_dir;
	}
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$theFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if(isset($_POST["submit"])) {
		$uploadOk = 1;
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "<div class='alert alert-danger text-center'>" . "Sorry, file already exists." . "</div>";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "<div class='alert alert-danger text-center'>" . "Sorry, your file is too large." . "</div>";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($theFileType != "zip") {
		echo "<div class='alert alert-danger text-center'>" . "Sorry, only ZIP files are allowed." . "</div>";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "<div class='alert alert-danger text-center'>" . "Sorry, your file was not uploaded." . "</div>";
		// if everything is ok, try to upload file
	} else {

		//echo 'target file = ' . $target_file;
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

			// if file requirements are met, add the assignment to the assignment folder and database.
			// createassignment function from library.php, returns the last assignmentid created

			$last_id = CreateAssignment($assignment, $dbc);
			// inserts into intermediate table linking assignment to the subject, specialty, and courses chosen

			InsertIntermediate($last_id, $subject, $specialty, $course, $subjectFocus, $specialtyFocus, $courseFocus, $dbc);

			// alert that it has been successful.
			echo "<div class='alert alert-success text-center'> The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. </div>";
		} else {
			// non successful upload
			echo "<div class='alert alert-danger text-center'>" . "Sorry, there was an error uploading your file." . "</div>";
		}
	}


	?>
	<div class="alert alert-success text-center">Please follow the <a href="http://masterzcreations.com/college/capstone/members.php?rid=<? echo $var ?>">Link to your profile page</a></div>

</div>