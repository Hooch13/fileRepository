<?php session_start();
include("library.php");

// STEP 2. Check if a user is logged in by checking the session value
if ($_SESSION['logged_in'] == true) {

    // if it is, redirect to index page and tell the user he's already logged in
    ?>
    <META HTTP-EQUIV="Refresh"
          CONTENT="0; URL=http://masterzcreations.com/college/capstone/index.php?action=already_logged_in">
    <?PHP

}

	if(isset($_GET['tour'])) 
	{
		if(strcmp($_GET['tour'],"Yes") == 0)
		{
			$GuestQuery = "SELECT * FROM tUser WHERE UserID = 82";
			$GuestResult = $dbc->query($GuestQuery);
			
			 $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;
                while ($GuestRow = $GuestResult->fetch_assoc()) {
					$_SESSION['FirstName'] = $GuestRow['FirstName'];
                    $_SESSION['LastName'] = $GuestRow['LastName'];
                    $_SESSION['UserRank'] = $GuestRow['UserRankID'];
                    $_SESSION['UserID'] = $GuestRow['UserID'];
				}
				
				
                // and redirect to your site's admin or index page
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/dashboard.php">

                <?PHP
		}
	}
?>
<html>
<head>
    <title>File Repository</title>
    <!--<link type="text/css" rel="stylesheet" href="style.css" />-->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
</head>
<body>

<div id="loginForm">
	
    <?php
    // STEP 3. Check for an action and show the approprite message.
    if ($_GET['action'] == 'not_yet_logged_in') {
        // echo "<div class='container'><div class='alert alert-warning'>Please Login below.</div></div>";
    }

    // STEP 4. Check if the user clicked the 'Login' button already by checking the PHP $_POST variable
    if ($_POST) {


        // these username and password are just examples, it should be from you database
        // passwords must be encrypted (salt and hash) to be secured, this post should give you an idea or see the update below
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            // username and password sent from Form
            $email = cleaning($_POST['email']);

            $password = cleaning($_POST['password']);

            $password = md5($password); // Encrypted Password

            $sql = "SELECT * FROM tUser WHERE Email ='$email' and password='$password'";

            $result = $dbc->query($sql);
            $count = $result->num_rows;
            // if it is, set the session value to true
            if ($count == 1) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['FirstName'] = $row['FirstName'];
                    $_SESSION['LastName'] = $row['LastName'];
                    $_SESSION['UserRank'] = $row['UserRankID'];
                    $_SESSION['UserID'] = $row['UserID'];
                }

                // if it is, set the session value to true


                // and redirect to your site's admin or index page
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/dashboard.php">

                <?PHP

            } else {

                // if it does not match, tell the user his access is denied.
                echo "<div class='container'><div class='alert alert-danger'>Access denied. </div></div>";
            }
        }


    }
    ?>


    <img src="images/FR_Logo.png" style="display: block;width:50%; margin-left: auto;
		margin-right:auto;">

    <form action="login.php" method="post" class="form-horizontal" role="form">

        <div class="container">
            <div class="jumbotron h1 text-center">Login</div>

            <div class="container center_div">
                <div class="row">
                    <div class="form-group">
                        <?php
                        if ($_GET["register"] == "successful")
                            echo '<label class="alert alert-success">Your account was created successfully.</label><br>';
                        ?>
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="row">
                    <!--        <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember"> Remember me
                                </label>
                            </div>-->
                    <a href="zachregister.php">Need to register for an account?</a>
                </div>
                <div class="row">
                    <a href="forgotPassword.php">Forgot your password?</a>
                </div>

                <div class="row">
                    <input type="submit" value="Login" class="btn btn-default"/>
					<a href="login.php?tour=Yes" class="btn btn-default"/>Guest Viewing</a>
                </div>
            </div>
    </form>

</div>

</body>
</html>