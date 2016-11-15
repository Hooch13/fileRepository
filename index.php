<?PHP session_start();

if(empty($_SESSION['logged_in'])){

    // if the session value is empty, he is not yet logged in
    // redirect him to login page

	 ?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/login.php?action=not_yet_logged_in">
<?PHP

}
$action = $_GET['action'];
// executed when user clicked on "Logout?" link
if($action=='logout'){
session_destroy();// destroy session, it will remove ALL session settings
?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/login.php"><!-- redirect to login page -->
<?PHP
}
// STEP 2. Check if a user is logged in by checking the session value
if($_SESSION['logged_in']==true){
// if it is, redirect to index page and tell the user he's already logged in
?>
 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/dashboard.php">  
<!-- Start content if Log in is successful -->
<html>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
<?PHP

//RYAN PLEASE LOOK AT THIS, THE LOGOUT ERROR IS CAUSED BY INCLUDING NAV DO WE NEED IT HERE??? []
//include("nav.php");

} // end session login
?>
