<?php session_start();
require('library.php');
include("nav.php"); 
$passwordInvalid = false; // Assume password is valid
$emailDuplicate = false; // Assume email is unique
$questionInvalid = false; // Assume question not hacked

/* if(isset($_POST['submit'])) {
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


<div class="container jumbotron h2 text-center">Profile</div>
<div class="container">
<form role="form" action="profile_update.php" method="post">
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
	
    <input type='hidden' name='submit' />
    <input type="submit" value="Update" />

</form>
    </div>

<?php
}
$dbc->close();
?>