<?php
include ("loginCheck.php");

include ("nav.php");

include ("db_connect.php");

//bavotasan.com/2009/processing-multiple-forms-on-one-page-with-php/

$fileInvalid = false;
?>
<script src="utils.js"></script>
<?php
// end session login
/*
if (isset($_POST['vAddSubject']))
{
    echo $_POST['SubjectAdd'];
    $Subject = ucfirst($_POST['SubjectAdd']);
    $AddStatement = "INSERT INTO tSubject (Subject) VALUES ('$Subject')";
    $results = $dbc->query($AddStatement);
    echo $AddStatement;
}

if (isset($_POST['vAddSpecialty']))
{
    echo $_POST['SpecialtyAdd'];
    $Specialty = ucfirst($_POST['SpecialtyAdd']);
    $AddStatement = "INSERT INTO tSpecialty (Specialty) VALUES ('$Specialty')";
    $results = $dbc->query($AddStatement);
    echo $AddStatement;
}

if (isset($_POST['vAddCourse']))
{
    echo $_POST['CourseAdd'];
    $Course = ucfirst($_POST['CourseAdd']);
    $AddStatement = "INSERT INTO tCourse (Course) VALUES ('$Course')";
    $results = $dbc->query($AddStatement);
    echo $AddStatement;
}

if (isset($_POST['submit']))
{
    echo $_POST['submitForm'];
    //$Subject = ucfirst($_POST['SubjectAdd']);
    //$AddStatement = "INSERT INTO tSubject (Subject) VALUES ('$Subject')";
    //$results = $dbc->query($AddStatement);
    //echo $AddStatement;
}
*/

?>
<html xmlns="http://www.w3.org/1999/html">
<body></body>
<div class="container">
    <h2>Upload</h2>
    <form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">
        <div class="panel panel-default">
            <div class="panel-heading">
                Class you're teaching:
            </div>
            <div class ="panel-body">

                <div class="col-sm-4">

                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <select multiple class="form-control" id="subject" name="subject[]" >
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
                    </div>

                    <p>Don't see your subject? Add your own!</p>

    </form>

    <form action="uploadTest.php" method="POST" name="addSubject">

        <input class="form-control input-sm" id="SubjectAdd" name="SubjectAdd" type="text"><!-- Add your own text box -->
        <button type="button" name="vAddSubject" class="btn btn-secondary" value="AddSubject" onclick="addSubject();">Add</button><!--Submit button-->


    </form>
</div>
    <form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">


<div class="col-sm-4">
    <div class="form-group">
        <label for="specialty">Specialty:</label>
        <select multiple class="form-control" id="submitForm"" name="specialty[]">
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
    </div>
    <p>Don't see your specialty? Add your own!</p>
    </form>

    <form action="uploadTest.php" method="POST" name="addSpecialty">
        <input class="form-control input-sm" id="SpecialtyAdd" name="SpecialtyAdd" type="text"><!-- Add your own text box -->
        <button type="submit" name="vAddSpecialty" class="btn btn-secondary" value="send specialty">Add</button><!--Submit button-->
    </form>

</div>

<form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">
    <div class="col-sm-4">
        <div class="form-group">
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
        </div>
        <p>Don't see your course? Add your own!</p>
</form>

<form action="uploadTest.php" method="POST" name="addCourse">
    <input class="form-control input-sm" id="CourseAdd" name="CourseAdd" type="text"><!-- Add your own text box -->
    <button type="submit" name="vAddCourse" class="btn btn-secondary" value="send course">Add</button><!--Submit button-->
</form>
</div>
</div>
<form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">
    <div class="panel panel-default">
        <div class="panel-heading">
            With your assignment being focus on:
        </div>
        <div class ="panel-body">

            <div class="col-sm-4">

                <div class="form-group">
                    <label for="subjectFocus">Subject:</label>
                    <select multiple class="form-control" id="subject" name="subjectFocus[]" >
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
                </div>

                <p>Don't see your subject? Add your own!</p>

</form>
<form action="uploadTest.php" method="POST" name="addSubject">

    <input class="form-control input-sm" id="SubjectAdd" name="SubjectAdd" type="text"><!-- Add your own text box -->
    <button type="submit" name="vAddSubject" class="btn btn-secondary" value="send subject" >Add</button><!--Submit button-->


</form>
<form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="specialtyFocus">Specialty:</label>
            <select multiple class="form-control" id="specialty" name="specialtyFocus[]">
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
        </div>
        <p>Don't see your specialty? Add your own!</p>
</form>

<form action="uploadTest.php" method="POST" name="addSpecialty">
    <input class="form-control input-sm" id="SpecialtyAdd" name="SpecialtyAdd" type="text"><!-- Add your own text box -->
    <button type="submit" name="vAddSpecialty" class="btn btn-secondary" value="send specialty">Add</button><!--Submit button-->
</form>

</div>

<form action="fileUploader.php" method="post" enctype="multipart/form-data" id="submitForm">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="courseFocus">Course:</label>
            <select multiple class="form-control" id="course" name="courseFocus[]">
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
        </div>
        <p>Don't see your course? Add your own!</p>
</form>

<form action="uploadTest.php" method="POST" name="addCourse">
    <input class="form-control input-sm" id="CourseAdd" name="CourseAdd" type="text"><!-- Add your own text box -->
    <button type="submit" name="vAddCourse" class="btn btn-secondary" value="send course">Add</button><!--Submit button-->
</form>
</div>
</div>
    <div class="panel-heading">
        More assignment details:
    </div>

    <div class ="panel-body" id="txtTitle">

        <div class="col-sm-4">
            <div class="form-group">
                <label for="title">Title:</label>
                <textarea class="form-control" name="title" id="title" placeholder="Enter Text..."></textarea>
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