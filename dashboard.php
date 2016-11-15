<?PHP
session_start();
include("loginCheck.php");
include("ryan_library.php");
include("nav.php");
$assignmentPath = "assignments/"; // if the folder where storing all the assignments is changed, you change it here.
// end session login
$SessionID = $_SESSION['UserID'];

?>


<!-- Start content if Log in is successful -->
<html>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="tableStyle.css"><!-- style sheet for our tables -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/dashboard.css">
<?php
/*
?>
<style>
.rTable { display: table; width: 100%;}
.rTableRow { display: table-row; }
.rTableHeading { background-color: #ddd; display: table-header-group; }
.rTableCell, .rTableHead { display: table-cell; padding: 2px 5px; border: 1px solid #999999; }
.rTableHeading { display: table-header-group; background-color: #ddd; font-weight: bold; }
.rTableFoot { display: table-footer-group; font-weight: bold; background-color: #ddd; }
.rTableBody { display: table-row-group; }
</style>
*/
?>

<body>
<div class="container">
    <div class="jumbotron h1 text-center">
        Dashboard
        <!--JUMBO--></div>
    <div class="container">
        <kbd>Newest In All Departments</kbd>
        <!-- <div id="Newest"> -->
        <div class="table-responsive">
            <table class="table">
            <thead>
            <?PHP if($_SESSION["UserRank"] != 4) { ?>  <th  class="col-sm-1">Download File</th> <?PHP } ?>
            <th class="col-md-3">Title</th>
            <th class="col-md-3">Description</th>
            <th  class="col-sm-1">Author Willing To Grade</th>
            <th  class="col-sm-1">Rubric Included</th>
            <th class="col-md-3">Uploaded By</th>
            </thead>

            <tbody>
            <tr>
                <?PHP $qLatestAssigments = "SELECT * FROM tAssignment JOIN tUser on tAssignment.UserID = tUser.UserID ";
                $LatestAssigmentsResults = $dbc->query($qLatestAssigments);
                $URL = "members.php?rid=";



                while ($row = $LatestAssigmentsResults->fetch_array()) {

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
                    echo '';
                    $downloadURL = $assignmentPath . $row['UserID'] . '/' . $row['File'];

                 if($_SESSION["UserRank"] != 4) {  echo '<td><a href="' . $assignmentPath . $row['UserID'] . '/' . $row['File'] . '">
						<img src="images/downloadIcon.png" style="width:50px"></a></td>';
						}
                    echo '<td class="setWidthShort concat"><div>' . $row['Title'] . '</div></td>';
                    echo '<td class="setWidthLong conat"><div>' . $row['Description'] . '</div></td>';
                    echo '<td >' . $WBG . '</td>';
                    echo '<td >' . $RI . '</td>';
                    echo '<td >' ?> <a href="<?php  if($_SESSION["UserRank"] != 4) { echo $ProfilePath; } else echo "#"; ?>"> <?php echo $row['LastName'] ?> </a> <?php echo  '</td>';
                    echo '</tr>';
                };
                ?>
            </tr>
            </table>
            </tbody>


        </div>
    </div> <!-- End of table -->
    <!--</div> <!-- End of Newest -->

    <br/>
	 <?PHP if($_SESSION["UserRank"] != 4) { ?> 
    <div class="container">
    <kbd>Recent Uploads By You</kbd>
        <div class="table-responsive">
        <table class="table">
            <thead>
            <th>Download File</th>
            <th>Title</th>
            <th>Description</th>

            <th>Author Willing To Grade</th>
            <th>Rubric Included</th>
            <th>Upload Date</th>
            </thead>
            <tbody>
            <tr>


                <?PHP $qLatestAssigments = "SELECT * FROM tAssignment WHERE UserID = '$SessionID'  ORDER BY DateTimeUploaded DESC limit 25";//Loads user specific assignments
                $LatestAssigmentsResults = $dbc->query($qLatestAssigments);
                while ($row = $LatestAssigmentsResults->fetch_array()) {
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
                    echo '<td class="col-sm-1"><a href="' . $assignmentPath . $row['UserID'] . '/' . $row['File'] . '"><!-- <span class="glyphicon glyphicon-download"></span> --> 
						<img src="images/downloadIcon.png" style="width:50px"></a></div>';
                    echo '<td class="col-md-3">' . $row['Title'] . '</td>';
                    echo '<td class="col-md-3">' . $row['Description'] . '</td>';
                    echo '<td class="col-sm-1">' . $WBG . '</td>';
                    echo '<td class="col-sm-1">' . $RI . '</td>';
                    echo '<td class="col-md-3">' . $row['DateTimeUploaded'] . '</td>';
                    echo '</tr>';
                }

                ?>

        </table>
        </tbody>
    </div>
	<?PHP  } ?>
       <!-- <form action="searchResults.php"> -->
            <a href="searchResults.php" class="btn btn-primary" value="SeeAll" >See All Assignments</a><!--Submit button-->
            <div class="data"></div>

        </form>
</div> <!-- End of table -->
</div>
</div>


<br/>

</div>
</body>
</html>