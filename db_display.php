<?php
// STEP 1. Start the PHP session.
// should be the first to start, to prevent 'headers already sent' errors
session_start();
 include("../db_connect.php");
// STEP 2. Check if a user is NOT YET logged in by checking the session value
if(empty($_SESSION['logged_in'])){
 
    // if the session value is empty, he is not yet logged in
    // redirect him to login page
    header('Location: login.php?action=not_yet_logged_in');
}
?>
<html>
    <head>
    <title>Application Area</title>
    <link type="text/css" rel="stylesheet" href="style.css" />
    </head>
	
	<style>
	 #wrapper{
		
		 
	 }
	#title{
		text-align:left;
		font-size: 25px;
		color: white;
		
	}
	header{
		width: 80%;
		min-width: 580px;
		margin-left: auto;
		margin-right: auto;
		padding:5px;
	}
	#head{
		width: 100%;
		min-width: 580px;
	}
	</style>
	
<body>
 
<?php
// STEP 3. get and check the action
// action determines whether to logout or show the message that the user is already logged in
 
$action = $_GET['action'];
 
// executed when user clicked on "Logout?" link

else if($action=='already_logged_in'){
    echo "<div id='infoMesssage'>You're already logged in!</div>";
}
?>
 
<!-- some contents on our index page -->
<header>
		<img src="/images/Website/Header/1509008-The-Lantern-web-banner.png" id="head">  <a style="float: right; margin-top:5px; height:40px; line-height:40px; font-size:16px; color: black;" class = "viewButton" href="index.php?action=logout">LogOut </a> 
		<br><br><div id="title">Viewing Applications</div>
	</header><br>
	<span style="clear:both;"></span>
<div id="wrapper">

	<table>
		<tr>
		<th class='rowID' >#</th><th>Name</th><th>Date Submitted</th><th>EMail</th><th>Completed<br> App</th>
		</tr>
		<?PHP  
			$query = "SELECT * FROM Employment ORDER BY  app_id DESC"; 
			$results = $dbc->query($query);
			while($row = $results->fetch_array())
			{
				echo "<tr>";
				echo "<td class='rowID'>". $row["app_id"] . "</td>";
				echo "<td>". $row["FName"] ." ". $row["LName"] .  "</td>";
				echo "<td>". $row["CompletedDate"] . "</td>";
				echo "<td> <a style='text-decoration: none; color: red;' href='mailto:". $row["EMail1"] . "'/a>". $row["EMail1"]."</td>";
				echo "<td style='border-bottom: none;'><a class ='viewButton' href='app.php?record=". $row["app_id"] . "' target='viewer'>View</a></td>";
				echo "</tr>";
			}
		
		?>
	</table>
</div>
 
</body>
</html>