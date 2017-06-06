<?php

 function create_album($name, $cover_photo)
 {//inserts the albums properties into the datbase 
    $conn = db_connect();

    $user_id = $_SESSION['user_id'];
 //created an album based on the user's id and the parameters they provided
 	$sql = "INSERT INTO album (album_name, cover_photo, user_id) VALUES 
 	('$name', '$cover_photo', '$user_id')";

 	mysqli_query($conn, $sql);

 	echo '<h2>Your album was created!</h2>';

 }//end function create_album

 function upload_picture($caption, $src, $album)
 {//inserts the picture into database
 	$conn = db_connect();
 	$user_id = $_SESSION['user_id']; 

 //gets the album id from the selected album
 	$sql = "SELECT album_id FROM album WHERE album_name = '$album'";
 	$result = mysqli_query($conn, $sql);
 	$row = mysqli_fetch_assoc($result); //puts the album_id into an array
 	$album_id = $row['album_id'];

 	$sql2 = "INSERT INTO pictures (caption, source, user_id, album_id) VALUES
 	('$caption', '$src', '$user_id', '$album_id')";
 	$result2 = mysqli_query($conn, $sql2);

 	echo '<h2>Your Picture was uploaded!</h2>';
 }//end function upload_picture



?>