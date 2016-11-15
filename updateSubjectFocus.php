<script src="utils.js"type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="sessionVariable.css">
<?php session_start();

include ("loginCheck.php");

include ("nav.php");

include ("db_connect.php");

$subjectF = ucwords($_POST['txtSubjectFocusAdd']);
//('".$_POST['txtSubjectFocusAdd']."')
$AddStatement = "INSERT INTO tSubject (Subject) VALUES ('$subjectF')";

//Validation for the Subject Addition starts here
$VerifyUnique = "SELECT * FROM tSubject WHERE Subject = ('$subjectF')";//search for the input, to see if it already exists.


if(!empty($subjectF)) {//Test if there is actual data to enter
    $duplicate = mysqli_query($dbc, $VerifyUnique);//search for already existing subject
    if (mysqli_num_rows($duplicate) > 0) {//if there isn't one, run insert

        $_SESSION["Message"] = "This subject already exists";//session variable for fail

    } else {
        $inserted = mysqli_query($dbc, $AddStatement);//run the insert statement
        if($inserted) {
            $_SESSION["Message"] = "Update Successful";//session variable for pass
        }else{
            $_SESSION['Message'] = "There was an error";
        }
    }
}




?>

<div class="form-group" id="focusSubjectAdd">
    <label for="subjectFocus"><span style='color: red;'>*</span>Subject:</label><span class="sessions"><?php echo $_SESSION["Message"];//display upload/exist message ?></span>
    <label for="subjectFocus">
        <small class="text-muted"><i>select more than one subject by holding control and clicking
                the subjects included</i></small>
    </label>

    <select multiple class="form-control" id="subject" name="subjectFocus[]" >
        <?php
        $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
        $results = $dbc->query($pSubjectQuery);
        echo $pSubjectQuery;

        while ($row = $results->fetch_array())
        {
            echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";
        }

        ?>

    </select>
</div>
