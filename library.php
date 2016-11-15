<?php
require('db_connect.php');
// a data entity class
$assignments = "assignments/";
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

// create user based on user attributes and database connection
function CreateUser($user, $dbc)
{

    //query that inserts the user properties into the tUser table.
    $stmt = $dbc->prepare("INSERT INTO tUser(FirstName, LastName, Email, Bio, Password, OfficeHours, RoomNum, Phone, PreferredContactMethod, SecurityQuestionID, SecurityQuestionAnswer, LastLoginTime, FailedLoginAttempts, UserRankID)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssssssssssss', $firstName, $lastName, $email, $bio, $password, $officeHours, $roomNum, $phone, $preferredContactMethod, $securityQuestionID, $securityQuestionAnswer, $lastLoginTime, $failedLoginAttempts, $userRankID);

    $firstName = $user->FirstName;
    $lastName = $user->LastName;
    $email = $user->Email;
    $bio = $user->Bio;
    $password = $user->Password;
    $officeHours = $user->OfficeHours;
    $roomNum = $user->RoomNum;
    $phone = $user->Phone;
    $preferredContactMethod = $user->PreferredContactMethod;
    $securityQuestionID = $user->SecurityQuestionID;
    $securityQuestionAnswer = $user->SecurityQuestionAnswer;
    $lastLoginTime = $user->LastLoginTime;
    $failedLoginAttempts = $user->FailedLoginAttempts;
    $userRankID = $user->UserRankID;


    // execute prepared statement
    /*echo $user->FirstName;
    echo $user->LastName;
    echo $user->Email;
    echo $user->Bio;
    echo $user->Password;
    echo $user->OfficeHours;
    echo $user->RoomNum;
    echo $user->Phone;
    echo $user->PreferredContactMethod;
    echo $user->SecurityQuestionID;
    echo $user->SecurityQuestionAnswer;
    echo $user->LastLoginTime;
    echo $user->FailedLoginAttempts;
    echo $user->UserRankID;*/


    $stmt->execute();
    //if(!$stmt->execute()){trigger_error("there was an error....".$dbc->error, E_USER_WARNING);}
    //$last_id = mysqli_insert_id($dbc);

    //echo '$last_id= ' .$last_id;
    if (mysqli_errno($dbc) === 1062) {
        // Duplicate error on email
        return -1;
    } else {
        // Account registered successfully
        return 0;
    }
}

function CreateSecurePassword($password)
{
    $encryptedPassword = md5($password);
    return $encryptedPassword;
}

function SecurityQuestionIDIsValid($securityQuestionID, $dbc)
{
    //Check to see if the ID is valid in the database.
    //Check to see if there's a valid string
    //Validate the SecurityQuestionID exist in the database or did the person change it themselves?
    //
    $querySecurityQuestionID = "SELECT SecurityQuestionID FROM tSecurityQuestion WHERE SecurityQuestionID='$securityQuestionID'";
    $result = $dbc->query($querySecurityQuestionID);
    // mysql_num_rows=get number of rows in the result
    if ($result->num_rows > 0) {
        return true; // Placeholder
    } else {
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
    $title = $assignment->Title;
    $description = $assignment->Description;
    $comments = $assignment->Comments;
    $file = $assignment->File;
    $willBeGraded = $assignment->WillBeGraded;
    $rubricIncluded = $assignment->RubricIncluded;
    $dateTimeUploaded = $assignment->DateTimeUploaded;
    $userID = $assignment->UserID;


    // execute prepared statement
    $stmt->execute();

    // return the assignmentid that was just created from the execute
    $last_id = mysqli_insert_id($dbc);


    return $last_id;
}

// function that relates the assignment that was created to its respective subject, specialty, and course.
function InsertIntermediate($last_id, $subject, $specialty, $course, $subjectFocus, $specialtyFocus, $courseFocus, $dbc)
{

    // for each subject, specialty, and course they choose, relate that to the assignment they just uploaded.

    foreach ($subject as $v) {
        $insertSubject = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, SubjectID) VALUES ($last_id, $v);";
        $dbc->query($insertSubject);
    }

    foreach ($specialty as $v) {
        $insertSpecialty = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, SpecialtyID) VALUES ($last_id, $v);";
        $dbc->query($insertSpecialty);
    }

    foreach ($course as $v) {
        $insertCourse = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, CourseID) VALUES ($last_id, $v);";
        $dbc->query($insertCourse);
    }

    foreach ($subjectFocus as $v) {
        $insertSubjectFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusSubjectID) VALUES ($last_id, $v);";
        $dbc->query($insertSubjectFocus);
    }

    foreach ($specialtyFocus as $v) {
        $insertSpecialtyFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusSpecialtyID) VALUES ($last_id, $v);";
        $dbc->query($insertSpecialtyFocus);
    }

    foreach ($courseFocus as $v) {
        $insertCourseFocus = "INSERT INTO tAssignment_IntermediateSSC(AssignmentID, FocusCourseID) VALUES ($last_id, $v);";
        $dbc->query($insertCourseFocus);
    }
}

function UpdateAssignment($title, $description, $comments, $willBeGraded, $rubricIncluded, $dbc)
{   $updateTitle = "UPDATE tAssignment SET (Title=$title) WHERE AssignmentID=150";
         $dbc->update($updateTitle);
    $updateDesc= "UPDATE tAssignment SET (Description=$description) WHERE AssignmentID=150";
        $dbc->update($rubricIncluded);
    $updateComments="UPDATE tAssignment SET (Comments=$comments) WHERE AssignmentID=150";
        $dbc->update($updateComments);
    $updateWillBeGraded="UPDATE tAssignment SET (WillBeGraded=$willBeGraded) WHERE AssignmentID=150";
        $dbc->update($updateWillBeGraded);
    $updateRubric="UPDATE tAssignment SET (RubricIncluded=$rubricIncluded) WHERE AssignmentID=150";
    $dbc->update($updateRubric);

    //$stmt2->bind_param('sssss', $title, $description, $comments, $willBeGraded, $rubricIncluded);
    //$title = $assignment->Title;
   // $description = $assignment->Description;
    //$comments = $assignment->Comments;
   // $file = $assignment->File;
    //$willBeGraded = $assignment->WillBeGraded;
   // $rubricIncluded = $assignment->RubricIncluded;


    //query that inserts the assignment properties into the tAssignment table.
    //$stmt2 = $dbc->prepare("UPDATE tAssignment SET (Title=?, Description=?, Comments=?, WillBeGraded=?, RubricIncluded=?)
    //WHERE AssignmentID = 150");




    // execute prepared statement
    //$stmt2->execute();


}