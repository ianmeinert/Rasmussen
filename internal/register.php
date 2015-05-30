<?php session_start();
	include_once("../scripts/sessionWelcome.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/internalSite.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Mimic use the highest mode available-->
    <meta http-equiv="X-UA-Compatible" content="IE=Emulate IE7" >
    <link href="../styles/internal.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/xmlParser.js"></script>
<!-- InstanceBeginEditable name="head" -->
    <style>
		#emailRequiredMsg
		{
			display:none;	
			color:#CC3333;
		}
	</style>
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />

    <title>Bundles of Joy Intranet</title>
	<script src="../scripts/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="../styles/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
		<!-- List industry and company news feeds here -->
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
<?php
	if(!$loggedin)
	{
?>
        <FORM ACTION="register.php" METHOD="POST">
            <p>Please input the registration details to create an account here</p>
            <table>
                <tr>
                    <td>First Name :</td>
                    <td><span id="sprytextfield1">
                      <input name="regfname" type="text" size"20" maxlength="15" value="<?php if(isset($_POST["regfname"])){echo $_POST["regfname"];}else{echo "";}?>" />
                    <span class="textfieldRequiredMsg">First name is required.</span></span></td>
                </tr>
                <tr>
                    <td>Last Name :</td>
                    <td><span id="sprytextfield2">
                      <input name="reglname" type="text" size"20" maxlength="25" value="<?php if(isset($_POST["reglname"])){echo $_POST["reglname"];}else{echo "";}?>" />
                    <span class="textfieldRequiredMsg">Last name is required.</span></span></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><span id="sprytextfield3">
                    <input name="regemail" type="text" size"20" maxlength="50" value="<?php if(isset($_POST["regemail"])){echo $_POST["regemail"];}else{echo "";}?>" />
                    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid email format.</span></span></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><span id="sprytextfield4">
                      <input name="regpass1" type="password" size"20" />
                    <span class="textfieldRequiredMsg">A password is required.</span></span></td>
                </tr>
                <tr>
                    <td>Retype password :</td>
                    <td><input name="regpass2" type="password" size"20" /></td>
                </tr>
            </table>
            <input type="submit" value="Register me!" onclick="return validateEmail()"></input>
        </FORM>
<?php } else
{
	echo "You are already registered.";
}
?>
<?php include_once("../scripts/regUser.php");?>

<script type="text/javascript">
	var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
	var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
	var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
	var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>