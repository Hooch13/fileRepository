<?php session_start();
require('library.php');
require('db_connect.php');
if ($_SESSION["AccessToForgotPassword2"] === "allowed") {

    $invalidPassword = false; // assume they didnt enter anything in
    $passwordReset = false; // true if both passwords match
    $passwordNoMatch = false; // passwords dont match
    $connectionProblem = false;
    // on submit
    if (isset($_POST["submit"])) {

        //echo 'Password: ' . $_POST['Password'] . '<br /> ReenterPassword: ' . $_POST['ReenterPassword'];

        // make sure first input password box meets requirements
        if (strlen($_POST["Password"]) < 8 || strlen($_POST["Password"]) > 30) {
            $invalidPassword = true;
        } // make sure reenter password box meets requirements
        else if (strlen($_POST["ReenterPassword"]) < 8 || strlen($_POST["ReenterPassword"]) > 30) {
            $invalidPassword = true;
        } // if they both pass inspection
        else {
            // make sure both passwords the user enters match
            if ($_POST['Password'] === $_POST['ReenterPassword']) {

                // sql to insert into the db
                $sql = "UPDATE tUser SET Password = '" . md5($_POST['Password']) . "' WHERE UserID = " . $_SESSION['UserID'] . "";
               // echo '<br /> sql stmt ' . $sql;

                // query the db. if successful, let user know
                if ($dbc->query($sql) === true) {
                    $passwordReset = true;
                } // didnt update successfully
                else {
                    $connectionProblem = true;
                }

            } // passwords didnt match
            else {
                $passwordNoMatch = true;
            }
        }
    }
} // redirect to login page if they dont have an email in the db
else {
    header("Location: login.php");
}
?>


<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
<div class="container">
    <div class="jumbotron h1 text-center">Recover Password</div>
    <div class="container">
        <div class="container col-sm-9" id="zachRegForm">
            <form role="form" action="forgotPassword2.php" method="post">
                <div class="row">
                    <div class="form-group">

                        <?php
                        // fail/success cases
                        if ($invalidPassword)
                            echo '<label class="alert alert-danger">Please enter a new password between 8 and 30 characters</label><br>';
                        if ($passwordNoMatch)
                            echo '<label class="alert alert-danger">Passwords do not match </label><br>';
                        if ($passwordReset)
                            echo '<label class="alert alert-success">Password successfully updated </label><br>
                                    <a href="login.php">Click to here to go back to login screen</a><br>';
                        if ($connectionProblem) {
                            echo '<label class="alert alert-danger">Password was not successfully changed due to connection with the server.<br>
                                    Please try again later.</label><br>';
                        }

                        ?>
                        <label for="Password">Enter new password: </label>
                        <input type="password" class="form-control" id="Password" name="Password">

                        <label for="ReenterPassword">Re-enter new password: </label>
                        <input type="password" class="form-control" id="ReenterPassword" name="ReenterPassword">
                    </div>
                    <input type="hidden" name="submit"/>
                    <input type="submit" value="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


