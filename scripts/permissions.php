<?php
	function userRole($roleDept)
	{
		global $loggedin;
		if($loggedin)
		{
			$user = $_SESSION['sesusername'];
			include("dbconn/dbconn.php");
			$result=mysql_query("SELECT * FROM users where username='$user'", $db); 
			
			//check that at least one row was returned 
			$rowCheck = mysql_num_rows($result); 
			if($rowCheck > 0){ 
				while($row = mysql_fetch_array($result)){ 
					$id = $row['user_id'];
				}
			} 

			$sql = "SELECT dept, role, users.user_id FROM userRole JOIN dept ON dept.id = userRole.dept_id JOIN role ON role.id = userRole.role_id JOIN users ON users.user_id = userRole.user_id WHERE users.user_id = $id AND dept = '$roleDept' and role.role = 'Admin'";
			$result=mysql_query($sql, $db) or die(mysql_error());

			//check that at least one row was returned 
			$rowCheck = mysql_num_rows($result); 
			if($rowCheck > 0){ 
				return TRUE;
			} 
			else
			{
				return FALSE;	
			}
		}
		else
		{
			return FALSE;
		}
	}
?>