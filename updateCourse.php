<script src="utils.js"type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="sessionVariable.css">


<?php session_start();

include ("loginCheck.php");

include ("nav.php");

include ("db_connect.php");

$course = strtoupper( $_POST['txtCourseAdd'] );//sets entire string to upperCase

//('".$_POST['txtCourseAdd']."')


$AddStatement = "INSERT INTO tCourse (Course) VALUES ('$course')";

//Validation for the Subject Addition starts here
$VerifyUnique = "SELECT * FROM tCourse WHERE Course = ('$course')";//search for the input, to see if it already exists.


if(!empty($course)) {//Test if there is actual data to enter
    $duplicate = mysqli_query($dbc, $VerifyUnique);//search for already existing subject
    if (mysqli_num_rows($duplicate) > 0) {//if there isn't one, run insert

        $_SESSION["Message"] = "This course already exists";//session variable for fail

    } else {
        $inserted = mysqli_query($dbc, $AddStatement);//run the insert statement
        if($inserted) {
            $_SESSION["Message"] = "Update Successful";//session variable for pass
        }else{
            $_SESSION['Message'] = "There was an error";//session variable for error
        }
    }
}
//Below is the Div that gets loaded onto the upload page replacing the old list
?>

<div class="form-group" id="courseDivInner">
    <label for="course"><span style='color: red;'>*</span>Course:</label><span class="sessions"><?php echo $_SESSION["Message"];//display upload/exist message ?></span>
    <label for="course">
        <small class="text-muted"><i>select more than one course by holding control and clicking
                the courses included</i></small>
    </label>
    <select multiple class="form-control" id="course" name="course[]">
        <?php //load the course list into div ----
        $pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
        $results = $dbc->query($pCourseQuery);

        while ($row = $results->fetch_array())
        {
            echo "<option value='" . $row["CourseID"] . "'>" . $row["Course"] . "</option>";
        }

        ?>
    </select>
</div>
