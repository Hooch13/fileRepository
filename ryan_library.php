<?php
require('db_connect.php');
// a data entity class
$assignmentPath = "assignments/";
// strip data function
function cleaning($data)
{
    $data = trim($data);
    $data = htmlentities($data);
    $data = strip_tags($data);
    return $data;
}

// user class
class User
{
	public $UserID;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Bio;
    public $Password;
    public $OfficeHours;
    public $RoomNum;
    public $Phone;
    public $PreferredContactMethod;
    public $SecurityQuestionID;
    public $SecurityQuestionAnswer;
    public $LastLoginTime;
    public $FailedLoginAttempts;
    public $UserRankID;
}
function UpdateUser($user, $dbc)
{
	$precheckQuery = "SELECT * FROM tUser WHERE UserID = ". $user->UserID;
	$precheckResults = $dbc->query($precheckQuery);
	$resultsCheck = array();
	
	while($testrow = $precheckResults->fetch_array())
	{
		if(strcmp($user->FirstName,$testrow["FirstName"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET FirstName = '" . $user->FirstName . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[0] = "CHANGED";
		}
		if(strcmp($user->LastName,$testrow["LastName"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET LastName = '" . $user->LastName . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[1] = "CHANGED";
		}
		if(strcmp($user->Bio,$testrow["Bio"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET Bio = '" . $user->Bio . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[2] = "CHANGED";
		}
		if(strcmp($user->Email,$testrow["Email"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET Email = '" . $user->Email . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[3] = "CHANGED";
		}
		if(strcmp($user->OfficeHours,$testrow["OfficeHours"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET OfficeHours = '" . $user->OfficeHours . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[4] = "CHANGED";
		}
		if(strcmp($user->RoomNum,$testrow["RoomNum"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET RoomNum = '" . $user->RoomNum . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[5] = "CHANGED";
		}
		if(strcmp($user->Phone,$testrow["Phone"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET Phone = '" . $user->Phone . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[6] = "CHANGED";
		}
		if(strcmp($user->PreferredContactMethod,$testrow["PreferredContactMethod"]) != 0)
		{
			$updateQuery = "UPDATE tUser SET PreferredContactMethod = '" . $user->PreferredContactMethod . "' WHERE UserID = ". $user->UserID;
			$dbc->query($updateQuery);
			$resultsCheck[7] = "CHANGED";
		}
	}
	//echo "<pre>". print_r($resultsCheck) . "</pre>";
	
}
// create user based on user attributes and database connection
function CreateUser($user, $dbc)
{
    //query that inserts the user properties into the tUser table.
    $stmt = $dbc->prepare("INSERT INTO tUser(FirstName, LastName, Email, Bio, Password, OfficeHours, RoomNum, Phone, PreferredContactMethod, SecurityQuestionID, SecurityQuestionAnswer, LastLoginTime, FailedLoginAttempts, UserRankID)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssssssssssss', $firstName, $lastName, $email, $bio, $password, $officeHours, $roomNum, $phone, $preferredContactMethod, $securityQuestionID, $securityQuestionAnswer, $lastLoginTime, $failedLoginAttempts, $userRankID);
    $firstName              = $user->FirstName;
    $lastName               = $user->LastName;
    $email                  = $user->Email;
    $bio                    = $user->Bio;
    $password               = $user->Password;
    $officeHours            = $user->OfficeHours;
    $roomNum                = $user->RoomNum;
    $phone                  = $user->Phone;
    $preferredContactMethod = $user->PreferredContactMethod;
    $securityQuestionID     = $user->SecurityQuestionID;
    $securityQuestionAnswer = $user->SecurityQuestionAnswer;
    $lastLoginTime          = $user->LastLoginTime;
    $failedLoginAttempts    = $user->FailedLoginAttempts;
    $userRankID             = $user->UserRankID;

    // execute prepared statement
    $stmt->execute();
    if(mysqli_errno($dbc) === 1062) {
        // Duplicate error on email
        return -1;
    }
    else {
        // Account registered successfully
        return 0;
    }
}

function CreateSecurePassword($password)
{
    $encryptedPassword = md5($password);
    return $encryptedPassword;
}

function SecurityQuestionIDIsValid($securityQuestionID, $dbc) {
   //Check to see if the ID is valid in the database.
    //Check to see if there's a valid string
    //Validate the SecurityQuestionID exist in the database or did the person change it themselves?
        //
    $querySecurityQuestionID = "SELECT SecurityQuestionID FROM tSecurityQuestion WHERE SecurityQuestionID='$securityQuestionID'";
    $result = $dbc->query($querySecurityQuestionID);
    // mysql_num_rows=get number of rows in the result
    if($result->num_rows > 0){
        return true; // Placeholder
    }else{
        return false;
    }
}

// assignment class
class Assignment
{
    public $Title;
    public $Description;
    public $Comments;
    public $File;
    public $WillBeGraded;
    public $RubricIncluded;
    public $DateTimeUploaded;
    public $UserID;
    public $Subject;
    public $SubjectFocus;
    public $Specialty;
    public $SpecialtyFocus;
    public $Course;
    public $CourseFocus;
}

// create assignment based on assignment attributes and database connection
function CreateAssignment($assignment, $dbc)
{
    //query that inserts the assignment properties into the tAssignment table.
    $stmt = $dbc->prepare("INSERT INTO tAssignment(Title, Description, Comments, File, WillBeGraded, RubricIncluded, DateTimeUploaded, UserID)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssssss', $title, $description, $comments, $file, $willBeGraded, $rubricIncluded, $dateTimeUploaded, $userID);
    $title                       = $assignment->Title;
    $description                 = $assignment->Description;
    $comments                    = $assignment->Comments;
    $file                        = $assignment->File;
    $willBeGraded                = $assignment->WillBeGraded;
    $rubricIncluded              = $assignment->RubricIncluded;
    $dateTimeUploaded            = $assignment->DateTimeUploaded;
    $userID                      = $assignment->UserID;


    // execute prepared statement
    $stmt->execute();

    // return the assignmentid that was just created from the execute
    $last_id = mysqli_insert_id($dbc);


    return $last_id;
}

// function that relates the assignment that was created to its respective subject, specialty, and course.
function InsertIntermediate($last_id, $subject, $specialty, $course, $subjectFocus, $specialtyFocus, $courseFocus, $dbc) {

    echo "We are in the insertintermediate function on the library page <br>";
    // for each subject, specialty, and course they choose, relate that to the assignment they just uploaded.

    foreach ($subject as $v) {
        echo $v;
        $insertSubject = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, SubjectID) VALUES ($last_id, $v);";
        $dbc->query($insertSubject);
    }

    foreach ($specialty as $v) {
        $insertSpecialty = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, SpecialtyID) VALUES ($last_id, $v);";
    }

    foreach ($course as $v) {
        $insertCourse = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, CourseID) VALUES ($last_id, $v);";
    }

    foreach ($subjectFocus as $v) {
        $insertSubjectFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusSubjectID) VALUES ($last_id, $v);";
    }

    foreach ($specialtyFocus as $v) {
        $insertSpecialtyFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusSpecialtyID) VALUES ($last_id, $v);";
    }

    foreach ($courseFocus as $v) {
        $insertCourseFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusCourseID) VALUES ($last_id, $v);";
    }


}