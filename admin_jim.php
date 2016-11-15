<?php
// ATTENTION: If you edit this page, update the "Last Update" information
// Admin Page
// Last Update: 04-04-2016 by: Patrick Voto

require('library.php');
require('nav.php');
$passwordInvalid = false; // Assume password is valid
$emailDuplicate = false; // Assume email is unique
$questionInvalid = false; // Assume question not hacked

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
}
?>
<body></body>
<div class="container">
    <h2>Admin Page</h2>
    <!-- form action will change later -->
    <form action="admin_jim.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users:
            </div>
            <div class ="row">
                
				
				<div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the admin rank. -->
                        <label for="Admin">Admin</label>
                        <select multiple class="form-control" id="Admin" name="Admin[]">
                            <?php
                            //SQL statement to arrange the users by the UserRankID of 1 which in this case is admin.
                            $pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
                            $results = $dbc->query($pAdminQuery);
                            echo $pAdminQuery;
                            while($row = $results->fetch_array())
                            {
                                echo "<option value='".$row["UserID"]. "'>"  . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the subject admin rank. -->
                        <label for="SubjectAdmin">Subject Admin:</label>
                        <select multiple class="form-control" id="SubjectAdmin" name="SubjectAdmin[]">
                            <?php
                            //SQL statement to arrange the users by the UserRankID of 2 which in this case is subject admin.
                            $pSubjectAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='2' ORDER BY LastName ASC";
                            $results = $dbc->query($pSubjectAdminQuery);
                            echo $pSubjectAdminQuery;
                            while($row = $results->fetch_array())
                            {
                                echo "<option value='".$row["UserID"]. "'>"  . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
				<div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the subject admin rank. -->
                        <label for="SubjectAdmin">User Info:</label>
                    </div>
                </div>
			</div>
            <div class ="row">
				<div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the faculty rank. -->
                        <label for="Faculty">Faculty:</label>
                        <select multiple class="form-control" id="Faculty" name="Faculty[]">
                            <?php
                            //SQL statement to arrange the users by the UserRankID of 3 which in this case is Faculty.
                            $pFacultyQuery = "SELECT * FROM tUser WHERE UserRankID ='3' ORDER BY LastName ASC";
                            $results = $dbc->query($pFacultyQuery);
                            echo $pFacultyQuery;
                            while($row = $results->fetch_array())
                            {
                                echo "<option value='".$row["UserID"]. "'>"  . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the read only rank. -->
                        <label for="ReadOnly">Read Only:</label>
                        <select multiple class="form-control"  id="ReadOnly" name="ReadOnly[]">
                            <?php
                            //SQL statement to arrange the users by the UserRankID of 4 which in this case is Read Only.
                            $pReadOnlyQuery = "SELECT * FROM tUser WHERE UserRankID ='4' ORDER BY LastName ASC";
                            $results = $dbc->query($pReadOnlyQuery);
                            echo $pReadOnlyQuery;
                            while($row = $results->fetch_array())
                            {
                                echo "<option value='".$row["UserID"]. "'>"  . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
				<div class="col-sm-4">
                    <div class="form-group">
                        <!-- This shows a list of every user with the read only rank. -->
                        <label for="ReadOnly">Read Only:</label>
                        <select multiple class="form-control"  id="ReadOnly" name="ReadOnly[]">
                            <?php
                            //SQL statement to arrange the users by the UserRankID of 4 which in this case is Read Only.
                            $pReadOnlyQuery = "SELECT * FROM tUser WHERE UserRankID ='4' ORDER BY LastName ASC";
                            $results = $dbc->query($pReadOnlyQuery);
                            echo $pReadOnlyQuery;
                            while($row = $results->fetch_array())
                            {
                                echo "<option value='".$row["UserID"]. "'>"  . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
				
            </div>
			
        </div>
    </form>
</div>


