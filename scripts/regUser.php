<?php
	if(isset($_POST["regfname"]) && isset($_POST["reglname"]) && isset($_POST["regemail"]) && isset($_POST["regpass1"]) && isset($_POST["regpass2"]) )
	{
		if($_POST["regpass1"]==$_POST["regpass2"])
		{
			if(get_magic_quotes_gpc()) {
				$regFname = htmlspecialchars(stripslashes($_POST["regfname"]));
				$regLname = htmlspecialchars(stripslashes($_POST["reglname"]));
				$regEmail = htmlspecialchars(stripslashes($_POST["regemail"]));
			}
			else 
			{
				$regFname = htmlspecialchars($_POST["regfname"]);
				$regLname = htmlspecialchars($_POST["reglname"]);
				$regEmail = htmlspecialchars($_POST["regemail"]);
			}
			$regUsername = $regFname . "." . $regLname;
			$regPw=MD5($_POST["regpass1"]);
			
			include("dbconn/dbconn.php");

			//Verify account doesn't exist
			$sql="select * from users where username='$regUsername'";
			$result=mysql_query($sql, $db) or die(mysql_error()); 
			
			//check that at least one row was returned 
			$rowCheck = mysql_num_rows($result); 
			if($rowCheck > 0){
				echo "<h1>Account already exists</h1>";
				echo "<p>If you have forgotten your password, please contact the helpdesk.</p>";
			} 
			else
			{
				//connect to the database 
				$sql = "INSERT INTO users (username,password,firstname,lastname,email) VALUES ('$regUsername','$regPw','$regFname','$regLname','$regEmail')";
				$result=mysql_query($sql, $db) or die(mysql_error()); 
				echo "<div style='border:solid 1px #CC3333; margin-bottom:25px;padding:25px;'>";
				echo "<h1>You have registered sucessfully</h1>";
				echo "<p>Your username is <strong>",$regUsername,"</strong>, and your password is <strong>",$_POST["regpass1"], "</strong>.</p>";
				echo "<p><a href='login.php'>Go to login page</a></p>";echo "</div>";
				
			}
		}
		else
		{
			echo "Your passwords do not match";
		}
	}
?>
