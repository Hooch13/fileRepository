<script src="utils.js"type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="sessionVariable.css">
<?php session_start();

include ("loginCheck.php");

include ("nav.php");

include ("db_connect.php");

$specialtyF =ucwords( $_POST['txtSpecialtyFocusAdd'] );
//('".$_POST['txtSpecialtyFocusAdd']."')
$AddStatement = "INSERT INTO tSpecialty (Specialty) VALUES ('$specialtyF')";

//Validation for the Subject Addition starts here
$VerifyUnique = "SELECT * FROM tSpecialty WHERE Specialty = ('$specialtyF')";//search for the input, to see if it already exists.


if(!empty($specialtyF)) {//Test if there is actual data to enter
    $duplicate = mysqli_query($dbc, $VerifyUnique);//search for already existing subject
    if (mysqli_num_rows($duplicate) > 0) {//if there isn't one, run insert

        $_SESSION["Message"] = "This specialty already exists";//session variable for fail

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

<div class="form-group" id="focusSpecialtyAdd">
    <label for="specialtyFocus">Specialty:</label><span class="sessions"><?php echo $_SESSION["Message"];//display upload/exist message ?></span>
    <label for="specialtyFocus">
        <small class="text-muted"><i>select more than one specialty by holding control and clicking
                the specialty included</i></small>
    </label>

    <select multiple class="form-control" id="specialty" name="specialtyFocus[]">
        <?php
        $pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
        $results = $dbc->query($pSpecialtyQuery);
        echo $pSpecialtyQuery;

        while ($row = $results->fetch_array())
        {
            echo "<option value='" . $row["SpecialtyID"] . "'>" . $row["Specialty"] . "</option>";
        }

        ?>
    </select>
</div>
