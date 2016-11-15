<?php
// STEP 1. Start the PHP session.
// should be the first to start, to prevent 'headers already sent' errors
session_start();
 //include("../db_connect.php");
// STEP 2. Check if a user is NOT YET logged in by checking the session value
if(empty($_SESSION['logged_in'])){
 
    // if the session value is empty, he is not yet logged in
    // redirect him to login page
	
	 ?>
		   <META HTTP-EQUIV="Refresh" CONTENT="1; URL=http://masterzcreations.com/college/capstone/plan/login.php?action=not_yet_logged_in">
		   <?PHP 
   
}
?>
<html>
    <head>
    <title>File Depository @UCC  - User's Page</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="style.css" />
	

    </head>
	
	<style>
	
	</style>
	
<body>
 
<?php
// STEP 3. get and check the action
// action determines whether to logout or show the message that the user is already logged in
 
$action = $_GET['action'];
 
// executed when user clicked on "Logout?" link
if($action=='logout'){
 
    // destroy session, it will remove ALL session settings
    session_destroy();
     
    //redirect to login page
      // and redirect to your site's admin or index page
           ?>
		   <META HTTP-EQUIV="Refresh" CONTENT="1; URL=http://masterzcreations.com/college/capstone/plan/login.php">
		   <?PHP
}
 
else if($action=='already_logged_in'){
    echo "<div id='infoMesssage'>You're already logged in!</div>";
}
?>
  
<!-- some contents on our index page -->
<div id="wrapper">
<header>
		<img src="images/sample_logo_v2.png" id="head">  
		
		<!-- Testing this Menu -->
		<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Tools <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Manage Admins</a></li>
            <li><a href="#">Manage Users</a></li>
            <li><a href="#">Manage Uploads</a></li>
          </ul>
        </li>
       <!-- <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="search.php"><input type="text" name="Search_basic"><span class="glyphicon glyphicon-search"></span>Search</a></li>
        <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
		<!--<a style="float: left; margin-top:5px; height:40px; line-height:40px; font-size:16px; color: black;" class = "viewButton" href="index.php?action=logout">LogOut </a> -->
		
	</header><br>
	<div id = "recentTable">
		<table >
			<tr>
				<th colspan=3>Newest Uploads in Your Department</th>
			</tr>
			<tr>
				<td>Assignment Title</td><td>Related Tags</td><td>More Details</td>
			</tr>
			<tr>
				<td>Math & Programming 101</td><td><a href="#">Programming</a> <a href="#">IT</a><a href="#">Math</a></td><td><a href="#">Details</a></td>
			</tr>
			<tr>
				<td>Biology_Math.zip</td><td>#Science,  #Math</td><td><a href="#">Details</a></td>
			</tr>
		</table>
		
	</div>
	<div id = "personalTable">
		<table >
			<tr>
				<th colspan=3>Personal Uploads</th>
			</tr>
			<tr>
				<td>File Name</td><td>Related Tags</td><td>More Details</td>
			</tr>
			<tr>
				<td>Admin_Assignment01.zip</td><td>#Programming,  #IT, #Math, #Logic</td><td><a href="#">Details</a></td>
			</tr>
			<tr>
				<td>Adnin_Assignment02.zip</td><td>#Science,  #Math, #Programming</td><td><a href="#">Details</a></td>
			</tr>
			<tr>
				<td>Adnin_Assignment03.zip</td><td>#Research,  #Science, #IT</td><td><a href="#">Details</a></td>
			</tr>
		</table>
	</div>
	<div id = "personalTable">
		<table >
			<tr>
				<th colspan=3>Personal Downloads</th>
			</tr>
			<tr>
				<td>File Name</td><td>Related Tags</td><td>More Details</td>
			</tr>
			<tr>
				<td>Math_Programming.zip</td><td>#Programming,  #IT, #Math, #Logic</td><td><a href="#">Details</a></td>
			</tr>
			<tr>
				<td>ProfessorAdmin_AssignmentCh02.zip</td><td>#Science,  #Math, #Programming</td><td><a href="#">Details</a></td>
			</tr>
			<tr>
				<td>AnotherProfessor_Assignment03.zip</td><td>#Research,  #Science, #IT</td><td><a href="#">Details</a></td>
			</tr>
		</table>
	</div>
	<span style="clear:both;"></span>


	<table>
		<tr>
		
		</tr>
		
	</table>
</div>
 
</body>
</html>