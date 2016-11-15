<?php session_start();
require('library.php');
require('db_connect.php');

if ($_SESSION["AccessToForgotPassword1"] === "allowed") {

    $securityQuestion = $_SESSION['securityQuestion'];
    $securityQuestionAnswer = $_SESSION['securityQuestionAnswer'];
//echo $securityQuestion . '<br />' . $securityQuestionAnswer;

// if they dont put anything into the text box
    $invalidSecurityQuestionAnswer = false;
// if they put the wrong answer
    $invalidSecurityQuestionAnswerAnswer = false;

    // on submit
    if (isset($_POST["submit"])) {

        // have to at least enter something
        if (strlen($_POST['SecurityQuestionAnswer']) <= 0) {
            $invalidSecurityQuestionAnswer = true;
        } else {
            // check input answer to one stored in db
            if ($_POST['SecurityQuestionAnswer'] === $securityQuestionAnswer) {
                // redirect to next page if they match
                $_SESSION["AccessToForgotPassword2"] = "allowed";
                header("Location: forgotPassword2.php");
            }// let user know if they dont match
            else {
                $invalidSecurityQuestionAnswerAnswer = true;
            }
        }
    }
}
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
            <form role="form" action="forgotPassword1.php" method="post">
                <div class="row">
                    <div class="form-group">
                        <?php
                        // user feedback
                        if ($invalidSecurityQuestionAnswer)
                            echo '<label class="alert alert-danger">Please answer your security question </label><br>';
                        if ($invalidSecurityQuestionAnswerAnswer)
                            echo '<label class="alert alert-danger">Answer to security question does not match. <br> Answer is case sensitive. </label><br>';
                        ?>
                        <label for="SecurityQuestion">Please answer your security question: </label>
                        <?php echo '<input type="text" class="form-control" id="SecurityQuestion"
                        name="SecurityQuestion" value="' . $securityQuestion . '" readonly>';
                        ?>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="SecurityQuestionAnswer"
                               name="SecurityQuestionAnswer">
                    </div>
                    <input type="hidden" name="submit"/>
                    <input type="submit" value="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

