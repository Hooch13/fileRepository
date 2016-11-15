<?php session_start();
//include ("loginCheck.php");

include ("nav.php");

include ("db_connect.php");

//include ("updateSubject.php");

//bavotasan.com/2009/processing-multiple-forms-on-one-page-with-php/
?>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>
        <script src="utils.js"type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="sessionVariable.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/upload_test.css">

    </head>
<?PHP
$fileInvalid = false;
?>
<script type="javascript/text">
$(document).ready(function(){

   // jQuery methods go here...
   $("#courseDivInner").toggle(".hideBox");

});
//upon entry: change all div's to "visibility: hidden";
 $
/* appID = array (
	div1, div2, div3, div4, div5, div6
	);
show current div's + previous (in other words show div1 - div3)
changing current style="visibility:hidden";
no need to go back through div2, div1 because they are already visible */
</script>
    <?php
error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ?>






	
    <body></body>
<div class="container">
    <h2>Upload</h2>
    <form action="fileUploader.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                Class you're teaching:
            </div>
            <div class ="panel-body" id="step1">

                <div class="col-sm-4">

                    <div class="form-group" id="subjectDivInner">
                        <label for="subject">Subject:</label>
                        <select required multiple class="form-control" id="subject" name="subject[]" >
                            <?php
                            $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
                            $results = $dbc->query($pSubjectQuery);
                            echo $pSubjectQuery;

                            while ($row = $results->fetch_array())
                            {
                                echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";
                            }

                            ?>

                        </select>
                    
                    <!--Test button going here-->

                    
                        <form method="POST" name="subject">
                            <input class="form-control input-sm" id="txtSubjectAdd" name="txtSubjectAdd" type="text" placeholder="Add a new subject..." >
                            <button type="button" id="btnAddSubject" class="btn btn-secondary" value="AddSubject" onclick="<?php $_SESSION["Message"]="" ?>">Add</button><!--Submit button-->

                            <div class="data">

                            </div>
                        </form>
					</div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group" id="specialtyDivInner">
                        <label for="specialty">Specialty:</label>
                        <select required multiple class="form-control" id="specialty" name="specialty[]">
                            <?php
                            $pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
                            $results = $dbc->query($pSpecialtyQuery);
                            echo $pSpecialtyQuery;

                            while ($row = $results->fetch_array())
                            {
                                echo "<option value='" . $row["SpecialtyID"] . "'>" . $row["Specialty"] . "</option>";
                            }

                            ?>
                        </select>
                    
                    <form method="POST" name="specialty">
                        <input class="form-control input-sm" id="txtSpecialtyAdd" name="txtSpecialtyAdd" type="text" placeholder="Add a new specialty...">
                        <button type="button" id="btnAddSpecialty" class="btn btn-secondary" >Add</button><!--Submit button-->
                        <div class="data"></div>

                    </form>
					</div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group" id="courseDivInner">
                        <label for="course">Course:</label>
                        <select multiple class="form-control" id="course" name="course[]">
                            <?php
                            $pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
                            $results = $dbc->query($pCourseQuery);
                            echo $pCourseQuery;

                            while ($row = $results->fetch_array())
                            {
                                echo "<option value='" . $row["CourseID"] . "'>" . $row["Course"] . "</option>";
                            }

                            ?>
                        </select>
                    
                    <form method="POST" name="course">
                        <input  class="form-control input-sm" id="txtCourseAdd" name="txtCourseAdd" type="text" placeholder="Add a new course...">
                        <button type="button" id="btnAddCourse" class="btn btn-secondary" value="AddSubject" >Add</button><!--Submit button-->
                        <div class="data"></div>

                    </form>
				</div>
                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    With your assignment being focus on:
                </div>
                <div class ="panel-body" id="step2">

                    <div class="col-sm-4">

                        <div class="form-group" id="focusSubjectAdd">
                            <label for="subjectFocus">Subject:</label>
                            <select required multiple class="form-control" id="subject" name="subjectFocus[]" >
                                <?php
                                $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
                                $results = $dbc->query($pSubjectQuery);
                                echo $pSubjectQuery;

                                while ($row = $results->fetch_array())
                                {
                                    echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";
                                }
                                ?>

                            </select>
                        

                        <form method="POST" name="Fsubject">
                            <input class="form-control input-sm" id="txtSubjectFocusAdd" name="txtSubjectFocusAdd" type="text" placeholder="Add a new focus subject...">
                            <button type="button" id="btnAddSubjectFocus" class="btn btn-secondary" value="AddSubject">Add</button><!--Submit button-->
                            <div class="data"></div>

                        </form>
					</div>


                    </div>

                    <div class="col-sm-4">
                        <div class="form-group" id="focusSpecialtyAdd">
                            <label for="specialtyFocus">Specialty:</label>
                            <select required multiple class="form-control" id="specialty" name="specialtyFocus[]">
                                <?php
                                $pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
                                $results = $dbc->query($pSpecialtyQuery);
                                echo $pSpecialtyQuery;

                                while ($row = $results->fetch_array())
                                {
                                    echo "<option value='" . $row["SpecialtyID"] . "'>" . $row["Specialty"] . "</option>";
                                }

                                ?>
                            </select>
                        

                        <form method="POST" name="Fspecialty">
                            <input class="form-control input-sm" id="txtSpecialtyFocusAdd" name="txtSpecialtyFocusAdd" type="text" placeholder="Add a new focus specialty...">
                            <button type="button" id="btnAddSpecialtyFocus" class="btn btn-secondary" value="AddSubject" >Add</button><!--Submit button-->
                            <div class="data"></div>

                        </form>
                    </div>
					</div>

                    <div class="col-sm-4">
                        <div class="form-group" id="focusCourseAdd">
                            <label for="courseFocus">Course:</label>
                            <select required multiple class="form-control" id="course" name="courseFocus[]">
                                <?php
                                $pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
                                $results = $dbc->query($pCourseQuery);
                                echo $pCourseQuery;

                                while ($row = $results->fetch_array())
                                {
                                    echo "<option value='" . $row["CourseID"] . "'>" . $row["Course"] . "</option>";
                                }

                                ?>
                            </select>
                        

                        <form method="POST" name="Fcourse">
                            <input class="form-control input-sm" id="txtCourseFocusAdd" name="txtCourseFocusAdd" type="text" placeholder="Add a new focus course...">
                            <button type="button" id="btnAddCourseFocus" class="btn btn-secondary" value="AddSubject" >Add</button><!--Submit button-->
                            <div class="data"></div>

                        </form>
						</div>
                    </div>
                </div>
                <div class="panel-heading">
                    More assignment details:
                </div>

                <div class ="panel-body" id="Row3">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <textarea required class="form-control" name="title" id="title" placeholder="Enter Text..."></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comments">Comments:</label>
                            <textarea class="form-control" name="comments" id="comments" placeholder="Enter Text..."></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Enter Text..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="checkbox text-center">
                        <label><input type="checkbox" name="gradeAssignment"> Willing to grade the assignment?</label>
                    </div>

                    <div class="checkbox text-center">
                        <label><input type="checkbox" name="rubricAvailable"> Is a rubric included with the assignment?</label>
                    </div>
                </div>

                <div class="panel-heading">
                    Upload your assignment:
                </div>
                <div class="panel-body">


                    <div class="form-group">
                        <div class="container">

                            <div class="row">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>

                            <br>

                            <div class="row">
                                <input type="submit" value="Submit File" name="submit">
                            </div>
                        </div>

                    </div>
                    <!-- </form> -->
    </form>
</div>
</div>
</div>
</html>