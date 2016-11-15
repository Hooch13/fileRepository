<?php session_start();
include("db_connect.php");
 
 function cleaning($data)
	{
		$data = trim($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;
	}
 
// STEP 2. Check if a user is logged in by checking the session value
if($_SESSION['logged_in']==true){
 
    // if it is, redirect to index page and tell the user he's already logged in
    header('Location: index.php?action=already_logged_in');
}
?>
<html>
    <head>
        <title>Registration Page</title> 
        <link type="text/css" rel="stylesheet" href="plan/style.css" />
    </head>
<body>
 
<div id="loginForm"> 
 
    <?php
		// See if the Register Button has been set. if so, then process the form.
		if(isset($_POST['submit'])) 
		{
			echo "are we in the post check?";
            // username and password sent from Form
				
				$password=cleaning($_POST['password']); 
				$email = cleaning($_POST['email']);
				$firstName = cleaning($_POST['firstName']);
				$lastName = cleaning($_POST['lastName']); 
				//$level = 100;
				$password=md5($password); // Encrypted Password
				$sql="Insert into employee(User_ID,First_Name, Last_Name, Email_Address,Password, Bio, Office_Hours, Room_Number, Phone, Preferred_Contact_Method, Phone, Security_Question_ID, Last_Login_Time, Failed_Login_Attempts, Locked_Out) values(NULL ,'$firstName','$lastName','$email','$password', NULL, NULL, NULL,NULL,NULL, NULL, NULL, NULL, NULL, NULL,NULL);";
				echo "SQL = > " . $sql;
				$result=$dbc->query($sql);
				$count=$dbc->affected_rows;
            // if it is, set the session value to true
			 if($count == 1)
			 {
				 $_SESSION['name'] = $firstName;
				 echo "<div id='infoMesssage'>Thank you $firstName, You are in the system. Please let Kyle (Learning Center, English Side) know, so you're approved.</div>";
				
           ?>
		   <META HTTP-EQUIV="Refresh" CONTENT="1; URL=http://capstone.masterzcreations.com/login.php?action=waiting">
		   <?PHP
            } 
        }else{    
    ?>
 
    <!-- where the user will enter his username and password -->
    <form action="register.php" method="post">
     
	 <img src="plan/images/sample_logo_v3.png" id="loginHead">
        <div id="formHeader">User Registration</div>
         
        <div id="formBody">
		  <div class="formField"> 
               First Name <input type="text" name="firstName" placeholder="First Name" />
            </div>
			 <div class="formField"> 
               Last Name<input type="text" name="lastName" placeholder="Last Name" />
            </div>
            <div class="formField">
              UcEmail  <input type="text" name="email" placeholder="UC EMail" />
            </div>
             
            <div class="formField"> 
            Password    <input type="password" name="password" placeholder="Password" />
            </div>
			 <div class="formField"> 
             Password Again   <input type="password" name="password_confirm" placeholder="Password Again"  />
            </div>
			<div class="formField">
			<select>
			<option>Select Your Security Question</option>
			<option>Question</option>
			<div class="formField"> 
                <input type="text" name="security_confirm" placeholder="Answer"  />
            </div>
			</select>
			
             
          
            <div><input type='hidden' name='submit' />
                <input type="submit" value="register" class="customButton" />
				
            </div>
        </div>
         
    </form>
		<?PHP  } 
		
?>		
</div>
 
</body>
</html>