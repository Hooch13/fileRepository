<?php session_start();
include("loginCheck.php");
require('ryan_library.php');
include("nav.php"); 
$passwordInvalid = false; // Assume password is valid
$emailDuplicate = false; // Assume email is unique
$questionInvalid = false; // Assume question not hacked

	if(isset($_POST['submit']))
	{
		$user = new User();
	    $user->FirstName = cleaning($_POST["FirstName"]);
		$user->LastName = cleaning($_POST["LastName"]);
		$user->Email = cleaning($_POST["Email"]);
		$user->Bio = cleaning($_POST["Bio"]);
		$user->OfficeHours = cleaning($_POST["OfficeHours"]);
		$user->RoomNum = cleaning($_POST["RoomNumber"]);
		$user->Phone = cleaning($_POST["PhoneNumber"]);
		$user->UserRankID = $_SESSION["UserRank"];
		$user->UserID = $_SESSION["UserID"];
		$user->PreferredContactMethod = cleaning($_POST["PreferredContactMethod"]);
		?>
		<pre>
           
		<?PHP 
		//print_r($user);
		//print_r($_SESSION);
		$result = UpdateUser($user,$dbc);
		//echo $result;
		
		?>
		</pre>
		<?PHP
	}
/* OLD FORM VERSION of uploads, degre

if(isset($_POST['submit'])) {
    $user = new User();
    $user->FirstName = $_POST["FirstName"];
    $user->LastName = $_POST["LastName"];
    $user->Email = $_POST["Email"];
    $user->Password = CreateSecurePassword($_POST["Password"]);
    $user->SecurityQuestionID = $_POST["SecurityQuestionID"];
    $user->SecurityQuestionAnswer = $_POST["SecurityQuestionAnswer"];
    $user->UserRankID = 3;

    if(strlen($_POST["Password"]) < 8 || strlen($_POST["Password"]) > 30) { // Invalid password
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
} */
$pProfileQuery = "SELECT * FROM tUser WHERE UserID = ".$_SESSION['UserID'];
//echo "<br>Query -->" . $pProfileQuery;
$results = $dbc->query($pProfileQuery);

 while($row = $results->fetch_array())
 {
 
?>

<div class="container">
<div class=" jumbotron h2 text-center">Update Profile</div>
<div class="container" id="betterRegForm">
<img class="UserImage"src="images/noImage.png" style="width:150px" alt="Coming Soon">
<form role="form" action="profile.php" method="post">
    <div class="form-group">
        <label for="FirstName">First Name:</label>
        <input type="text" class="form-control" id="FirstName" name="FirstName" 
		value="<?PHP echo $row["FirstName"]; ?>">
    </div>
    <div class="form-group">
        <label for="LastName">Last Name:</label>
        <input type="text" class="form-control" id="LastName" name="LastName" 
		value="<?PHP echo $row["LastName"]; ?>">
    </div>
    <div class="form-group">
        
        <label for="Email">Email address:</label>
        <input type="text" class="form-control" id="Email" name="Email" 
		value="<?PHP echo $row["Email"]; ?>">
    </div>
    <div class="form-group">
        <label for="Bio">Bio</label>
        <input type="Text" class="form-control" id="Bio" name="Bio" 
		value="<?PHP if(is_null($row["Bio"])){echo "";}else{ echo $row["Bio"];	}?>">
    </div>
    <div class="form-group">
        <label for="OfficeHours">Office Hours</label>
        <input type="Text" class="form-control" id="OfficeHours" name="OfficeHours" 
		value="<?PHP if(is_null($row["OfficeHours"])){echo "";}else{ echo $row["OfficeHours"];	}?>">
    </div>
    <div class="form-group">
        <label for="Bio">Room Number</label>
        <input type="Text" class="form-control" id="RoomNumber" name="RoomNumber" 
		value="<?PHP if(is_null($row["RoomNum"])){echo "";}else{ echo $row["RoomNum"];	}?>">
    </div>
	<div class="form-group">
        <label for="Bio">Phone Number</label>
        <input type="Text" class="form-control" id="PhoneNumber" name="PhoneNumber" 
		value="<?PHP if(is_null($row["Phone"])){echo "";}else{ echo $row["Phone"];	}?>">
    </div>
	<div class="form-group">
        <label for="PreferredContactMethod">Preferred Contact Method</label>
        <input type="Text" class="form-control" id="PreferredContactMethod" name="PreferredContactMethod" 
		value="<?PHP if(is_null($row["PreferredContactMethod"])){echo "";}else{ echo $row["PreferredContactMethod"];	}?>">
    </div>
	
    <input type='hidden' name='submit' />
    <input type="submit" value="Update" />

</form>
    </div>
</div>
<?php
}
$dbc->close();
?>