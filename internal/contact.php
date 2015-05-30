<?php session_start();
	include_once("../scripts/sessionWelcome.php");
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
	<script src="../scripts/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="../scripts/SpryValidationTextarea.js" type="text/javascript"></script>
    <link href="../styles/SpryValidationTextField.css" rel="stylesheet" type="text/css">
    <link href="../styles/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
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
            <!-- Start Industry RSS feed -->
			<?php include_once("../feeds/industry.php"); ?>
            <!-- End RSS feed -->
			</ul>
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
    <div id="contact">
    	<h1>Contact Form</h1>
		<p>Can't find something? Did you forget your password? Is something broken? Let the helpdesk know by filling out the below form.</p>
        <form action="mailto:ian.meinert@smail.rasmussen.edu" method="POST" name="contactForm">
            <table>
                <tr>
                    <td>Name:</td>
                    <td>
                      <span id="sprytextfield1">
                            <input name="name" type="text" size="20" maxlength="20" value="<?php echo $_SESSION['sesusername']; ?>" /><br />
                            <span class="textfieldRequiredMsg">Please include your name.</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                  	<td>
                      <span id="sprytextfield2">
                            <input name="email" type="text" size="20" maxlength="50" value="<?php echo $_SESSION['sesemail']; ?>" /><br />
                            <span class="textfieldRequiredMsg">A valid email address is required.</span>
                        </span>
                    </td>
                </tr>
                <tr>
					<td colspan="2">
                    	<p>Please describe your issue in detail.<br />
						<span id="sprytextarea1">
                            <span class="textareaRequiredMsg">Did you forget to add your issue?</span>
                            <textarea name="comments" cols="45" rows="5"></textarea>
                        </span></p>
                  	</td>
                    
                </tr>
                <tr>
                	<td colspan="2">
                    <button name="Submit" type="submit" value="Submit">Submit</button><input name="Reset" type="reset" />
                    </td>
            
          </table>
        </form>
    </div>
	<script type="text/javascript">
		var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
		var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
		var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
    </script>
<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>