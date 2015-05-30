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
	
	if (isset($_POST['edit'])) 
	{
		$fname = $_POST['firstName'];
		$lname = $_POST['lastName'];
		$email = $_POST['email'];
		
		$sql = "UPDATE users SET username='$fname.$lname',firstname='$fname',lastname='$lname',email='$email' WHERE user_id=$user_id";
		mysql_query($sql, $db) or die(mysql_error());

		$recordUpdate = "<h3><span style='color:#2582A4;'>$fname $lname</span>'s record has been updated.</h3><br />";
	}
	elseif (isset($_POST['delete']))
	{
		if($user_id != 1 && $user_id != 2 && $user_id != 3 && $user_id != 4)
		{
			$sql = "DELETE FROM users WHERE user_id=$user_id";
			mysql_query($sql, $db) or die(mysql_error());
		}
		else
		{
			echo "<script type='text/javascript'>alert('You may not delete this user account')</script>";
		}
	}
	elseif (isset($_POST['reset']))
	{
		if($_POST["pass1"]==$_POST["pass2"])
		{
			$user_id = $_POST["userid"];
			$regPw=md5($_POST["pass1"]);

			if($user_id != 1 && $user_id != 2 && $user_id != 3 && $user_id != 4)
			{			
				$sql = "UPDATE users SET password='$regPw' WHERE user_id=$user_id";
				mysql_query($sql, $db) or die(mysql_error());
				
				$result=mysql_query("SELECT * FROM users WHERE user_id=$user_id", $db);
				$rowCheck = mysql_num_rows($result); 
	
				if($rowCheck > 0){ 
					while($row = mysql_fetch_array($result))
					{ 
						$recordUpdate = "<h3><span style='color:#2582A4;'>$row[firstname] $row[lastname]</span>'s password has been changed.</h3><br />";
					}
				}
			}
			else
			{
				echo "<script type='text/javascript'>alert('You may not change this user accounts password')</script>";
			}
		}
	}
	elseif (isset($_POST['paBtn']))
	{
		$user_id = $_POST["paUser"];;
		$dept_id = $_POST["paDept"];
		$role_id = $_POST["paRole"];

		if($user_id != 1 && $user_id != 2 && $user_id != 3 && $user_id != 4)
		{			
			$result=mysql_query("SELECT * FROM userRole WHERE user_id=$user_id AND dept_id=$dept_id", $db);
			$rowCheck = mysql_num_rows($result) > 0 ? mysql_num_rows($result) : -1; 
	
			if($rowCheck > 0){ 
				while($row = mysql_fetch_array($result))
				{ 
					echo "<script type='text/javascript'>alert('User already has permissions for that department')</script>";
				}
			}
			else
			{
				$sql = "INSERT INTO userRole (user_id, role_id, dept_id) VALUES ($user_id, $role_id, $dept_id)";
				mysql_query($sql, $db) or die(mysql_error());
				echo "<script type='text/javascript'>alert('Permissions granted')</script>";
			}
		}
		else
		{
			echo "<script type='text/javascript'>alert('You may not modify this user account')</script>";
		}
	}
	elseif (isset($_POST['pmBtn']))
	{
		$userRole_id = $_GET["i"];
		$role_id = $_POST['pmRole'];
		$user_id = $_POST['user_id'];
		
		if($user_id != 1 && $user_id != 2 && $user_id != 3 && $user_id != 4)
		{						
			if($role_id == "" || is_null($role_id))
			{
				$sql = "DELETE FROM userRole WHERE id=$userRole_id";			
			}
			else
			{
				$sql = "UPDATE userRole SET role_id=$role_id WHERE id=$userRole_id";	
			}

			mysql_query($sql, $db) or die(mysql_error());
			echo "<script type='text/javascript'>alert('Permissions updated')</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('You may not modify this user account')</script>";
		}
	}
