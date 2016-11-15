<?php
require('library.php');
require('db_connect.php');

$passwordInvalid = false; // Assume password is valid
$emailDuplicate = false; // Assume email is unique
$questionInvalid = false; // Assume question not hacked
$firstNameInvalid = false;
$lastNameInvalid = false;
$emailInvalid = false;

if(isset($_POST['submit'])) {
    $user = new User();
    $user->FirstName = $_POST["FirstName"];
    $user->LastName = $_POST["LastName"];
    $user->Email = $_POST["Email"];
    $user->Password = CreateSecurePassword($_POST["Password"]);
    $user->SecurityQuestionID = $_POST["SecurityQuestionID"];
    $user->SecurityQuestionAnswer = $_POST["SecurityQuestionAnswer"];
    $user->UserRankID = 3;

    if(strlen($_POST['FirstName']) <= 0 ) {
        $firstNameInvalid = true;
    }

    else if(strlen($_POST['Email']) <= 0 ) {
        $emailInvalid = true;
    }

    else if(strlen($_POST['LastName']) <= 0) {
        $lastNameInvalid = true;
    }

    else if(strlen($_POST["Password"]) < 8 || strlen($_POST["Password"]) > 30) { // Invalid password
        $passwordInvalid = true;
    }
    else if(!SecurityQuestionIDIsValid($user->SecurityQuestionID, $dbc)) {
        $questionInvalid = true;
    }
    else if(CreateUser($user, $dbc) === 0) { // Success
            // Redirect to login
            header("Location: login.php?register=successful");
            exit();
        }
    else {
        $emailDuplicate = true;
    }
}
?>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
<div class="container">
<div class="jumbotron h1 text-center">Register</div>
<div class="container">
    <div class="container col-sm-9" id="zachRegForm">
<form role="form" action="zachregister.php" method="post">
    <div class="form-group">
        <?php
        if($firstNameInvalid)
            echo '<label class="alert alert-danger">Fill in first name</label><br>';
        ?>
        <label for="FirstName">First Name:</label>
        <input type="text" class="form-control" id="FirstName" name="FirstName">
    </div>
    <div class="form-group">
        <?php
        if($lastNameInvalid)
            echo '<label class="alert alert-danger">Fill in last name</label><br>';
        ?>
        <label for="LastName">Last Name:</label>
        <input type="text" class="form-control" id="LastName" name="LastName">
    </div>
    <div class="form-group">
        <?php

        if($emailInvalid)
            echo '<label class="alert alert-danger">Fill in email</label><br>';

        else if($emailDuplicate)
            echo '<label class="alert alert-danger">Email already exists.</label><br>';

        ?>
        <label for="Email">Email address:</label>
        <input type="email" class="form-control" id="Email" name="Email">
    </div>
    <div class="form-group">
        <?php
            if($passwordInvalid)
                echo '<label class="alert alert-danger">Password must be between 8 and 30 characters.</label><br>';
        ?>
        <label for="Password">Password:</label>
        <input type="password" class="form-control" id="Password" name="Password">
    </div>
    <div class="form-group">
        <?php
            if($questionInvalid)
                echo '<label class="alert alert-danger">Security question index was changed in the source code.</label><br>';
        ?>
        <label>Choose a security question:</label>
        <select name="SecurityQuestionID">
            <?php
            $SecurityQuestionQuery = "SELECT * FROM tSecurityQuestion ORDER BY SecurityQuestion ASC";
            $results = $dbc->query($SecurityQuestionQuery);
            echo $SecurityQuestionQuery;
            while($row = $results->fetch_array())
            {
                echo "<option value='" .$row[SecurityQuestionID] . "'>". $row["SecurityQuestion"] .  "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="SecurityQuestionAnswer">Security Question Answer:</label>
        <input type="text" class="form-control" id="SecurityQuestionAnswer" name="SecurityQuestionAnswer">
    </div>

    <input type='hidden' name='submit' />
    <input type="submit" value="register" />

</form>
    </div>
    </div>
</div>
<?php
$dbc->close();
?>