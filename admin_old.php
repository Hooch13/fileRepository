<?php
include("loginCheck.php");
require('library.php');
require('nav.php');
$passwordInvalid = false; // Assume password is valid
$emailDuplicate = false; // Assume email is unique
$questionInvalid = false; // Assume question not hacked

if (isset($_POST['submit'])) {
    // 
    $user = new User();
    $user->FirstName = $_POST["FirstName"];
    $user->LastName = $_POST["LastName"];
    $user->Email = $_POST["Email"];
    $user->Password = CreateSecurePassword($_POST["Password"]);
    $user->SecurityQuestionID = $_POST["SecurityQuestionID"];
    $user->SecurityQuestionAnswer = $_POST["SecurityQuestionAnswer"];
    $user->UserRankID = 3;

    if (strlen($_POST["Password"]) < 8 || strlen($_POST["Password"]) > 30) { // Invalid password
        $passwordInvalid = true;
    } else if (!SecurityQuestionIDIsValid($user->SecurityQuestionID, $dbc)) {
        $questionInvalid = true;
    } else if (CreateUser($user, $dbc) === 0) { // Success
        // Redirect to login
        header("Location: login.php?register=successful");
        exit();
    } else {
        $emailDuplicate = true;
    }
}
?>
<body></body>
<div class="container">
    <h2>Upload</h2>

    <form action="fileUploader.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                Class you're teaching:
            </div>
            <div class="panel-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="subject">Admin: Can view, search, upload, download, modify assignment tag, maintain
                            security, edit user rank, remove user, and .</label>
                        <select multiple class="form-control" id="subject" name="subject[]">
                            <?php
                            $pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
                            $results = $dbc->query($pAdminQuery);
                            echo $pAdminQuery;
                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["UserID"] . "'>" . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                            <div class="row">
                                <input type="submit" value="submit" name="submit">
                            </div>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="subject">Admin: Can view, search, upload, download, modify assignment tag, maintain
                            security, edit user rank, remove user, and .</label>
                        <select multiple class="form-control" id="subject" name="subject[]">
                            <?php
                            $pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
                            $results = $dbc->query($pAdminQuery);
                            echo $pAdminQuery;
                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["UserID"] . "'>" . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                            <div class="row">
                                <input type="submit" value="submit" name="submit">
                            </div>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="subject">Admin: Can view, search, upload, download, modify assignment tag, maintain
                            security, edit user rank, remove user, and .</label>
                        <select multiple class="form-control" id="subject" name="subject[]">
                            <?php
                            $pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
                            $results = $dbc->query($pAdminQuery);
                            echo $pAdminQuery;
                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["UserID"] . "'>" . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                            <div class="row">
                                <input type="submit" value="submit" name="submit">
                            </div>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="subject">Admin: Can view, search, upload, download, modify assignment tag, maintain
                            security, edit user rank, remove user, and .</label>
                        <select multiple class="form-control" id="subject" name="subject[]">
                            <?php
                            $pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
                            $results = $dbc->query($pAdminQuery);
                            echo $pAdminQuery;
                            while ($row = $results->fetch_array()) {
                                echo "<option value='" . $row["UserID"] . "'>" . $row["LastName"] . " , " . $row["FirstName"] . "</option>";
                            }
                            ?>
                            <div class="row">
                                <input type="submit" value="submit" name="submit">
                            </div>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-heading">
                More assignment details:
            </div>
            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <input type="submit" value="submit" name="submit">
                    </div>
                </div>
            </div>
    </form>
</div>
</div>
</div>