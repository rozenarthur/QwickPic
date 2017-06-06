<?php

	function delete_photo()
	{//deletes the photo with the specified picture_id
		$conn = db_connect();

		$picture_id = get_url_pic_id();//gets the picid from url

		$sql = "DELETE FROM pictures WHERE picture_id = '$picture_id'";
		$result = mysqli_query($conn, $sql);

		if($result == 1)
		{//if the picture was found
			echo "<script type = 'text/javascript'>
                      alert('The Picture was deleted!');
                      </script>";
            if(isset($_SESSION['admin']))
            {//if admin activates this function return to homepage
            	header("Refresh: 0.01; url = qwickPic_home.php");
            }//end if
            
            else
            {//else return to my pictures
				header("Refresh: 0.01; url = qwickPic_pictures.php");
			}
		}

		else
		{//picture was not found
			echo "<script type = 'text/javascript'>
                      alert('Error: The Picture was not deleted!');
                      </script>";
                      
		}//end else		
	}//end function delete photo

	function change_caption($caption)
	{ //changes the caption of the given picture
		$conn = db_connect();

		$picture_id = get_url_pic_id(); //gets pic id from url

		$sql = "UPDATE pictures SET caption = '$caption' WHERE picture_id = '$picture_id'";
		$result = mysqli_query($conn, $sql);

		if($result == 1)
		{//if the picture was found
			echo "<script type = 'text/javascript'>
                      alert('The caption has been changed!');
                      </script>";
            header("Refresh: 0.01; url = qwickPic_pictures.php");
		}//end if

		else
		{//picture was not found
			echo "<script type = 'text/javascript'>
                      alert('Error: The caption was not changed!');
                      </script>";
		}//end else		
	}//end function change caption

	function move_albums($album)
	{//allows there pictures to a different album

		$conn = db_connect();

		$picture_id = get_url_pic_id(); //gets pic id from url

		$sql = "SELECT album_id FROM album WHERE album_name = '$album'";
 		$result = mysqli_query($conn, $sql);
 		$row = mysqli_fetch_assoc($result); //puts the album_id into an array
 		$album_id = $row['album_id'];

		$sql2 = "UPDATE pictures SET album_id = '$album_id' WHERE picture_id = '$picture_id'";
		$result2 = mysqli_query($conn, $sql2);

		if($result2 == 1)
		{//if the picture was found
			echo "<script type = 'text/javascript'>
                      alert('The Album has been changed!');
                      </script>";
            header("Refresh: 0.01; url = qwickPic_pictures.php");
		}//end if

		else
		{//picture was not found
			echo "<script type = 'text/javascript'>
                      alert('Error: The album was not changed!');
                      </script>";
		}//end else		

	}//end function move albums

?>