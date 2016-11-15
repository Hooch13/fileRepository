<?PHP
	include("library.php");
	function password_reset($dbc, $email)
	{
	
	$forgotQuery = "SELECT * FROM tUser join on tSecurityQuestion WHERE  tSecurityQuestion.SecurityQuestionID = tUser.SecurityQuestionID AND tUser.Email = " . ;
	$results = $dbc->query($forgotQuery);
	return $results;
	
	}
	if(isset)
?>