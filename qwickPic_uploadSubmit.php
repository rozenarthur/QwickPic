<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//give an error if an admin tries to access this page

    	throw new exception("Admins cannot upload pictures!");
    }//end if

    else if (isset($_POST['caption']) && isset($_FILES['picture']) && isset($_POST['drop']))
    {//if the textfield was entered and the file was not empty
    	$caption = $_POST['caption'];
    	$photo = $_FILES['picture'];
    	$drop = $_POST['drop'];

    	$src = "Photos/"; //starting path where image will be uploaded to

    	//file properties
    	$pic_name = $photo['name']; //gets name of uploaded file
    	$pic_size = $photo['size']; //gets size of file of the uploaded file
    	$pic_tmp = $photo['tmp_name']; //gets the current location of file

    	//get the extension of the file by separating the name by when there is a "." and adds it to the next array value
    		$pic_ext = explode('.', $pic_name);
    		$begin = current($pic_ext); //gets the name of the file without extensionm
    		$pic_ext = strtolower(end($pic_ext)); //gets the last value(extension) in array and converts it lower case

    		$allowed = ['jpg', 'jpeg', 'png', 'gif', 'tiff']; //supported file formats allowed to upload

    		if(in_array($pic_ext, $allowed))
    		{//checks if the file uploaded has one of the supported extensions
    			if($pic_size < 10485760)
    			{ //if image is less than 10MB

    				//concatentaes the path with file location for final file path
    				$src .= $begin . ".". $pic_ext;

    				if(copy($pic_tmp, $src))
    				{ //if the upload was successful 

    					upload_picture($caption, $src, $drop); //adds album data to database
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