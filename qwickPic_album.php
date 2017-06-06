<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//give an error if an admin tries to access this page

    	throw new exception("Admins cannot create albums!");
    }//end if

?>

	<h2>Create an Album:</h2><br><br>
	<form method = "POST" action = "qwickPic_albumSubmit.php" enctype = 'multipart/form-data'>
		<input type = "text" class = "album2_pic" autocomplete =  "off" name = "album_name"  title = "Give your album a unique name" required="required" placeholder="Enter an Album Name" autofocus><br><br><br>
		<input type = "file" autocomplete =  "off" name = "cover_photo"  title = "Upload a cover photo for your album, only .jpg, .png, .tiff or .gif formats" required="required"><br><br><br>
		<button type = "submit">Submit</button>	
	</form>
