<?php
include("loginCheck.php");
include("nav.php");
include("library.php");
?>
<body>
<div class="container">
    <h2>Admin Page</h2>
    <!-- form action will change later -->
    <form action="admin_new.php" method="post" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users:
            </div>
            <div class ="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="container">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Admin Users
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									$pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='1' ORDER BY LastName ASC";
									$results = $dbc->query($pAdminQuery);
									while($row = $results->fetch_array())
									{
										$profileURL = 'adminProfile.php?uid='.  $row['UserID']. "&round=1";
										echo "<li><a href=". $profileURL ." target='adminProfile'>".$row["LastName"] . " , " . $row["FirstName"] . "</a></li>";
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <div class="container">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Subject Admin Users
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									$pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='2' ORDER BY LastName ASC";
									$results = $dbc->query($pAdminQuery);
									while($row = $results->fetch_array())
									{
										$profileURL = 'adminProfile.php?uid='.  $row['UserID']. "&round=1";
										echo "<li><a href=". $profileURL ." target='adminProfile'>".$row["LastName"] . " , " . $row["FirstName"] . "</a></li>";
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <div class="container">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Faculty Users
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									$pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='3' ORDER BY LastName ASC";
									$results = $dbc->query($pAdminQuery);
									while($row = $results->fetch_array())
									{
										$profileURL = 'adminProfile.php?uid='.  $row['UserID']. "&round=1";
										echo "<li><a href=". $profileURL ." target='adminProfile'>".$row["LastName"] . " , " . $row["FirstName"] . "</a></li>";
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <div class="container">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Read-Only Users
								<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									$pAdminQuery = "SELECT * FROM tUser WHERE UserRankID ='4' ORDER BY LastName ASC";
									$results = $dbc->query($pAdminQuery);
									while($row = $results->fetch_array())
									{
										$profileURL = 'adminProfile.php?uid='.  $row['UserID']. "&round=1";
										echo "<li><a href=". $profileURL ." target='adminProfile'>".$row["LastName"] . " , " . $row["FirstName"] . "</a></li>";
									}
									?>
								</ul>
							</div>
					    </div>
					</div>
                </div>
				<div class="col-sm-4">
					<div class="form-group">
						<object width="400" height="100%" data="adminProfile.php" name="adminProfile"></object>
					</div>
				</div>
			</div>
		</div>
    </form>
</div>
</body>
</html>

