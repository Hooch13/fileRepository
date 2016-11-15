<?php
// check for valid login
include("loginCheck.php");
include("library.php");
include("nav.php");


// set URL for hyperlinks on this page .. change this line if site is moved to new server
$page_name = "http://masterzcreations.com/college/capstone/admin.php?";

// set the number of rows to display in each table before having to go to next page
$rowLimit = 10;

// **************************************************************************************
// handle POST actions
// **************************************************************************************
// apply filter to user rank if selected
if (isset($_GET['rankFilter'])) {
	if ($_GET['rankFilter'] == 'all') {
		$rank_filter = null;
	} else {
		$rank_filter = $_GET['rankFilter'];
	}
} else {
	$rank_filter = null;
}

// apply filter to user last name if selected
if (isset($_GET['lnFilter'])) {
	if ($_GET['lnFilter'] == 'all') {
		$ln_filter = null;
	} else {
		$ln_filter = $_GET['lnFilter'];
	}
} else {
	$ln_filter = null;
}

// apply filter to first letter of subject if selected
if (isset($_GET['subjectFilter'])) {
	if ($_GET['subjectFilter'] == 'all') {
		$subject_filter = null;
	} else {
		$subject_filter = $_GET['subjectFilter'];
	}
} else {
	$subject_filter = null;
}

// apply filter to first letter of specialty if selected
if (isset($_GET['specialtyFilter'])) {
	if ($_GET['specialtyFilter'] == 'all') {
		$specialty_filter = null;
	} else {
		$specialty_filter = $_GET['specialtyFilter'];
	}
} else {
	$specialty_filter = null;
}

// apply filter to first letter of course if selected
if (isset($_GET['courseFilter'])) {
	if ($_GET['courseFilter'] == 'all') {
		$course_filter = null;
	} else {
		$course_filter = $_GET['courseFilter'];
	}
} else {
	$course_filter = null;
}

// determine which page of rows to display in users table
$userRowStart=$_GET['userRowStart'];
if(strlen($userRowStart) > 0) {
	$userRowStart = $userRowStart - 0;
} else {
	$userRowStart = 0;
}
$userBack = $userRowStart - $rowLimit;
$userNext = $userRowStart + $rowLimit;

// determine which page of rows to display in subjects table
$subjectRowStart=$_GET['subjectRowStart'];
if(strlen($subjectRowStart) > 0) {
	$subjectRowStart = $subjectRowStart - 0;
} else {
	$subjectRowStart = 0;
}
$subjectBack = $subjectRowStart - $rowLimit;
$subjectNext = $subjectRowStart + $rowLimit;

// determine which page of rows to display in specialties table
$specialtyRowStart=$_GET['specialtyRowStart'];
if(strlen($specialtyRowStart) > 0) {
	$specialtyRowStart = $specialtyRowStart - 0;
} else {
	$specialtyRowStart = 0;
}
$specialtyBack = $specialtyRowStart - $rowLimit;
$specialtyNext = $specialtyRowStart + $rowLimit;

// determine which page of rows to display in courses table
$courseRowStart=$_GET['courseRowStart'];
if(strlen($courseRowStart) > 0) {
	$courseRowStart = $courseRowStart - 0;
} else {
	$courseRowStart = 0;
}
$courseBack = $courseRowStart - $rowLimit;
$courseNext = $courseRowStart + $rowLimit;

// update user rank
if (isset($_GET['userID']) && isset($_GET['editRank'])) {
	$userid_selected = $_GET['userID'];
	$new_rank = $_GET['editRank'];
	$userUpdateQuery = "UPDATE tUser SET UserRankID = " . $new_rank . " WHERE UserID = " . $userid_selected;
    $userUpdateResults = $dbc->query($userUpdateQuery);
    if ($dbc->error) {
        echo "<div class='container'><div class='alert alert-danger'>There was an SQL error in your request.</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-success'>The user was successfully updated!</div></div>";
    }
}

// delete user
if (isset($_GET['delete_user'])) {
	$userid_deleted = $_GET['delete_user'];
	$userDeleteQuery = "DELETE FROM tUser WHERE UserID = " . $userid_deleted;
    $userDeleteResults = $dbc->query($userDeleteQuery);
    if ($dbc->error) {
		echo "<div class='container'><div class='alert alert-danger'>This user is associated with assignments and cannot be deleted.</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-success'>The user was deleted.</div></div>";
    }
}

// update subject name
if (isset($_POST['newSubjectName'])) {
	if (strlen($_POST['SubjectID']) > 0) {
		$subjectid_selected = $_POST['SubjectID'];
		$new_subject = $_POST['newSubjectName'];
		$subjectUpdateQuery = "UPDATE tSubject SET Subject = '" . TRIM($new_subject) . "' WHERE SubjectID = " . $subjectid_selected;
		$subjectUpdateResults = $dbc->query($subjectUpdateQuery);
		if ($dbc->error) {
			echo "<div class='container'><div class='alert alert-danger'>There was an SQL error in your request.</div></div>";
		} else {
			echo "<div class='container'><div class='alert alert-success'>The subject was successfully updated!</div></div>";
		}
	}
}

