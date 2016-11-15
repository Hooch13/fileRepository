<?PHP
include("loginCheck.php");
include("nav.php");
include("library.php");
$assignmentPath = "assignments/"; // if the folder where storing all the assignments is changed, you change it here.
// end session login
$SessionID = $_SESSION['UserID'];
// end session login


//print_r($_POST);
//print_r($_FILES);

$subject = $_POST['subject'];
$subjectFocus = $_POST['subjectFocus'];
$course = $_POST['course'];
$courseFocus = $_POST['courseFocus'];
$specialty = $_POST['specialty'];
$specialtyFocus = $_POST['specialtyFocus'];


$title = htmlspecialchars(cleaning($_POST['title']));
$comments = cleaning($_POST['comments']);
$description = cleaning($_POST['description']);
$gradeAssignment = $_POST['gradeAssignment'];
$rubricAvailable = $_POST['rubricAvailable'];
$fileName = cleaning($_FILES["fileToUpload"]["name"]);

//search query every time they select something from the previous page needs to be searched...
$searchQuery = "SELECT * FROM tAssignment JOIN  tUser on tAssignment.UserID = tUser.UserID WHERE 1";


if ((strlen($title)) > 0) {
    $searchQuery .= " AND Title LIKE '%$title%'";
}
if ((strlen($comments) > 0)) {
    $searchQuery .= " AND Comments LIKE '%$comments%'";
}
if ((strlen($description) > 0)) {
    $searchQuery .= " AND Description LIKE '%$description%'";
}
if ($gradeAssignment === "on") {
    $searchQuery .= " AND WillBeGraded = 'Y'";
}
if ($rubricAvailable === "on") {
    $searchQuery .= " AND RubricIncluded = 'Y'";
}
if (count($subject) > 0) {
    $tmpString = implode(",", $subject);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE SubjectID IN ($tmpString))";
}
if (count($specialty) > 0) {
    $tmpString = implode(",", $specialty);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE SpecialtyID IN ($tmpString))";
}
if (count($course) > 0) {
    $tmpString = implode(",", $course);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE CourseID IN ($tmpString))";
}
if (count($subjectFocus) > 0) {
    $tmpString = implode(",", $subjectFocus);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE FocusSubjectID IN ($tmpString))";
}
if (count($specialtyFocus) > 0) {
    $tmpString = implode(",", $specialtyFocus);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE FocusSpecialtyID IN ($tmpString))";
}
if (count($courseFocus) > 0) {
    $tmpString = implode(",", $courseFocus);
    $searchQuery .= " AND AssignmentID IN (SELECT AssignmentID FROM tAssignment_IntermediateSSC WHERE FocusCourseID IN ($tmpString))";
}
$searchQuery .= " GROUP BY AssignmentID";
//$searchQuery .= " GROUP BY AssignmentID";
//echo $searchQuery ;
$_SESSION["searchQuery"] = $searchQuery;


?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="tableStyle.css"><!-- style sheet for our tables -->
</head>
<div class="row">
    <div class="container">
        <div class="h2 text-center jumbotron">
            Results:
        </div>
    </div>
</div>

<div class="container">
    <kbd>Search results below</kbd>
    <div class="table-responsive">
        <table class="table" >
            <thead >
         <?PHP if($_SESSION["UserRank"] != 4) { ?>  <th class="col-sm-1">Download File</th> <?PHP } ?>
            <th class="col-md-3">Title</th>
            <th class="col-md-3">Description</th>

            <th class="col-sm-1">Author Willing To Grade</th>
            <th class="col-sm-1">Rubric Included</th>
            <th class="col-md-3">Upload Date</th>
            <th class="col-md-3">Uploaded By</th>

            </thead>
            <tbody>
            <tr>
                <!-- <ul id="searchResultList"> TEMP REMOVE -->
                    <?php
                    $results = $dbc->query($searchQuery);
                    $URL = "members.php?rid=";//URL for the link to profiles


                    while ($row = $results->fetch_array()) {

                        $ProfilePath = $URL. $row['UserID'];

                        if (strcmp($row['WillBeGraded'], "Y") == 0) {
                            $WBG = "Yes";
                        } else {
                            $WBG = "No";
                        }
                        if (strcmp($row['RubricIncluded'], "Y") == 0) {
                            $RI = "Yes";
                        } else {
                            $RI = "No";
                        }
                        //echo '<div class="rTableRow">';
                       if($_SESSION["UserRank"] != 4) {    echo '<td ><a href="' . $assignmentPath . $row['UserID'] . '/' . $row['File'] . '"><!-- <span class="glyphicon glyphicon-download"></span> -->
					   <img src="images/downloadIcon.png" style="width:50px"></a></div>'; }
                        echo '<td class="setWidthShort concat"><div>' . $row['Title'] . '</div></td>';
                        echo '<td class="setWidthLong concat"><div>' . $row['Description'] .'</div></td>';
                        echo '<td >' . $WBG . '</td>';
                        echo '<td >' . $RI . '</td>';
                        echo '<td >' . $row['DateTimeUploaded'] . '</td>';
                        echo '<td >' ?> <a href="<?php  if($_SESSION["UserRank"] != 4) { echo $ProfilePath; } else echo "#"; ?>"> <?php echo $row['LastName'] ?> </a> <?php echo  '</td>';
                        echo '</tr>';
                    }

                    ?>

                    </table>
                    </tbody>
            </div>
        </div> <!-- End of table -->


                </ul>
            </div>
            <!--/span 
            <object width="400" height="100%" data="searchResultsSideBar.php" name="searchResultsSideBar"></object>
            <!--/span-->
        </div>
    </div>
    <!--/row-->

</div>
<!--/.fluid-container-->


</html>