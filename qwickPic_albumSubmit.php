<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//give an error if an admin tries to access this page

    	throw new exception("Admins cannot create albums!");
    }//end if

    else if (isset($_POST['album_name']) && isset($_FILES['cover_photo']))
    {//if the textfield was entered and the file was not empty

    		//gets the textfield and file entered
    		$name = $_POST['album_name'];
    		$cover_photo = $_FILES['cover_photo'];

    		//path where cover photo will be store
    		$src = "Photos/album_cover/";

    		//file properties
    		$cover_name = $cover_photo['name']; //gets name of uploaded file
    		$cover_size = $cover_photo['size']; //gets size of file of the uploaded file
    		$cover_tmp = $cover_photo['tmp_name']; //gets the current location of file

//get the extension of the file by separating the name by when there is a "." and adds it to the next array value
    		$cover_ext = explode('.', $cover_name);
    		$begin = current($cover_ext); //gets the name of the file without extensionm
    		$cover_ext = strtolower(end($cover_ext)); //gets the last value(extension) in array and converts it lower case

    		$allowed = ['jpg', 'jpeg', 'png', 'gif', 'tiff']; //supported file formats allowed to upload

    		if(in_array($cover_ext, $allowed))
    		{//checks if the file uploaded has one of the supported extensions
    			if($cover_size < 10485760)
    			{ //if image is less than 10MB

    				//concatentaes the path with file location for final file path
    				$src .= $begin . ".". $cover_ext;

    				if(copy($cover_tmp, $src))
    				{ //if the upload was successful 

    					create_album($name, $src); //adds album data to database
    				}//end if

    				else
    				{//upload was not successful
    					echo "<h2>Error: The upload was not successful, please try again!</h2>";
    				}//end else

    			}//end inner if

    			else
    			{ //if image is bigger than 10MB

    				echo "<h2>Error: File is to large! Please upload a smaller file!</h2>";
    			}//end else
    		}//end if

    		else
    		{ //unsupported file format
    			echo "<h2>Error: Unsupported file format, please try again!</h2>";
    		}
    } //end else if

    else
    {//if the textfield or the uploaded file was empty
    		echo "<h2>Error: One or more fields was empty, please try again!</h2>";
    }//end else

?>