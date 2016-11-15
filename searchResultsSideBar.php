<?PHP include("library.php");

$assignmentPath = "assignments/";
?>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">

<?PHP
$recordID = $_GET["rid"];
if (!isset($recordID)) {
    $recordID = 0;
}
/* SELECT column_name(s)
FROM table1
JOIN table2
ON table1.column_name=table2.column_name;*/
$assignmentQuery = "SELECT * FROM tAssignment JOIN tUser on tAssignment.UserID = tUser.UserID
      WHERE tAssignment.AssignmentID = " . $recordID;
//echo $assignmentQuery;
$results = $dbc->query($assignmentQuery);
if ($results) {
    while ($row = $results->fetch_array()) {
        ?>

        <div>
            <div class="sidebar-nav-fixed pull-right affix" id="mySidebarSearchResults">
                <div class="well">
                    <ul class="nav">
                        <?PHP $downloadURL = $assignmentPath . $row['UserID'] . '/' . $row['File']; ?>
                        <li class="nav-header h3 text-center"><a href="<?PHP echo $downloadURL; ?>">Download</a></li>

                        <li class="nav-header h5">Title</li>
                        <li class="list-group-item"> <?PHP echo $row["Title"]; ?>
                        </li>

                        <li class="nav-header h5">Description</li>
                        <li class="list-group-item"><?PHP echo $row["Description"]; ?>
                        </li>

                        <li class="nav-header h5">Will be Graded</li>
                        <li class="list-group-item"><?PHP echo $row["WillBeGraded"]; ?>
                        </li>

                        <li class="nav-header h5">Rubric Included</li>
                        <li class="list-group-item"><?PHP echo $row["WillBeGraded"]; ?>
                        </li>

                        <li class="nav-header h5">Date Uploaded</li>
                        <li class="list-group-item"><?PHP echo $row["DateTimeUploaded"]; ?>
                        </li>

                        <li class="nav-header h5">Uploaded By</li>
                        <li class="list-group-item"><?PHP echo $row["FirstName"] . " " . $row["LastName"]; ?>
                        </li>
                        <li class="nav-header h5">User Comments</li>
                        <li class="list-group-item"><span style="width:400px;"><?PHP echo $row["Comments"]; ?></span>

                        </li>

                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/sidebar-nav-fixed -->
        </div>

    <?PHP }
}

?>