// delete subject
if (isset($_GET['delete_subject'])) {
	$subjectid_deleted = $_GET['delete_subject'];
	$subjectDeleteQuery = "DELETE FROM tSubject WHERE SubjectID = " . $subjectid_deleted;
	$subjectDeleteResults = $dbc->query($subjectDeleteQuery);
    if ($dbc->error) {
		echo "<div class='container'><div class='alert alert-danger'>This subject is associated with assignments and cannot be deleted.</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-success'>The subject was deleted.</div></div>";
    }
}

// update specialty name
if (isset($_POST['newSpecialtyName'])) {
	if (strlen($_POST['SpecialtyID']) > 0) {
		$specialtyid_selected = $_POST['SpecialtyID'];
		$new_specialty = $_POST['newSpecialtyName'];
		$specialtyUpdateQuery = "UPDATE tSpecialty SET Specialty = '" . TRIM($new_specialty) . "' WHERE SpecialtyID = " . $specialtyid_selected;
		$specialtyUpdateResults = $dbc->query($specialtyUpdateQuery);
		if ($dbc->error) {
			echo "<div class='container'><div class='alert alert-danger'>There was an SQL error in your request.</div></div>";
		} else {
			echo "<div class='container'><div class='alert alert-success'>The specialty was successfully updated!</div></div>";
		}
	}
}

// delete specialty
if (isset($_GET['delete_specialty'])) {
	$specialtyid_deleted = $_GET['delete_specialty'];
	$specialtyDeleteQuery = "DELETE FROM tSpecialty WHERE SpecialtyID = " . $specialtyid_deleted;
	$specialtyDeleteResults = $dbc->query($specialtyDeleteQuery);
    if ($dbc->error) {
		echo "<div class='container'><div class='alert alert-danger'>This specialty is associated with assignments and cannot be deleted.</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-success'>The specialty was deleted.</div></div>";
    }
}

// update course name
if (isset($_POST['newCourseName'])) {
	if (strlen($_POST['CourseID']) > 0) {
		$courseid_selected = $_POST['CourseID'];
		$new_course = $_POST['newCourseName'];
		$courseUpdateQuery = "UPDATE tCourse SET Course = '" . TRIM($new_course) . "' WHERE CourseID = " . $courseid_selected;
		$courseUpdateResults = $dbc->query($courseUpdateQuery);
		if ($dbc->error) {
			echo "<div class='container'><div class='alert alert-danger'>There was an SQL error in your request.</div></div>";
		} else {
			echo "<div class='container'><div class='alert alert-success'>The course was successfully updated!</div></div>";
		}
	}
}

// delete course
if (isset($_GET['delete_course'])) {
	$courseid_deleted = $_GET['delete_course'];
	$courseDeleteQuery = "DELETE FROM tCourse WHERE CourseID = " . $courseid_deleted;
	$courseDeleteResults = $dbc->query($courseDeleteQuery);
    if ($dbc->error) {
		echo "<div class='container'><div class='alert alert-danger'>This course is associated with assignments and cannot be deleted.</div></div>";
    } else {
        echo "<div class='container'><div class='alert alert-success'>The course was deleted.</div></div>";
    }
}
// *****************************************************************************************************
// end POST actions
// *****************************************************************************************************
?>
<script type="text/javascript">
    function toggleDiv(divId) {

        $("#" + divId).toggle();
    }
	// show/hide divs that allow for editing and delete confirmations
	// populate input text boxes with subject, specialty, course names prior to editing
    function showonlyone(thechosenone, editInputBox1, editInputBox2) {
        $('.newboxes').each(function (index) {
            if ($(this).attr("id") == thechosenone) {
                $(this).show(200);
				if ($(this).attr("id") == "editSubjectBox") {
					document.getElementById("SubjectID").value = document.getElementById(editInputBox1).value;
					document.getElementById("oldSubjectName").value = document.getElementById(editInputBox2).value;
					document.getElementById("newSubjectName").value = document.getElementById(editInputBox2).value;
				} else if ($(this).attr("id") == "editSpecialtyBox") {
					document.getElementById("SpecialtyID").value = document.getElementById(editInputBox1).value;
					document.getElementById("oldSpecialtyName").value = document.getElementById(editInputBox2).value;
					document.getElementById("newSpecialtyName").value = document.getElementById(editInputBox2).value;
				} else if ($(this).attr("id") == "editCourseBox") {
					document.getElementById("CourseID").value = document.getElementById(editInputBox1).value;
					document.getElementById("oldCourseName").value = document.getElementById(editInputBox2).value;
					document.getElementById("newCourseName").value = document.getElementById(editInputBox2).value;
				}
			} else {
                $(this).hide(600);
            }
		})
    };
	
