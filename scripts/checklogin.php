<?php 
	//check that the user is calling the page from the login form and not accessing it directly 
	//and redirect back to the login form if necessary 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (!isset($username) || !isset($password)) { 
		header( "Location: ../internal/login.php" ); 
	} 
	//check that the form fields are not empty, and redirect back to the login page if they are 
	elseif (empty($username) || empty($password)) { 
		header( "Location: ../internal/login.php" ); 
	} 
	else{ 
		//convert the field values to simple variables 
		//add slashes to the username and md5() the password 
		$user = addslashes($username); 
		$pass = md5($password); 
		
		include("dbconn/dbconn.php");

		$sql = "select * from users where username='$user' AND password='$pass'";
		$result=mysql_query($sql, $db); 
		
		//check that at least one row was returned 
		$rowCheck = mysql_num_rows($result); 
		if($rowCheck > 0){ 
			while($row = mysql_fetch_array($result)){ 
				//start the session and register a variable 
				session_start(); 
				$_SESSION['sesusername'] = $row['username']; 
				$_SESSION['sesfirstname'] = $row['firstname']; 
				$_SESSION['seslastname'] = $row['lastname']; 
				$_SESSION['sesemail'] = $row['email']; 
				$_SESSION['sesdept'] = $row['dept']; 
				
				
				//we will redirect the user to another page where we will make sure they're logged in 
				header( "Location: ../internal/index.php" ); 
			} 
		} 
		else
		{ 
			//if nothing is returned by the query, unsuccessful login code goes here... 
			header( "Location: ../internal/login.php?invalid" ); 
		} 
		
		mysql_close($db);
	} 
?>