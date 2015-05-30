<?php session_start();
	include_once("../scripts/sessionWelcome.php");
	if(isset($_GET['logout'])){ 
		session_unset(); 
		header("location: ../index.htm");  
	} 
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
			<h2>Industry News</h2>
			<ul class="bottom">
            <!-- Start RSS feed -->
			<?php include_once("../feeds/industry.php"); ?>
            <!-- End RSS feed -->
			</ul>
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
<?php
	if($username != "" && $username != null)
	{
		echo "<p>You are already logged in. Click here to <a href='index.php'>return to home</a>.</p>";
        echo "<p>Click here to <a href='?logout'>logout</a>.</p>";
	}
	else
	{
		echo "<h1>Login</h1>";
		if(isset($_GET['invalid']))
		{
			echo "Incorrect login name or password. Please try again.";
		}
?>
            <form method="POST" action="../scripts/checklogin.php"> 
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" size="20" /></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" size="21" /></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Submit" name="login" /></td>
                        <td>
                        	<a href="register.php">Register</a>
                        </td>
                    </tr>
                </table>
            </form>
<?php } ?>
<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>