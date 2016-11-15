<?PHP
include("loginCheck.php");
include("nav.php");
include("db_connect.php");
// end session login
?>
<html xmlns="http://www.w3.org/1999/html">
<body></body>
<div class="container">
    <strong><h2>Search for assignments</h2></strong>

    <form action="searchResults.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>The assignment was focused on:</strong>
            </div>
            <div class="panel-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="subjectFocus">Subject:</label>
                        <label for="subjectFocus">
                            <small class="text-muted"><i>select more than one subject by holding control and clicking
                                    the subjects included</i></small>
                        </label>
                        <select multiple class="form-control" id="subjectFocus" name="subjectFocus[]">
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
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="specialtyFocus">Specialty:</label>
                        <label for="specialtyFocus">
                            <small class="text-muted"><i>select more than one specialty by holding control and clicking
                                    the specialties included</i></small>
                        </label>
                        <select multiple class="form-control" id="specialtyFocus" name="specialtyFocus[]">
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
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="courseFocus">Course:</label>
                        <label for="courseFocus">
                            <small class="text-muted"><i>select more than one course by holding control and clicking the
                                    courses included</i></small>
                        </label>
                        <select multiple class="form-control" id="courseFocus" name="courseFocus[]">
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
                </div>
            </div>


            <div class="panel-heading">
                <strong>The class the assignment was for:</strong>
            </div>
            <div class="panel-body">

                <div class="col-sm-4">

                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <label for="subject">
                            <small class="text-muted"><i>select more than one subject by holding control and clicking
                                    the subjects included</i></small>
                        </label>
                        <select multiple class="form-control" id="subject" name="subject[]">
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

                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="specialty">Specialty:</label>
                        <label for="specialty">
                            <small class="text-muted"><i>select more than one specialty by holding control and clicking
                                    the specialties included</i></small>
                        </label>
                        <select multiple class="form-control" id="specialty" name="specialty[]">
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
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="course">Course:</label>
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
                </div>
            </div>

            <div class="panel-heading">
                <strong>More assignment details:</strong>
            </div>

            <div class="panel-body" id="txtTitle">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="title">Title:</label><br>
                        <label for="title">
                            <small class="text-muted"><i>Search based on the title of the assignment</i></small>
                        </label>
                        <textarea class="form-control" name="title" id="title" placeholder="Enter Text..."></textarea>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="comments">Comments:</label>
                        <label for="comments">
                            <small class="text-muted"><i>Search based on important notes about the assignment</i>
                            </small>
                        </label>
                        <textarea class="form-control" name="comments" id="comments"
                                  placeholder="Enter Text..."></textarea>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <label for="description">
                            <small class="text-muted"><i>Search based on a short description of the assignment</i>
                            </small>
                        </label>
                        <textarea class="form-control" name="description" id="description"
                                  placeholder="Enter Text..."></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="checkbox text-center">
                    <label><input type="checkbox" name="gradeAssignment">Is the author willing to grade the
                        assignment</label>
                </div>

                <div class="checkbox text-center">
                    <label><input type="checkbox" name="rubricAvailable">Is there a rubric included with the assignment</label>
                </div>
            </div>

            <div class="panel-heading">
                <strong>Search for assignments:</strong>
            </div>
            <div class="panel-body">


                <div class="panel-body">
                    <div class="container">
                        <div class="row">
                    <span class="btn btn-default btn-file">
                        Search <input type="submit" value="submit" name="submit">
                    </span>
                        </div>
                    </div>
                </div>

    </form>

</div>
</div>
</div>
</html>
