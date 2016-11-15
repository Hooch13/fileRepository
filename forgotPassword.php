<?php session_start();
require('library.php');
require('db_connect.php');


$emailInvalid = false;// assume email is invalid
$emailNotOnFile = false; // assume email isnt in db
$hideEmail = false;
if (isset($_POST['submit'])) {

    // if they dont at least enter something
    if (strlen($_POST['Email']) <= 0) {
        $emailInvalid = true;
    } else {
        // create sql statement and query database to see if their email is on file
        $sqlQuery = "SELECT tSecurityQuestion.SecurityQuestion, tUser.SecurityQuestionAnswer, tUser.UserID
                 FROM tUser JOIN tSecurityQuestion ON tUser.SecurityQuestionID = tSecurityQuestion.SecurityQuestionID
                 WHERE tUser.Email = '" . $_POST['Email'] . "'";
        //print $sqlQuery;
        $result = $dbc->query($sqlQuery);
    }

    // if we get something back
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION["securityQuestion"] = $row["SecurityQuestion"];
            $_SESSION["securityQuestionAnswer"] = $row["SecurityQuestionAnswer"];
            $_SESSION["UserID"] = $row["UserID"];
            //echo "<br /> security question is " . $_SESSION["securityQuestion"];
            //echo "<br /> security question answer is " . $_SESSION["securityQuestionAnswer"];
        }
        $_SESSION["AccessToForgotPassword1"] = "allowed";
        header("Location: forgotPassword1.php");
        //nothing returned; we dont have their email
    } else {
        $emailNotOnFile = true;
    }
}

?>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
    <div class="container">
        <div class="jumbotron h1 text-center">Recover Password</div>
        <div class="container">
            <div class="container col-sm-9" id="zachRegForm">

                <form role="form" action="forgotPassword.php" method="post">

                    <div class="row">
                        <div class="form-group">
                            <?php
                            // validation acknowledgement
                            if ($emailInvalid)
                                echo '<label class="alert alert-danger">Fill in email</label><br>';
                            if ($emailNotOnFile)
                                echo '<label class="alert alert-danger">Email not on file!</label><br>';
                            ?>
                            <label for="Email">E-mail:</label>
                            <input type="email" class="form-control" id="Email" name="Email">
                        </div>

                        <input type='hidden' name='submit'/>
                        <input type="submit" value="submit"/>
                    </div>
                </form>

            </div>
        </div>
    </div>


<?php
$dbc->close();
?>