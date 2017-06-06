<?php

	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//give an error if an admin tries to access this page

    	throw new exception("Admins cannot upload pictures");
    }//end if

    $result = get_albums(); //gets the album query

    if(!$s = mysqli_fetch_assoc($result))
    {// if no albums are found than the user has not created any
    	echo "<script type = 'text/javascript'>
                    alert('You do not have any albums, you have to create one first!');
                    </script>";

        header("Refresh: 0.01; url = qwickPic_album.php"); //refreshes page and goes to the create album page
    }//end if

?>
	
	<h2>Upload a new Picture:</h2><br><br>
	
	<form method = "POST" action = "qwickPic_uploadSubmit.php" enctype = 'multipart/form-data'>
		<input type = "text" autocomplete =  "off" class = "photo2_pic" name = "caption"  title = "Give your picture a unique caption!" required="required" placeholder="Enter a Caption" autofocus><br><br><br>
		<input type = "file" autocomplete =  "off" name = "picture"  title = "Upload a picture for your album, only .jpg, .png, .tiff or .gif formats" required="required"><br><br><br>

<?php

		display_dropdown(); //function to display dropdown of all albums by the user in session
?>

		<br><br><br><button type = "submit">Upload</button>
	</form>
