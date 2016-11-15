<?PHP  session_start();
	include("loginCheck.php");
	include("nav.php");
	include("ryan_library.php");
	$max_length = 15;
	$assignmentPath = "assignments/";
	?>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/membersarea.css">
	
	<?PHP 
		$userID = cleaning($_GET["rid"]);
		if(!isset($_GET["rid"]))
		{
			allMembersDisplay($dbc);
		}
		else
		{
			displayOneMember($dbc, $userID, $assignmentPath);
		}
	
	function allMembersDisplay($dbc){
	
		$userQuery = "SELECT * FROM tUser WHERE UserRankID != 4"; 
		  
		$results = $dbc->query($userQuery);
		echo "<h2 class ='text-center'>Members List</h2>
		<div style='display:block; margin-left:auto;margin-right:auto;width:90%;'>"; 
		while($row = $results->fetch_array()) 
		{
			$UploadCountQuery = "SELECT * FROM tAssignment WHERE UserID = ". $row["UserID"]; 
			//echo "<!--" . $UploadCountQuery . "-->";
			$countResult = $dbc->query($UploadCountQuery);
			$count = $countResult->num_rows;
			$bioTemp = $row['Bio'];
			if(strlen($bioTemp) > $max_length)
			{ 
				$bio_out = substr($row['Bio'], 0,15);
				//$bio_out = $bioTemp ,0, $max_length);
			} 
			else { $bio_out = $row['Bio'];  } 
			$MemberDisplay = '<div class="UserBlock">
								 
									<img class="UserImage"src="images/noImage.png" alt="Coming Soon">
								 
								  
								<div class="userInfoBoxes"><!-- <span class="UserInfoLabel">Name</span> -->
									<span class="UserInfoLabel">Name:<br>'. $row['FirstName'].' '.$row['LastName'].' </span> </div>
								<div class="userInfoBoxes"><!-- <span class="UserInfoLabel">Bio</span>  --> 
									 <span class="UserInfoLabel" >Bio:'. $bio_out .'</span></div>
								<div class="userInfoBoxes"><span class="UserInfoLabel"># of Uploads</span>
									<span class="UserInfoLabel">'. $count.'</span>
									</div>';
									if($_SESSION['UserRank'] != 4)
									{
										$MemberDisplay.=
								'<a href="members.php?rid='. $row['UserID'] .'" class="userInfoProfileButton">View Profile</a>
							</div>';
									}else {
									$MemberDisplay.='</div>';
									}
									

			echo $MemberDisplay;
		}
		echo "</div>";
	}
	function displayOneMember($dbc, $viewID, $assignmentPath)
	{
		$userInfoQuery = "SELECT * FROM tUser where UserID = ". $viewID;
		$results = $dbc->query($userInfoQuery);
		while($row = $results->fetch_array()) 
		{
		$MemberDisplay = '<div class="UserProfile">
								 
									<img class="UserImage"src="images/noImage.png" alt="Coming Soon">
								 
								  
								<div class="userInfoProfile">Name:<br>'. $row['FirstName'].' '.$row['LastName'].'  </div>
								 <div class="userInfoProfile">Bio:<br>'. $row['Bio'].' </div>
								 <div class="userInfoProfile">EMail: <br><span class="glyphicon glyphicon-envelope"></span> '. $row['Email'].'</div>
								 <div class="userInfoProfile">Office Phone: <br><span class="glyphicon glyphicon-phone"></span>'. $row['Phone'].' </div>
								 <div class="userInfoProfile"> Office Location: <br><span class="glyphicon glyphicon-home"></span>'. $row['RoomNum'].' </div>
								 <div class="userInfoProfile">  Office Hours: <br><span class="glyphicon glyphicon-time"></span> '. $row['OfficeHours'].' </div>
								 <div class="userInfoProfile">Preferred Contact Method: <br><span class="glyphicon glyphicon-check"></span> '. $row['PreferredContactMethod'].' </div>
									</div>
								 
							</div>';
		$userUploads = '<div class="UserUploads"><h3 class ="text-center">'. $row['FirstName']. '\'s Uploads</h3>'. getUserAssignments($dbc,$viewID, $assignmentPath) .
		
		'</div>';
		 echo $MemberDisplay;
		 echo $userUploads;
		}
	}
	
	function getUserAssignments($dbc, $viewID, $assignmentPath)
	{
		$viewAssignmentsQuery = "SELECT * FROM tAssignment WHERE UserID = " . $viewID;
		$results = $dbc->query($viewAssignmentsQuery);
		if(!$results){}
		else{
		
		$output_table_header = '<div class="table-responsive"><table class="table">
             <thead>';
             if($_SESSION["UserRank"] != 4) { $output_table_header .='<th class="col-sm-1">Download File</th>'; }
			 $output_table_header .='
            <th class="col-md-2">Title</th>
            <th class="col-md-3">Description</th>
            <!--<h3 class="rTableHeading">Subject</h3> -->
            <th class="col-sm-1">Author willing to grade</th>
            <th class="col-sm-3">Comments</th>
            <th class="col-sm-1">Rubric Included</th>
            <th class="col-sm-1">Edit Assignment</th>
            
            </thead>

            <tbody>';
		 
		
		while($row = $results->fetch_array())
		{
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
			$downloadURL = $assignmentPath . $row['UserID'] . '/' . $row['File'];
			$editURL = "editAssignment.php?id=";
			//$_SESSION['AssignmentIDFromEditAssignment'] = $row['AssignmentID'];
			$output_body .= '<tr><td ><a href="' . $downloadURL. '">
					<img src="images/downloadIcon.png" style="width:50px"></a></td>
                    <td >' . $row['Title'] . '</td>
                    <td >' . $row['Description'] . '</td>
                    <td >' . $WBG . '</td>
					<td >' . $row['Comments'] . '</td>
                    <td >' . $RI . '</td>
					<td ><a href="' . $editURL. $row['AssignmentID'] . '"><img src="images/editLogo.png" style="width:50px"></a></td></tr>';




		}
		 return $output_table_header. $output_body. "</div>";
		}
	}
?>