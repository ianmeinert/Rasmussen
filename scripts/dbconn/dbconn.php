<?php
	//1and1 production settings

	//set the database connection variables 
	$dbHost = "db416085625.db.1and1.com"; 
	$dbUser = "dbo416085625"; 
	$dbPass = "h3ll#0und"; 
	$dbDatabase = "db416085625"; 
	
/*	//localhost development settings

	//set the database connection variables 
	$dbHost = "localhost"; 
	$dbUser = "root"; 
	$dbPass = "root"; 
	$dbDatabase = "BundlesOfJoy"; 
*/
	//connect to the database 
	$db = mysql_connect("$dbHost", "$dbUser", "$dbPass") or die (mysql_error()); 
	mysql_select_db("$dbDatabase", $db) or die (mysql_error()); 
	

?>