</script>

<body>

<div class="container"">
    <h2><center>Administration Page</center></h2>
	<form action="admin.php" method="post" enctype="multipart/form-data">
    <div class="panel panel-default" style="min-width: 500;">
	
	<div class="panel-heading" style="min-width: 500;">
		<strong><center><h3>Users</h3></center></strong>
	</div>
	<div class="panel-body" style="min-width: 500; overflow-x: scroll;">      
		
		<table align="center" id="userFilterTable" style="width:50%; min-width:450px; max-width:550px;">
			<tr>
				<td align="right">
					Filter by Last Name: 
						<select name="LNFilter" onchange="window.location.href=this.value">
							<?PHP $pLNFilterQuery = "SELECT DISTINCT upper(left(LastName,1)) AS ln FROM tUser ORDER BY ln ASC";
                                  $lnFilterResults = $dbc->query($pLNFilterQuery);
								  if (is_null($ln_filter)) {
									  echo "<option value='" . $page_name . "lnFilter=all' SELECTED>All</option>";
								  } else {
									  echo "<option value='" . $page_name . "lnFilter=all'>All</option>";
								  }
								  while ($lnFilterRow = $lnFilterResults->fetch_array()) {
									  if ($lnFilterRow['ln'] == $ln_filter) {
										  echo "<option value='" . $page_name . "lnFilter=" . $lnFilterRow['ln'] . "' SELECTED>" . $lnFilterRow['ln'] . "</option>";
									  } else {
										  echo "<option value='" . $page_name . "lnFilter=" . $lnFilterRow['ln'] . "'>" . $lnFilterRow['ln'] . "</option>";
									  }
                                  }
						    ?>
						</select>
					&nbsp;&nbsp;&nbsp;
					Filter by rank: 
						<select name="RankFilter" onchange="window.location.href=this.value">
							<?PHP $pRankFilterQuery = "SELECT * FROM tUserRank ORDER BY UserRankID ASC";
                                  $RankFilterResults = $dbc->query($pRankFilterQuery);
								  if (is_null($rank_filter)) {
									  echo "<option value='" . $page_name . "rankFilter=all' SELECTED>All Ranks</option>";
								  } else {
									  echo "<option value='" . $page_name . "rankFilter=all'>All Ranks</option>";
								  }
								  while ($RankFilterRow = $RankFilterResults->fetch_array()) {
									  if ($RankFilterRow['UserRankID'] == $rank_filter) {
										  echo "<option value='" . $page_name . "rankFilter=" . $RankFilterRow['UserRankID'] . "' SELECTED>" . $RankFilterRow['UserRankName'] . "</option>";
									  } else {
										  echo "<option value='" . $page_name . "rankFilter=" . $RankFilterRow['UserRankID'] . "'>" . $RankFilterRow['UserRankName'] . "</option>";
									  }
                                  }
						    ?>
						</select>
				</td>
			</tr>
		</table>
        <table align="center" id="userTable" style="width:50%; min-width:450px; max-width:550px; border: 1px solid black;">
            <tr style="background-color: lightgrey;">
                <th>Name</th>
				<th>Rank</th>
                <th>Options</th>
            </tr>

            <?PHP
            if (is_null($rank_filter)) {
				if (is_null($ln_filter)) {
					$pUserQuery = "SELECT * FROM tUser JOIN tUserRank ON tUser.UserRankID = tUserRank.UserRankID ORDER BY tUser.LastName ASC";
				} else {
					$pUserQuery = "SELECT * FROM tUser JOIN tUserRank ON tUser.UserRankID = tUserRank.UserRankID WHERE UPPER(LEFT(tUser.LastName,1)) = '" . $ln_filter . "' ORDER BY tUser.LastName ASC";
				}
			}
			else {
				if (is_null($ln_filter)) {
					$pUserQuery = "SELECT * FROM tUser JOIN tUserRank ON tUser.UserRankID = tUserRank.UserRankID WHERE tUserRank.UserRankID = " . $rank_filter . " ORDER BY tUser.LastName ASC";
				} else {
					$pUserQuery = "SELECT * FROM tUser JOIN tUserRank ON tUser.UserRankID = tUserRank.UserRankID WHERE tUserRank.UserRankID = " . $rank_filter . " AND UPPER(LEFT(tUser.LastName,1)) ='" . $ln_filter . "' ORDER BY tUser.LastName ASC";
				}
			}
			
			$UserResultsAll = $dbc->query($pUserQuery);
			$userNumRows = mysqli_num_rows($UserResultsAll);
			$UserResults = $dbc->query($pUserQuery . " LIMIT ". $userRowStart . ", " . $rowLimit);
						
            while ($UserRow = $UserResults->fetch_array()) {
                ?>

                <tr style="border: 1px solid black">

                    <td>
                        <?PHP echo $UserRow['LastName'] . ", " . $UserRow['FirstName']; ?>
                    </td>
					<td>
						<?PHP echo $UserRow['UserRankName']; ?>
					</td>
                    <td>
                        <div>
                            <a id='editIcon<?PHP echo $UserRow['UserID']; ?>' title='Change Rank'
                               href='javascript:showonlyone("editbox<?PHP echo $UserRow['UserID']; ?>");'>
                                <span class='glyphicon glyphicon-pencil'></span>
                            </a>
                            <a id='deleteIcon<?PHP echo $UserRow['UserID']; ?>' title='Delete User'
                               href='javascript:showonlyone("deletebox<?PHP echo $UserRow['UserID']; ?>");'>
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=3>
                        <div class="newboxes" id="editbox<?PHP echo $UserRow['UserID']; ?>"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            Current Rank: <b><?PHP echo $UserRow["UserRankName"]; ?></b><br>
                            Select New Rank:&nbsp;&nbsp;
                            <select name="NewRank" onchange="window.location.href=this.value">
								<option value=''></option>
                                <?PHP
                                $pRankQuery = "SELECT * FROM tUserRank ORDER BY UserRankID ASC";
                                $RankResults = $dbc->query($pRankQuery);
                                while ($RankRow = $RankResults->fetch_array()) {
                                    echo "<option value='" . $page_name . "userID=" . $UserRow['UserID'] . "&editRank=" . $RankRow['UserRankID'] . "'>" . $RankRow['UserRankName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=3>
                        <div class="newboxes" id="deletebox<?PHP echo $UserRow['UserID']; ?>"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <a href='<?PHP echo $page_name; ?>delete_user=<?PHP echo $UserRow['UserID']; ?>'>Delete User?</a>
                        </div>
                    </td>
                </tr>


                <?PHP
            }
            ?>
        </table>
		
		<table align="center" id="userNavTable" style="width:50%; min-width:450px; max-width:550px;">
		<tr>
			<td align='left' width='30%'>
				<?PHP if($userBack >=0) {
						$user_back_page_name = $page_name;
						if ($rankFilter != null) {
							$user_back_page_name .= "rankFilter=" . $rankFilter . "&";
						}
						if ($lnFilter != null) {
							$user_back_page_name .= "lnFilter=" . $lnFilter . "&";
						}
						echo "<a href='" . $user_back_page_name . "&userRowStart=" . $userBack . "'><font face='Verdana' size='2'>PREV</font></a>";
					  }
				?>
			</td>
			<td align=center width='30%'>
				<?PHP $i = 0;
					  $l = 1;
					  $user_target_page_name = $page_name;
					  if ($rankFilter != null) {
						$user_target_page_name .= "rankFilter=" . $rankFilter . "&";
						}
					  if ($lnFilter != null) {
						$user_target_page_name .= "lnFilter=" . $lnFilter . "&";
					  }
					  for($i=0; $i<$userNumRows; $i=$i+$rowLimit) {
						if($i <> $userRowStart) {
							echo "<a href='" . $user_target_page_name . "userRowStart=" . $i . "'><font face='Verdana' size='2'>" . $l . "</font></a>";
					    } else {
						    echo "<font face='Verdana' size='4' color=red>" . $l . "</font>";
						}  // Current page is not displayed as link and given font color red
					  $l = $l + 1;
					  }
				?>
			</td>
			<td align='right' width='30%'>
				<?PHP if($userNext < $userNumRows) {
						$user_next_page_name = $page_name;
						if ($rankFilter != null) {
							$user_next_page_name .= "rankFilter=" . $rankFilter . "&";
							}
						if ($lnFilter != null) {
							$user_next_page_name .= "lnFilter=" . $lnFilter . "&";
						}
					  echo "<a href='" . $user_next_page_name . "userRowStart=" . $userNext . "'><font face='Verdana' size='2'>NEXT</font></a>";
					  }
				?>
			</td>
		</tr>
		</table>
	</div>				

	<div class="panel-heading" style="min-width: 500;">
        <strong><center><h3>Subjects</h3></center></strong>
    </div>
    <div class="panel-body" style="min-width: 500; overflow-x: scroll;">
    
		<table align="center" id="subjectFilterTable" style="width:50%; min-width:450px; max-width:550px;">
			<tr>
				<td align="right">
					Filter by Subject: 
						<select name="SubjectFilter" onchange="window.location.href=this.value">
							<?PHP $pSubjectFilterQuery = "SELECT DISTINCT UPPER(LEFT(SUBJECT,1)) AS subj FROM tSubject ORDER BY subj ASC";
                                  $subjectFilterResults = $dbc->query($pSubjectFilterQuery);
								  if (is_null($subject_filter)) {
									  echo "<option value='" . $page_name . "subjectFilter=all' SELECTED>All</option>";
								  } else {
									  echo "<option value='" . $page_name . "subjectFilter=all'>All</option>";
								  }
								  while ($subjectFilterRow = $subjectFilterResults->fetch_array()) {
									  if ($subjectFilterRow['subj'] == $subject_filter) {
										  echo "<option value='" . $page_name . "subjectFilter=" . $subjectFilterRow['subj'] . "' SELECTED>" . $subjectFilterRow['subj'] . "</option>";
									  } else {
										  echo "<option value='" . $page_name . "subjectFilter=" . $subjectFilterRow['subj'] . "'>" . $subjectFilterRow['subj'] . "</option>";
									  }
                                  }
						    ?>
						</select>
				</td>
			</tr>
		</table>
        <table align="center" id="subjectTable" style="width:50%; min-width:450px; max-width:550px; border: 1px solid black;">
            <tr style="background-color: lightgrey;">
                <th>Subject</th>
				<th>Options</th>
            </tr>

            <?PHP
            if (is_null($subject_filter)) {
				$pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
				} else {
					$pSubjectQuery = "SELECT * FROM tSubject WHERE UPPER(LEFT(Subject,1)) = '" . $subject_filter . "' ORDER BY Subject ASC";
				}
									
			$SubjectResultsAll = $dbc->query($pSubjectQuery);
			$subjectNumRows = mysqli_num_rows($SubjectResultsAll);
			$SubjectResults = $dbc->query($pSubjectQuery . " LIMIT ". $subjectRowStart . ", " . $rowLimit);
						
            while ($SubjectRow = $SubjectResults->fetch_array()) {
                ?>

                <tr style="border: 1px solid black">

                    <td>
                        <?PHP echo $SubjectRow['Subject']; ?>
						<input type="hidden" id="hiddenSubjectID<?PHP echo $SubjectRow['SubjectID'] ?>" name="hiddenSubjectID<?PHP echo $SubjectRow['SubjectID'] ?>" value="<?PHP echo $SubjectRow['SubjectID']; ?>"></input>
						<input type="hidden" id="hiddenSubjectName<?PHP echo $SubjectRow['SubjectID'] ?>" name="hiddenSubjectName<?PHP echo $SubjectRow['SubjectID'] ?>" value="<?PHP echo $SubjectRow['Subject']; ?>"></input>
                    </td>
					<td>
                        <div>
                            <a id='editIcon<?PHP echo $SubjectRow['SubjectID']; ?>' title='Edit Subject'
                               href='javascript:showonlyone("editSubjectBox", "hiddenSubjectID<?PHP echo $SubjectRow['SubjectID'] ?>", "hiddenSubjectName<?PHP echo $SubjectRow['SubjectID'] ?>")'>
                                <span class='glyphicon glyphicon-pencil'></span>
                            </a>
                            <a id='deleteIcon<?PHP echo $SubjectRow['SubjectID']; ?>' title='Delete Subject'
                               href='javascript:showonlyone("deleteSubjectBox<?PHP echo $SubjectRow['SubjectID']; ?>");'>
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <div class="newboxes" id="deleteSubjectBox<?PHP echo $SubjectRow['SubjectID']; ?>"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <a href='<?PHP echo $page_name; ?>delete_subject=<?PHP echo $SubjectRow['SubjectID']; ?>'>Delete Subject?</a>
                        </div>
                    </td>
                </tr>


                <?PHP
            }
			?>
				<tr>
                    <td colspan=2>
                        <div class="newboxes" id="editSubjectBox" name="editSubjectBox"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <input type="hidden" id="SubjectID" name="SubjectID" value="">
							Current Subject Text: <input style="background-color: transparent;" type="text" id="oldSubjectName" name="oldSubjectName" value="" readonly><br>
							Enter New Subject Text:<input type="text" id="newSubjectName" name="newSubjectName" value="">
							<input type="submit" name="submit" value="Save Changes">
                        </div>
                    </td>
				</tr>
        </table>
	
		<table align="center" id="subjectNavTable" style="width:50%; min-width:450px; max-width:550px;">
		<tr>
			<td align='left' width='30%'>
				<?PHP if($subjectBack >=0) {
						$subject_back_page_name = $page_name;
						if ($subjectFilter != null) {
							$subject_back_page_name .= "subjectFilter=" . $subjectFilter . "&";
						}
						echo "<a href='" . $subject_back_page_name . "&subjectRowStart=" . $subjectBack . "'><font face='Verdana' size='2'>PREV</font></a>";
					  }
				?>
			</td>
			<td align=center width='30%'>
				<?PHP $i = 0;
					  $l = 1;
					  $subject_target_page_name = $page_name;
					  if ($subjectFilter != null) {
						$subject_target_page_name .= "subjectFilter=" . $subjectFilter . "&";
						}
					  for($i=0; $i<$subjectNumRows; $i=$i+$rowLimit) {
						if($i <> $subjectRowStart) {
							echo "<a href='" . $subject_target_page_name . "subjectRowStart=" . $i . "'><font face='Verdana' size='2'>" . $l . "</font></a>";
					    } else {
						    echo "<font face='Verdana' size='4' color=red>" . $l . "</font>";
						}  // Current page is not displayed as link and given font color red
					  $l = $l + 1;
					  }
				?>
			</td>
			<td align='right' width='30%'>
				<?PHP if($subjectNext < $subjectNumRows) {
						$subject_next_page_name = $page_name;
						if ($subjectFilter != null) {
							$subject_next_page_name .= "subjectFilter=" . $subjectFilter . "&";
							}
						echo "<a href='" . $subject_next_page_name . "subjectRowStart=" . $subjectNext . "'><font face='Verdana' size='2'>NEXT</font></a>";
					  }
				?>
			</td>
		</tr>
		</table>
	</div>
		
	<div class="panel-heading" style="min-width: 500;">
        <strong><center><h3>Specialties</h3></center></strong>
    </div>
    <div class="panel-body" style="min-width: 500; overflow-x: scroll;">
		
		<table align="center" id="specialtyFilterTable" style="width:50%; min-width:450px; max-width:550px;">
			<tr>
				<td align="right">
					Filter by Specialty: 
						<select name="SpecialtyFilter" onchange="window.location.href=this.value">
							<?PHP $pSpecialtyFilterQuery = "SELECT DISTINCT UPPER(LEFT(Specialty,1)) AS spclty FROM tSpecialty ORDER BY spclty ASC";
                                  $specialtyFilterResults = $dbc->query($pSpecialtyFilterQuery);
								  if (is_null($specialty_filter)) {
									  echo "<option value='" . $page_name . "specialtyFilter=all' SELECTED>All</option>";
								  } else {
									  echo "<option value='" . $page_name . "specialtyFilter=all'>All</option>";
								  }
								  while ($specialtyFilterRow = $specialtyFilterResults->fetch_array()) {
									  if ($specialtyFilterRow['spclty'] == $specialty_filter) {
										  echo "<option value='" . $page_name . "specialtyFilter=" . $specialtyFilterRow['spclty'] . "' SELECTED>" . $specialtyFilterRow['spclty'] . "</option>";
									  } else {
										  echo "<option value='" . $page_name . "specialtyFilter=" . $specialtyFilterRow['spclty'] . "'>" . $specialtyFilterRow['spclty'] . "</option>";
									  }
                                  }
						    ?>
						</select>
				</td>
			</tr>
		</table>
        <table align="center" id="specialtyTable" style="width:50%; min-width:450px; max-width:550px; border: 1px solid black;">
            <tr style="background-color: lightgrey;">
                <th>Specialty</th>
				<th>Options</th>
            </tr>

            <?PHP
            if (is_null($specialty_filter)) {
				$pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
				} else {
					$pSpecialtyQuery = "SELECT * FROM tSpecialty WHERE UPPER(LEFT(Specialty,1)) = '" . $specialty_filter . "' ORDER BY Specialty ASC";
				}
									
			$SpecialtyResultsAll = $dbc->query($pSpecialtyQuery);
			$specialtyNumRows = mysqli_num_rows($SpecialtyResultsAll);
			$SpecialtyResults = $dbc->query($pSpecialtyQuery . " LIMIT ". $specialtyRowStart . ", " . $rowLimit);
						
            while ($SpecialtyRow = $SpecialtyResults->fetch_array()) {
                ?>

                <tr style="border: 1px solid black">

                    <td>
                        <?PHP echo $SpecialtyRow['Specialty']; ?>
						<input type="hidden" id="hiddenSpecialtyID<?PHP echo $SpecialtyRow['SpecialtyID'] ?>" name="hiddenSpecialtyID<?PHP echo $SpecialtyRow['SpecialtyID'] ?>" value="<?PHP echo $SpecialtyRow['SpecialtyID']; ?>"></input>
						<input type="hidden" id="hiddenSpecialtyName<?PHP echo $SpecialtyRow['SpecialtyID'] ?>" name="hiddenSpecialtyName<?PHP echo $SpecialtyRow['SpecialtyID'] ?>" value="<?PHP echo $SpecialtyRow['Specialty']; ?>"></input>
                    </td>
					<td>
                        <div>
                            <a id='editIcon<?PHP echo $SpecialtyRow['SpecialtyID']; ?>' title='Edit Specialty'
                               href='javascript:showonlyone("editSpecialtyBox", "hiddenSpecialtyID<?PHP echo $SpecialtyRow['SpecialtyID'] ?>", "hiddenSpecialtyName<?PHP echo $SpecialtyRow['SpecialtyID'] ?>")'>
                                <span class='glyphicon glyphicon-pencil'></span>
                            </a>
                            <a id='deleteIcon<?PHP echo $SpecialtyRow['SpecialtyID']; ?>' title='Delete Specialty'
                               href='javascript:showonlyone("deleteSpecialtyBox<?PHP echo $SpecialtyRow['SpecialtyID']; ?>");'>
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <div class="newboxes" id="deleteSpecialtyBox<?PHP echo $SpecialtyRow['SpecialtyID']; ?>"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <a href='<?PHP echo $page_name; ?>delete_specialty=<?PHP echo $SpecialtyRow['SpecialtyID']; ?>'>Delete Specialty?</a>
                        </div>
                    </td>
                </tr>


                <?PHP
            }
			?>
				<tr>
                    <td colspan=2>
                        <div class="newboxes" id="editSpecialtyBox" name="editSpecialtyBox"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <input type="hidden" id="SpecialtyID" name="SpecialtyID" value="">
							Current Specialty Text: <input style="background-color: transparent;" type="text" id="oldSpecialtyName" name="oldSpecialtyName" value="" readonly><br>
							Enter New Specialty Text:<input type="text" id="newSpecialtyName" name="newSpecialtyName" value="">
							<input type="submit" name="submit" value="Save Changes">
                        </div>
                    </td>
				</tr>
        </table>
	
		<table align="center" id="specialtyNavTable" style="width:50%; min-width:450px; max-width:550px;">
		<tr>
			<td align='left' width='30%'>
				<?PHP if($specialtyBack >=0) {
						$specialty_back_page_name = $page_name;
						if ($specialtyFilter != null) {
							$specialty_back_page_name .= "specialtyFilter=" . $specialtyFilter . "&";
						}
						echo "<a href='" . $specialty_back_page_name . "&specialtyRowStart=" . $specialtyBack . "'><font face='Verdana' size='2'>PREV</font></a>";
					  }
				?>
			</td>
			<td align=center width='30%'>
				<?PHP $i = 0;
					  $l = 1;
					  $specialty_target_page_name = $page_name;
					  if ($specialtyFilter != null) {
						$specialty_target_page_name .= "specialtyFilter=" . $specialtyFilter . "&";
						}
					  for($i=0; $i<$specialtyNumRows; $i=$i+$rowLimit) {
						if($i <> $specialtyRowStart) {
							echo "<a href='" . $specialty_target_page_name . "specialtyRowStart=" . $i . "'><font face='Verdana' size='2'>" . $l . "</font></a>";
					    } else {
						    echo "<font face='Verdana' size='4' color=red>" . $l . "</font>";
						}  // Current page is not displayed as link and given font color red
					  $l = $l + 1;
					  }
				?>
			</td>
			<td align='right' width='30%'>
				<?PHP if($specialtyNext < $specialtyNumRows) {
						$specialty_next_page_name = $page_name;
						if ($specialtyFilter != null) {
							$specialty_next_page_name .= "specialtyFilter=" . $specialtyFilter . "&";
							}
						echo "<a href='" . $specialty_next_page_name . "specialtyRowStart=" . $specialtyNext . "'><font face='Verdana' size='2'>NEXT</font></a>";
					  }
				?>
			</td>
		</tr>
		</table>
	</div>
		
	<div class="panel-heading" style="min-width: 500;">
        <strong><center><h3>Courses</h3></center></strong>
    </div>
    <div class="panel-body" style="min-width: 500; overflow-x: scroll;">
    
		<table align="center" id="courseFilterTable" style="width:50%; min-width:450px; max-width:550px;">
			<tr>
				<td align="right">
					Filter by Course: 
						<select name="CourseFilter" onchange="window.location.href=this.value">
							<?PHP $pCourseFilterQuery = "SELECT DISTINCT UPPER(LEFT(Course,1)) AS course FROM tCourse ORDER BY course ASC";
                                  $courseFilterResults = $dbc->query($pCourseFilterQuery);
								  if (is_null($course_filter)) {
									  echo "<option value='" . $page_name . "courseFilter=all' SELECTED>All</option>";
								  } else {
									  echo "<option value='" . $page_name . "courseFilter=all'>All</option>";
								  }
								  while ($courseFilterRow = $courseFilterResults->fetch_array()) {
									  if ($courseFilterRow['course'] == $course_filter) {
										  echo "<option value='" . $page_name . "courseFilter=" . $courseFilterRow['course'] . "' SELECTED>" . $courseFilterRow['course'] . "</option>";
									  } else {
										  echo "<option value='" . $page_name . "courseFilter=" . $courseFilterRow['course'] . "'>" . $courseFilterRow['course'] . "</option>";
									  }
                                  }
						    ?>
						</select>
				</td>
			</tr>
		</table>
        <table align="center" id="courseTable" style="width:50%; min-width:450px; max-width:550px; border: 1px solid black;">
            <tr style="background-color: lightgrey;">
                <th>Course</th>
				<th>Options</th>
            </tr>

            <?PHP
            if (is_null($course_filter)) {
				$pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
				} else {
					$pCourseQuery = "SELECT * FROM tCourse WHERE UPPER(LEFT(Course,1)) = '" . $course_filter . "' ORDER BY Course ASC";
				}
									
			$CourseResultsAll = $dbc->query($pCourseQuery);
			$courseNumRows = mysqli_num_rows($CourseResultsAll);
			$CourseResults = $dbc->query($pCourseQuery . " LIMIT ". $courseRowStart . ", " . $rowLimit);
						
            while ($CourseRow = $CourseResults->fetch_array()) {
                ?>

                <tr style="border: 1px solid black">

                    <td>
                        <?PHP echo $CourseRow['Course']; ?>
						<input type="hidden" id="hiddenCourseID<?PHP echo $CourseRow['CourseID'] ?>" name="hiddenCourseID<?PHP echo $CourseRow['CourseID'] ?>" value="<?PHP echo $CourseRow['CourseID']; ?>"></input>
						<input type="hidden" id="hiddenCourseName<?PHP echo $CourseRow['CourseID'] ?>" name="hiddenCourseName<?PHP echo $CourseRow['CourseID'] ?>" value="<?PHP echo $CourseRow['Course']; ?>"></input>
                    </td>
					<td>
                        <div>
                            <a id='editIcon<?PHP echo $CourseRow['CourseID']; ?>' title='Edit Course'
                               href='javascript:showonlyone("editCourseBox", "hiddenCourseID<?PHP echo $CourseRow['CourseID'] ?>", "hiddenCourseName<?PHP echo $CourseRow['CourseID'] ?>")'>
                                <span class='glyphicon glyphicon-pencil'></span>
                            </a>
                            <a id='deleteIcon<?PHP echo $CourseRow['CourseID']; ?>' title='Delete Course'
                               href='javascript:showonlyone("deleteCourseBox<?PHP echo $CourseRow['CourseID']; ?>");'>
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <div class="newboxes" id="deleteCourseBox<?PHP echo $CourseRow['CourseID']; ?>"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <a href='<?PHP echo $page_name; ?>delete_course=<?PHP echo $CourseRow['CourseID']; ?>'>Delete Course?</a>
                        </div>
                    </td>
                </tr>


                <?PHP
            }
			?>
				<tr>
                    <td colspan=2>
                        <div class="newboxes" id="editCourseBox" name="editCourseBox"
                             style='border: 1px solid black; background-color: #CCCCCC; display: none; padding: 10px;'>
                            <input type="hidden" id="CourseID" name="CourseID" value="">
							Current Course Text: <input style="background-color: transparent;" type="text" id="oldCourseName" name="oldCourseName" value="" readonly><br>
							Enter New Course Text:<input type="text" id="newCourseName" name="newCourseName" value="">
							<input type="submit" name="submit" value="Save Changes">
                        </div>
                    </td>
				</tr>
        </table>
	
		<table align="center" id="courseNavTable" style="width:50%; min-width:450px; max-width:550px;">
		<tr>
			<td align='left' width='30%'>
				<?PHP if($courseBack >=0) {
						$course_back_page_name = $page_name;
						if ($courseFilter != null) {
							$course_back_page_name .= "courseFilter=" . $courseFilter . "&";
						}
						echo "<a href='" . $course_back_page_name . "&courseRowStart=" . $courseBack . "'><font face='Verdana' size='2'>PREV</font></a>";
					  }
				?>
			</td>
			<td align=center width='30%'>
				<?PHP $i = 0;
					  $l = 1;
					  $course_target_page_name = $page_name;
					  if ($courseFilter != null) {
						$course_target_page_name .= "courseFilter=" . $courseFilter . "&";
						}
					  for($i=0; $i<$courseNumRows; $i=$i+$rowLimit) {
						if($i <> $courseRowStart) {
							echo "<a href='" . $course_target_page_name . "courseRowStart=" . $i . "'><font face='Verdana' size='2'>" . $l . "</font></a>";
					    } else {
						    echo "<font face='Verdana' size='4' color=red>" . $l . "</font>";
						}  // Current page is not displayed as link and given font color red
					  $l = $l + 1;
					  }
				?>
			</td>
			<td align='right' width='30%'>
				<?PHP if($courseNext < $courseNumRows) {
						$course_next_page_name = $page_name;
						if ($courseFilter != null) {
							$course_next_page_name .= "courseFilter=" . $courseFilter . "&";
							}
						echo "<a href='" . $course_next_page_name . "courseRowStart=" . $courseNext . "'><font face='Verdana' size='2'>NEXT</font></a>";
					  }
				?>
			</td>
		</tr>
		</table>

	</div>	
	
    </form>
</div>

</body>
</html>