?>
    <title>Bundles of Joy Intranet</title>
    
    <script src="../scripts/SpryValidationPassword.js" type="text/javascript"></script>
    <script src="../scripts/SpryTabbedPanels.js" type="text/javascript"></script>
    <script src="../scripts/SpryURLUtils.js" type="text/javascript"></script>
    <script src="../scripts/SpryValidationSelect.js" type="text/javascript"></script>
    <script type="text/javascript">
		var params = Spry.Utils.getLocationParamsAsObject();
	</script>
	<link href="../styles/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
    <link href="../styles/SpryValidationPassword.css" rel="stylesheet" type="text/css">
	<link href="../styles/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
			<h2>IT News</h2>
			<ul class="bottom">
            <!-- Start RSS feed -->
			<script type="text/javascript">getDept("Helpdesk"); </script>
            <!-- End RSS feed -->
			</ul>
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
        <h1>IT Department</h1>
<?php
	include_once("../scripts/permissions.php");
	include_once("../scripts/fileModule.php");
	getUploadForm("IT","it");
	getFieldset("IT","it");

	echo $recordUpdate;

	if(userRole("IT"))
	{	
?>
    <div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
            <li class="TabbedPanelsTab" tabindex="0">Employee Update</li>
            <li class="TabbedPanelsTab" tabindex="0">Password Reset</li>
            <li class="TabbedPanelsTab" tabindex="0">Set Permissions</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
            <div class="TabbedPanelsContent">

                <table>
                    <tr>
                        <td><strong>First Name</strong></td>
                        <td><strong>Last Name</strong></td>
                        <td><strong>Email</strong></td>
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
                <form action="it.php?i=<?php echo $row["user_id"]; ?>" method="POST" onSubmit="return confirm('Are you sure?')"> 
                <td><input name="firstName" type="text" value="<?php echo $row["firstname"]; ?>" size="10" /></td>
                <td><input name="lastName" type="text" value="<?php echo $row["lastname"]; ?>" size="15" /></td>
                <td><input name="email" type="text" value="<?php echo $row["email"]; ?>" size="35" /></td>
                <td><button name="edit" type="submit" >Update</button><button name="delete" type="submit" >Delete</button></td>
                </form>
            </tr>
<?php
 		}  
	}
?>          
				</table>
            </div>
            <div class="TabbedPanelsContent">
                <p>Select a user below to reset their password</p>
                <table>
                    <tr>
                        <td>UserName</td>
                        <td>New Password</td>
                        <td>Repeat Password</td>
                        <td></td>
                    </tr>
<?php
						$result=mysql_query("SELECT * FROM users", $db);
					
						//check that at least one row was returned 
						$rowCheck = mysql_num_rows($result); 
						if($rowCheck > 0)
						{ 
?>
                    <tr>
                        <form action="it.php?tab=1#TabbedPanels1" method="POST">                            
                            <td>
                                <select name="userid">
                                    <option value='' ></option>
<?php 
										while($row = mysql_fetch_array($result))
										{ 
											echo "<option value='$row[user_id]' >$row[username]</option>";
										}
?>
                                </select>
                            </td>
                            <td>
                                <span id="sprypassword1">
                                    <input name="pass1" type="password" size"20" />
                                <span class="passwordRequiredMsg">A valid password is required.</span></span>
                            </td>
                            <td><input name="pass2" type="password" size="20" /></td>
                            <td><button name="reset" type="submit" >Change</button></td>
                        </form>
                    </tr>
<?php
	 					}
?>
                </table>
            </div>
            <div class="TabbedPanelsContent">
            	<ul id="permMenu">
                    <li><a href="?pa&tab=2#TabbedPanels1">Add permissions</a></li>
                    <li><a href="?pm&tab=2#TabbedPanels1">Modify permissions</a></li>
              	</ul>
                <br />
                <hr style="width:100%;" />
