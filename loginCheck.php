<?PHP
session_start();
if(empty($_SESSION['logged_in'])){

    // if the session value is empty, he is not yet logged in
    // redirect him to login page

    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL= http://masterzcreations.com/college/capstone/login.php?action=not_yet_logged_in">    <?PHP

}
$action = $_GET['action'];

// executed when user clicked on "Logout?" link
if($action=='logout'){

    // destroy session, it will remove ALL session settings
    session_destroy();

    //redirect to login page
    // and redirect to your site's admin or index page
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://masterzcreations.com/college/capstone/login.php">    <?PHP
}
// STEP 2. Check if a user is logged in by checking the session value
if($_SESSION['logged_in']==true){

// if it is, redirect to index page and tell the user he's already logged in
?>

<!-- Start content if Log in is successful -->
<html>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">

<?php
}
?>

