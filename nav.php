<?PHP session_start();?>


<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           <a class="pull-left" href="dashboard.php"><img src="images/dashboardLogo.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-home" style="color:black;"></span> Dashboard</a></li>
                <li class ="dropdown">
				<a  class="dropdown-toggle" data-toggle="dropdown" href="profile.php">
				<span class="glyphicon glyphicon-user" style="color:black;"></span> Profile <span class="caret"></span></a>
					 <ul class="dropdown-menu">
				<?PHP if($_SESSION['UserRank'] != 4)
									{ ?>
					  <li><a href="profile.php">Edit Profile</a></li>
					  <li><a href="members.php?rid= <?PHP echo $_SESSION['UserID']; ?>">View Profile</a></li>
					  <?PHP }?>
					  <li><a href="members.php">Browse Members</a></li>
					</ul>
				</li>
				<?PHP if($_SESSION['UserRank'] != 4)
									{ ?>
                <li><a href="upload.php"><span class="glyphicon glyphicon-upload" style="color:black;"></span> Upload an Assignment</a></li>
				<?PHP } ?>
                <li><a href="search.php"><span class="glyphicon glyphicon-search" style="color:black;"></span> Search for Assignments</a></li>
                <?PHP
                $level = $_SESSION['UserRank'];
                if ($level == 1) {
                    ?>
                    <li>
                        <a href="admin.php"><span class="glyphicon glyphicon-star" style="color:black;"></span> Admin</a>
                    </li>
                <?PHP }?>
                <li><a href="FAQ/AssignmentRepositoryFAQ.pdf" target="blank"><span class="glyphicon glyphicon-info-sign" style="color:black;"></span> Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
<!--                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
            </ul>
        </div>
    </div>
</nav>



