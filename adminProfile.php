<?PHP 
include("library.php");
    $UserID = $_GET["uid"];
    /* SELECT column_name(s)
    FROM table1
    JOIN table2
    ON table1.column_name=table2.column_name;*/
	
    $profileQuery = "SELECT * FROM tUser, tUserRank
	  WHERE tUser.UserRankID = tUserRank.UserRankID
	  AND tUser.UserID = ". $UserID;
	$results = $dbc->query($profileQuery);

	$UserRankID = $_GET["userRankID"];
	

	if($_GET['round'] == 1)
	{
		echo "test round 1";
		if(isset($UserRankID)) 
		{
		//echo 'UserRankID = ' . $UserRankID;
		$pieces = explode("?",$UserRankID);	
		$rankQuery = "UPDATE tUser SET UserRankID =" . $pieces[0] . " WHERE tUser.UserID =" . $pieces[1];
		$dbc->query($rankQuery);
		}
		updatePage();
	}
if($_GET['round'] == 2)
	{
		echo "test round 2";
		updatePage();
	}	
function updatePage()
   {
	   //current issue, refreshes the info box...
	   ?>
	    <META HTTP-EQUIV="Refresh" CONTENT="3; URL=http://masterzcreations.com/college/capstone/admin_new.php">
	   <?PHP
   }
if($results) {
    while ($row = $results->fetch_array()) {
?>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
        <div>
            <div class="sidebar-nav-fixed pull-right affix" id="myAdminProfile">
                <div class="well">
                    <ul class="nav">
                        <li class="nav-header h5">First Name</li>
                        <li class="list-group-item"> <?PHP echo $row["FirstName"]; ?>
                        </li>

                        <li class="nav-header h5">Last Name</li>
                        <li class="list-group-item"><?PHP echo $row["LastName"]; ?>
                        </li>

                        <li class="nav-header h5">Rank</li>
                        <li class="list-group-item"><?PHP echo $row["UserRankName"]; ?>
                        </li>
						<br />
						<li class ="nav-header-h5">Change User Rank	
							<div class="dropdown text-center">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									$pAdminQuery = "SELECT * FROM tUserRank ORDER BY UserRankID ASC";
									$results = $dbc->query($pAdminQuery);
									while($row = $results->fetch_array())
									{
										$profileURL = 'adminProfile.php?userRankID='.  $row['UserRankID'] . '?' . $UserID . "&round=1";
										echo "<li><a href=". $profileURL ." target='_parent'>".$row["UserRankName"] . "</a></li>";			
									}
									?>
								</ul>
								<!-- <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/admin_new.php?round=2"> -->								
							</div>
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