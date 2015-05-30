<?php session_start();
	include_once("../scripts/sessionWelcome.php");
	if(!$loggedin) {header( "Location: login.php" ); } ?>
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
			<h2>Training News</h2>
			<ul class="bottom">
            <!-- Start RSS feed -->
			<script type="text/javascript">getDept("Training"); </script>
            <!-- End RSS feed -->
			</ul>
<!-- InstanceEndEditable -->
		</div>
	</div>
	<div id="colTwo">
<!-- InstanceBeginEditable name="body" -->
        <h1>Training Department</h1>
        <?php include_once("../scripts/permissions.php"); ?>
        <?php include_once("../scripts/fileModule.php"); ?>
        
        <?php
			getUploadForm("TRNG","training");
			getFieldset("TRNG","training");
		?>
<!-- InstanceEndEditable -->
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2012 | Ian Meinert | All rights reserved</p>
</div>
</body>
<!-- InstanceEnd --></html>
