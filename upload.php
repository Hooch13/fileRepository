<?php session_start();
include("loginCheck.php");

include("nav.php");

include("db_connect.php");

//include ("updateSubject.php");

//bavotasan.com/2009/processing-multiple-forms-on-one-page-with-php/

$fileInvalid = false;
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>
    <script src="utils.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="sessionVariable.css">

</head>
<body></body>
<div class="container">
    <strong><h2>Upload an assignment</h2></strong>

    <form action="fileUploader.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Class you're teaching:</strong>
            </div>
            <div class="panel-body">

                <div class="col-sm-4">

                    <div class="form-group" id="subjectDivInner">
                        <label for="subject"><span style='color: red;'>*</span>Subject: </label>
                        <label for="subject">
                            <small class="text-muted"><i>select more than one subject by holding control and clicking the subjects included</i></small>
                        </label>
                        <select required multiple class="form-control" id="subject" name="subject[]">
                            <?php
                            $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
                            $results = $dbc->query($pSubjectQuery);
                            echo $pSubjectQuery;

                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";
                            }

                            ?>

                        </select>
                    </div id="SubjectAddDiv">
                    <!--Test button going here-->

                    <div>
                        <form method="POST" name="subject">
                            <input class="form-control input-sm" id="txtSubjectAdd" name="txtSubjectAdd" type="text"
                                   placeholder="Add a new subject..." maxlength="20">
                            <button type="button" id="btnAddSubject" class="btn btn-secondary" value="AddSubject"
                                    onclick="<?php $_SESSION["Message"] = "" ?>">Add
                            </button>
                            <!--Submit button-->

                            <div class="data">

                            </div>
                        </form>

                    </div>


                    <!-- test button ending here -->
                </div>

                <div class="col-sm-4">
                    <div class="form-group" id="specialtyDivInner">
                        <label for="specialty"><span style='color: red;'>*</span>Specialty: </label>
                        <label for="specialty">
                            <small class="text-muted"><i>select more than one specialty by holding control and clicking
                                    the specialties included</i></small>
                        </label>
                        <select required multiple class="form-control" id="specialty" name="specialty[]">
                            <?php
                            $pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
                            $results = $dbc->query($pSpecialtyQuery);
                            echo $pSpecialtyQuery;

                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["SpecialtyID"] . "'>" . $row["Specialty"] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <form method="POST" name="specialty">
                        <input class="form-control input-sm" id="txtSpecialtyAdd" name="txtSpecialtyAdd" type="text"
                               placeholder="Add a new specialty..." maxlength="20">
                        <button type="button" id="btnAddSpecialty" class="btn btn-secondary">Add</button>
                        <!--Submit button-->
                        <div class="data"></div>

                    </form>
                </div>


                <div class="col-sm-4">
                    <div class="form-group" id="courseDivInner">
                        <label for="course"><span style='color: red;'>*</span>Course: </label>
                        <label for="course">
                            <small class="text-muted"><i>select more than one course by holding control and clicking the
                                    courses included</i></small>
                        </label>
                        <select multiple class="form-control" id="course" name="course[]">
                            <?php
                            $pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
                            $results = $dbc->query($pCourseQuery);
                            echo $pCourseQuery;

                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["CourseID"] . "'>" . $row["Course"] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <form method="POST" name="course">
                        <input class="form-control input-sm" id="txtCourseAdd" name="txtCourseAdd" type="text"
                               placeholder="Add a new course..." maxlength="20">
                        <button type="button" id="btnAddCourse" class="btn btn-secondary" value="AddSubject">Add
                        </button>
                        <!--Submit button-->
                        <div class="data"></div>

                    </form>

                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>With your assignment being focus on:</strong>
                </div>
                <div class="panel-body">

                    <div class="col-sm-4">

                        <div class="form-group" id="focusSubjectAdd">
                            <label for="subjectFocus"><span style='color: red;'>*</span>Subject: </label>
                            <label for="subjectFocus">
                                <small class="text-muted"><i>select more than one subject by holding control and
                                        clicking the subjects included</i></small>
                            </label>
                            <select required multiple class="form-control" id="subject" name="subjectFocus[]">
                                <?php
                                $pSubjectQuery = "SELECT * FROM tSubject ORDER BY Subject ASC";
                                $results = $dbc->query($pSubjectQuery);
                                echo $pSubjectQuery;

                                while ($row = $results->fetch_array()) {
                                    echo "<option value='" . $row["SubjectID"] . "'>" . $row["Subject"] . "</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <form method="POST" name="Fsubject">
                            <input class="form-control input-sm" id="txtSubjectFocusAdd" name="txtSubjectFocusAdd"
                                   type="text" placeholder="Add a new focus subject..." maxlength="20">
                            <button type="button" id="btnAddSubjectFocus" class="btn btn-secondary" value="AddSubject">
                                Add
                            </button>
                            <!--Submit button-->
                            <div class="data"></div>

                        </form>


                    </div>

                    <div class="col-sm-4">
                        <div class="form-group" id="focusSpecialtyAdd">
                            <label for="specialtyFocus">Specialty:</label>
                            <label for="specialtyFocus">
                                <small class="text-muted"><i>select more than one specialty by holding control and
                                        clicking the specialties included</i></small>
                            </label>
                            <select multiple class="form-control" id="specialty" name="specialtyFocus[]">
                                <?php
                                $pSpecialtyQuery = "SELECT * FROM tSpecialty ORDER BY Specialty ASC";
                                $results = $dbc->query($pSpecialtyQuery);
                                echo $pSpecialtyQuery;

                                while ($row = $results->fetch_array()) {
                                    echo "<option value='" . $row["SpecialtyID"] . "'>" . $row["Specialty"] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                        <form method="POST" name="Fspecialty">
                            <input class="form-control input-sm" id="txtSpecialtyFocusAdd" name="txtSpecialtyFocusAdd"
                                   type="text" placeholder="Add a new focus specialty..." maxlength="20">
                            <button type="button" id="btnAddSpecialtyFocus" class="btn btn-secondary"
                                    value="AddSubject">Add
                            </button>
                            <!--Submit button-->
                            <div class="data"></div>

                        </form>
                    </div>


                    <div class="col-sm-4">
                        <div class="form-group" id="focusCourseAdd">
                            <label for="courseFocus">Course:</label>
                            <label for="courseFocus">
                                <small class="text-muted"><i>select more than one course by holding control and clicking
                                        the courses included</i></small>
                            </label>
                            <select multiple class="form-control" id="course" name="courseFocus[]">
                                <?php
                                $pCourseQuery = "SELECT * FROM tCourse ORDER BY Course ASC";
                                $results = $dbc->query($pCourseQuery);
                                echo $pCourseQuery;

                                while ($row = $results->fetch_array()) {
                                    echo "<option value='" . $row["CourseID"] . "'>" . $row["Course"] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                        <form method="POST" name="Fcourse">
                            <input class="form-control input-sm" id="txtCourseFocusAdd" name="txtCourseFocusAdd"
                                   type="text" placeholder="Add a new focus course..." maxlength="20">
                            <button type="button" id="btnAddCourseFocus" class="btn btn-secondary" value="AddSubject">
                                Add
                            </button>
                            <!--Submit button-->
                            <div class="data"></div>

                        </form>

                    </div>
                </div>
                <div class="panel-heading">
                    <strong>More assignment details: </strong>
                </div>

                <div class="panel-body" id="txtTitle">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="title"><span style='color: red;'>*</span>Title: </label>
                            <label for="title">
                                <small class="text-muted"><i>The title of the assignment</i></small>
                            </label>
                            <textarea required class="form-control" name="title" id="title" placeholder="Enter Text..."
                                      maxlength="45"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comments">Comments:</label>
                            <label for="comments">
                                <small class="text-muted"><i>Important notes about the assignment</i></small>
                            </label>
                            <textarea class="form-control" name="comments" id="comments" placeholder="Enter Text..."
                                      maxlength="75"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <label for="description">
                                <small class="text-muted"><i>Short description of the assignment</i></small>
                            </label>
                            <textarea class="form-control" name="description" id="description"
                                      placeholder="Enter Text..." maxlength="75"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="checkbox text-center">
                        <label><input type="checkbox" name="gradeAssignment"> Are you (the author) willing to grade the
                            assignment?</label>
                    </div>

                    <div class="checkbox text-center">
                        <label><input type="checkbox" name="rubricAvailable"> Is a rubric included with the assignment?</label>
                    </div>
                </div>

                <div class="panel-heading">
                    <strong>Upload your assignment:</strong>
                </div>
                <div class="panel-body">


                    <div class="form-group">
                        <div class="container">
                            <div class="row">
                            <label for="fileToUpload" class="text-danger"><i>Only zip files are allowed</i></label>

                                <input required type="file" name="fileToUpload" id="fileToUpload">
                            </div>

                            <br>

                            <div class="row">
                                <input type="submit" value="submit" name="submit">
                            </div>
                        </div>

                    </div>
                    <!-- </form> -->
    </form>
</div>
</div>
</div>
</html>