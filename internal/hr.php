<?php session_start();
	include_once("../scripts/sessionWelcome.php");
	if(!$loggedin) {header( "Location: login.php" ); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/internalSite.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Mimic use the highest mode available-->
    <meta http-equiv="X-UA-Compatible" content="IE=Emulate IE7" >
    <link href="../styles/internal.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/xmlParser.js"></script>
<!-- InstanceBeginEditable name="head" -->
<?php 
	
	include("../scripts/dbconn/dbconn.php");
	$recordUpdate = "";

	$user_id = isset($_GET['i']) ?  $_GET['i'] : "";
	
	if (isset($_POST['edit']) && $user_id != 1 && $user_id != 2 && $user_id != 3 && $user_id != 4) 
	{
		$dept = $_POST['dept'];
		
		$sql = "UPDATE users SET dept_id=$dept WHERE user_id=$user_id";
		mysql_query($sql, $db) or die(mysql_error());

		$recordUpdate = "<h3>Record <span style='color:#2582A4;'>$user_id</span> has been updated.</h3>";
	} elseif (isset($_POST['delete']))
	{
		$sql = "DELETE FROM users WHERE user_id=$user_id";
		mysql_query($sql, $db) or die(mysql_error());
	}
?>
<title>Bundles of Joy Intranet</title>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header">
        <ul id="menu">
            <?php if($loggedin)
                { //Display the links only to authorized users.
            ?>
                <li><a href="index.php" accesskey="1">Home</a></li>
                <li><a href="departments.php" accesskey="3">Departments</a>
                <!-- Start Javascript Departments submenu -->
                    <ul>
                        <li><a href="it.php">Information Technology</a></li>
                        <li><a href="hr.php">Human Resources</a></li>
                        <li><a href="training.php">Training</a></li>
                    </ul>
                </li>
                <!-- End Javascript Departments submenu -->
            <?php } ?>
                <li><a href="contact.php" accesskey="5">Contact</a></li>
                <li><a href="../index.htm" accesskey="5" target="_blank">Public Site</a></li>
        </ul>
    <span id="welcome"><?php echo $welcome;?></span>
</div>
<div id="content">
	<div id="colOne">
		<div id="logo">
			<img src="../images/internallogo.png" title="Bundles of Joy Logo" alt="Bundles of Joy logo" />
		</div>
		<div class="box">
<!-- InstanceBeginEditable name="feeds" -->
			<h2>Human Resources News</h2>
			<ul class="bottom">
            <!-- Start RSS feed -->
			<script type="text/javascript">getDept("HR"); </script>
            <!-- End RSS feed -->
			</ul>
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
        <h1>Human Resources</h1>
        <!-- Start personnel report -->
<?php
	include_once("../scripts/permissions.php");
	include_once("../scripts/fileModule.php");
	getUploadForm("HR","hr");
	getFieldset("HR","hr");
?>
<?php echo $recordUpdate; ?>

        	<table>
            	<tr>
                	<td><strong>First Name</strong></td>
                	<td><strong>Last Name</strong></td>
                	<td><strong>Email</strong></td>
                	<td><strong>Department</strong></td>
                	<td></td>
                </tr>
<?php	
	$result=mysql_query("SELECT * FROM users", $db);

	//check that at least one row was returned 
	$rowCheck = mysql_num_rows($result); 
	if($rowCheck > 0){ 
		while($row = mysql_fetch_array($result))
		{ 
?>
            <tr>
                <form action="hr.php?i=<?php echo $row["user_id"]; ?>" method="POST" onSubmit="return confirm('Are you sure?')"> 
                <td width="75px"><?php echo ucwords($row["firstname"]); ?></td>
                <td width="75px"><?php echo ucwords($row["lastname"]); ?></td>
                <td width="200px"><a href="mailto:<?php echo strtolower($row["email"]); ?>" title="Email <?php echo ucwords($row["firstname"] . " " . $row["lastname"]); ?>"><?php echo strtolower($row["email"]); ?></a></td>
<?php
	$deptResult=mysql_query("SELECT * FROM dept", $db);
	
	if(userRole("HR"))
	{
?>
                <td width="75px">
                    <select name="dept">
                        <option value='' ></option>
<?php 
						while($dept = mysql_fetch_array($deptResult))
						{ 
							if($row["dept_id"] == $dept["id"])
							{
								echo "<option selected='selected' value='$dept[id]' >$dept[dept]</option>";
							}
							else
							{
								echo "<option value='$dept[id]' >$dept[dept]</option>";
							}
						}
?>
                    </select>
                </td>
                <td><button name="edit" type="submit" >Update</button><button name="delete" type="submit" >Delete</button></td>
<?php
					} 
					else
					{
						while($dept = mysql_fetch_array($deptResult))
						{ 
							if($row["dept_id"] == $dept["id"])
							{
								echo "<td>" . ucwords($dept["dept"]) . "</td>\r\n<td></td>";
							}
							elseif($row["dept_id"] == 0)
							{
								echo "<td>&nbsp;</td>\r\n<td></td>";
							}
						}
					}
?>
                </form>
            </tr>
<?php
 		}  
	}
?>           
			</table>
        <!-- Start personnel report -->

<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>