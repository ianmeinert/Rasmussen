<?php

	function getUploadForm($dept,$departmentName)
	{
		if(userRole($dept))
		{
			$dirPath = "/homepages/9/d246989286/htdocs/rasmussen/internal/uploads/$departmentName/";
			echo "<form id='ulForm' action='$departmentName.php' method='POST' enctype='multipart/form-data'>";
			echo "<label for='file'>File to upload: </label><input type='file' name='file' width='100px' /><br />";
			echo "<input type='submit' name='submit' value='Upload' style='margin-top:25px' />";
			echo "</form>";
			
			formAction($dirPath);
		}
	}

	function formAction($dirPath)
	{	
		if (isset($_POST['submit'])) 
		{
			if ($_FILES["file"]["error"] > 0)
			{
				if($_FILES["file"]["error"] == 4)
				{
					echo "<h3>A file must be selected to upload.</h3>";
				}
				else
				{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				}
			}
			else
			{
				if (file_exists($dirPath . $_FILES["file"]["name"]))
				{
					echo "<h3>" . $_FILES["file"]["name"] . " already exists.</h3>";
				}
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"],
					"$dirPath" . $_FILES["file"]["name"]);
					echo "<h3>File " . $_FILES["file"]["name"];
					echo " successfully uploaded.</h3>";
				}
			}
		}
		if (isset($_GET['delete']))
		{
			delFile($dirPath);
		}
	}

	function delFile($dirPath)
	{
		$myFile = $dirPath . $_GET['delete'];
		if(file_exists($myFile))
		{
			unlink($myFile);
			echo "<h3>$_GET[delete] has been deleted.</h3>";
		}
	}
		
	function getFieldset($dept,$dir)
	{
		$directory ="uploads/$dir/";

		$contents = scandir($directory); 
		if ($contents)
		{ 
			foreach($contents as $key => $value)
			{
				if ($value == "." || $value == "..")
				{ 
					unset($key); 
				} 
			} 
		}
		
		echo "<div style='padding:25px;'><fieldset><legend>" . strtoupper($dir) . " DOCUMENTS</legend><ul>";
		foreach (new DirectoryIterator($directory) as $file) {
		   if ( (!$file->isDot()) && ($file->getFilename() != basename($_SERVER['PHP_SELF'])))
		   {
			   	$fileName = $file->getFilename();
				echo "<li><a href='$directory" . $fileName . "' target='_blank'>" . ucwords($fileName)  . "</a>";
				if(userRole($dept))
				{
					echo "<a href=\"?delete=" . $file->getFilename() . "\" onclick=\"return confirm('Really delete?');\">Delete</a></li>"; }
		   }
		}
		echo "</ul></fieldset></div>";
	}