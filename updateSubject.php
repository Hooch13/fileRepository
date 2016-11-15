<script src="utils.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="sessionVariable.css">


<?php session_start();

include("loginCheck.php");

include("nav.php");

include("db_connect.php");

include("library.php");


//('".$_POST['txtSubjectAdd']."')"
$subject = ucwords($_POST['txtSubjectAdd']);//capitalize the first letter in every word submitted.

$AddStatement = "INSERT INTO tSubject (Subject) VALUES ('$subject')";//add statement for DB

//Validation for the Subject Addition starts here
$VerifyUnique = "SELECT * FROM tSubject WHERE Subject = ('$subject')";//search for the input, to see if it already exists.


if (!empty($subject)) {//Test if there is actual data to enter
    $duplicate = mysqli_query($dbc, $VerifyUnique);//search for already existing subject
    if (mysqli_num_rows($duplicate) > 0) {//if there isn't one, run insert

        $_SESSION["Message"] = "This subject already exists";//session variable for fail

    } else {
        $inserted = mysqli_query($dbc, $AddStatement);//run the insert statement
        if ($inserted) {
            $_SESSION["Message"] = "Update Successful";//session variable for pass
        } else {
            $_SESSION['Message'] = "There was an error";
        }
    }
}

// ----- Div to be loaded into old Div on updatePage -----
?>

<div class="form-group" id="subjectDivInner">
    <label for="subject"><span style='color: red;'>*</span>Subject:</label><span class="sessions"><?php echo $_SESSION["Message"]; ?></span>
    <label for="subject">
        <small class="text-muted"><i>select more than one subject by holding control and clicking
                the subjects included</i></small>
    </label>

    <select multiple class="form-control" id="subject" name="subject[]">
        <?php
        $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
        $results = $dbc->query($pSubjectQuery);
        //echo $pSubjectQuery;

        while ($row = $results->fetch_array()) {
            echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";

        }

        //validation for the subject add ends here--
        ?>

    </select>

</div id="SubjectAddDiv">
<!----- Div to be loaded into old Div on updatePage ----->