<?php
				if(isset($_GET['pa']))
				{
?>
                    <div id="pa">
                    
                    <form action="?pm&tab=2#TabbedPanels1" method="POST">
                      <span id="spryselect1">
                      <select name="paUser">
                        <option value=''></option>
                        <?php 
								$result=mysql_query("SELECT * FROM users", $db);
							
								//check that at least one row was returned 
								$rowCheck = mysql_num_rows($result); 
								if($rowCheck > 0)
								{ 

                                    while($row = mysql_fetch_array($result))
                                    { 
                                        echo "<option value='$row[user_id]' >$row[username]</option>";
                                    }
								}
?>
                      </select>
                      <span class="selectRequiredMsg">Please select a user.</span></span>
                      <span id="spryselect2">
                      <select name="paDept">
                        <option value=''></option>
                        <?php 
								$result=mysql_query("SELECT * FROM dept", $db);
							
								//check that at least one row was returned 
								$rowCheck = mysql_num_rows($result); 
								if($rowCheck > 0)
								{ 

                                    while($row = mysql_fetch_array($result))
                                    { 
                                        echo "<option value='$row[id]' >$row[dept]</option>";
                                    }
								}
?>
                      </select>
                      <span class="selectRequiredMsg">Please select a department.</span></span>
                      <span id="spryselect3">
                      <select name="paRole">
                        <option value=''></option>
                        <option value='0'>User</option>
                        <option value='1' >Admin</option>
                      </select>
                      <span class="selectRequiredMsg">Please select a role.</span></span><br />
                        <button name="paBtn" type="submit" onclick="return confirm('Add user permissions?')" >Add Permissions</button>
                    </form>
                            
                    </div>
<?php
				}
				elseif(isset($_GET['pm']))
				{
?>
                    <div id="pm">
                        <table>
                            <tr>
                                <td><strong>First Name</strong></td>
                                <td><strong>Last Name</strong></td>
                                <td><strong>Department</strong></td>
                                <td><strong>Role</strong></td>
                                <td></td>
                            </tr>
            <?php	
                $result=mysql_query("SELECT userRole.id AS userRole_id, firstName, lastName, dept, role.id AS role_id, users.user_id AS user_id " .
									"FROM userRole " .
									"JOIN dept ON dept.id = userRole.dept_id " .
									"JOIN role ON role.id = userRole.role_id " .
									"JOIN users ON users.user_id = userRole.user_id " .
									"ORDER BY dept, lastName, firstName", $db);
            
                //check that at least one row was returned 
                $rowCheck = mysql_num_rows($result); 
                if($rowCheck > 0){ 
                    while($row = mysql_fetch_array($result))
                    { 
            ?>
                        <tr>
                            <form action="it.php?i=<?php echo $row["userRole_id"]; ?>&pm&tab=2#TabbedPanels1" method="POST" onSubmit="return confirm('Are you sure?')"> 
                            <td width="75px"><?php echo ucwords($row["firstName"]); ?><input name="user_id" type="hidden" value="<?php echo $row["user_id"]; ?>" /></td>
                            <td width="75px"><?php echo ucwords($row["lastName"]); ?></td>
                            <td width="75px"><?php echo ucwords($row["dept"]); ?></td>
            <?php
                			$deptResult=mysql_query("SELECT * FROM role", $db);               
            ?>
                            <td width="75px">
                                <select name="pmRole">
                                    <option value='' ></option>
            <?php 
                                    while($role = mysql_fetch_array($deptResult))
                                    { 
                                        if($row["role_id"] == $role["id"])
                                        {
                                            echo "<option selected='selected' value='$role[id]' >$role[role]</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='$role[id]' >$role[role]</option>";
                                        }
                                    }
            ?>
                                </select>
                            </td>
                            <td><button name="pmBtn" type="submit" >Update Permissions</button></td>
                            </form>
                        </tr>
            <?php
                    }  
                }
            ?>           
                        </table>
                    </div>
<?php
				}
?>            
			</div>
        </div>
    </div>
<script type="text/javascript">
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", {defaultTab: params.tab ? params.tab : 0});
	var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
	var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
	var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
	var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
</script>
<?php } ?>
<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>