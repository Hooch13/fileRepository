<?php session_start();
 
// STEP 2. Check if a user is logged in by checking the session value
if($_SESSION['logged_in']==true){
 
    // if it is, redirect to index page and tell the user he's already logged in
	 ?>
		   <META HTTP-EQUIV="Refresh" CONTENT="1; URL=http://masterzcreations.com/college/capstone/plan/login.php?action=already_logged_in">
		   <?PHP
    header('Location: index.php?action=already_logged_in');
}
?>
<html>
    <head>
        <title>File Manager</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
    </head>
<body>
 
<div id="loginForm"> 
 
    <?php
    // STEP 3. Check for an action and show the approprite message.
    if($_GET['action']=='not_yet_logged_in'){
        echo "<div id='infoMesssage'>Please Login below.</div>";
    }
     
    // STEP 4. Check if the user clicked the 'Login' button already by checking the PHP $_POST variable
    if($_POST){
         
        // these username and password are just examples, it should be from you database
        // passwords must be encrypted (salt and hash) to be secured, this post should give you an idea or see the update below
        $username = 'admin';
        $password = 'admin';
         
        // check if the inputted username and password match
        if(($_POST['username']==$username) && ($_POST['password']==$password)){
             
            // if it is, set the session value to true
            $_SESSION['logged_in'] = true;
             
            // and redirect to your site's admin or index page
           ?>
		   <META HTTP-EQUIV="Refresh" CONTENT="1; URL=http://masterzcreations.com/college/capstone/plan/index.php">
		   <?PHP
             
        }else{
         
            // if it does not match, tell the user his access is denied.
            echo "<div id='failedMessage'>Access denied. </div>";
        }
    }
    ?>
 
    <!-- where the user will enter his username and password -->
    <form action="login.php" method="post">
     
	 <img src="images/sample_logo.png" id="loginHead">
        <div id="formHeader">Login</div>
         
        <div id="formBody">
            <div class="formField">
                <input type="text" name="username" placeholder="Username" />
            </div>
             
            <div class="formField"> 
                <input type="password" name="password" placeholder="Password" />
            </div>
         
            <div>
                <input type="submit" value="Login" class="customButton" />
            </div>
        </div>
         
    </form>
     
</div>
 
</body>
</html>