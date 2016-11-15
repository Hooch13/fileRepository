<?PHP session_start();
	include("nav.php");
	include("library.php");
	function editAssignment($dbc, $viewID, $AssignmentID, $assignmentPath)
	{
		$getAssignDetails = "SELECT * FROM tAssignment WHERE UserID = " . $viewID. "AND AssignmentID = ". $AssignmentID;
		$results = $dbc->query($getAssignDetails);
		
	}
	function getUserAssignments($dbc, $viewID, $assignmentPath)
	{
		$viewAssignmentsQuery = "SELECT * FROM tAssignment WHERE UserID = " . $viewID;
		$results = $dbc->query($viewAssignmentsQuery);
		if(!$results){}
		else{
		
		$output_table_header = '<div class="table-responsive"><table class="table">
            <thead>
            <th>Download File</th>
            <th>Title</th>
            <th>Description</th>
            <!--<h3 class="rTableHeading">Subject</h3> -->
            <th>Will Be Graded</th>
            <th>Rubric Included</th>
            
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
			 
			$output_body .= '<tr><td class="col-sm-1"><a href="' . $downloadURL. '">
						<img src="images/downloadIcon.png" style="width:50px"></a></td>
                    <td class="col-md-3">' . $row['Title'] . '</td>
                    <td class="col-md-3">' . $row['Description'] . '</td> 
                    <td class="col-sm-1">' . $WBG . '</td> 
                    <td class="col-sm-1">' . $RI . '</td></tr>';
		}
		 return $output_table_header. $output_body. "</div>";
		}
	}
?>