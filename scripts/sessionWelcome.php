<?php 
	//start the session 
	$username = empty($_SESSION['sesusername']) ? "" : $_SESSION['sesusername'];
	$fullname = empty($_SESSION['sesfirstname']) || empty($_SESSION['seslastname']) ? "" : $_SESSION['sesfirstname']." ".$_SESSION['seslastname'];
	//check to make sure the session variable is registered 
	$loggedin = false;
	
	if($username != "" && $username != null)
	{ 
		$loggedin = true;
		$welcome = "Welcome back ". $fullname .". <a href='login.php?logout'>logout</a>";
	} 
	else
	{ 
		$welcome = "Welcome guest. Please <a href='login.php'>login</a>";
	} 
?>