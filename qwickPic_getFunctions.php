<?php

function get_albums()
 {//gets the user's albums
    $conn = db_connect();
    $user_id = $_SESSION['user_id'];

//searches query where the user_id is the session logged in from albums 
    $sql = "SELECT * FROM album WHERE user_id = '$user_id'";
    return mysqli_query($conn, $sql);
 } //end function get_albums


 function get_pictures()
 {//gets the user's pictures
    $conn = db_connect();
    $user_id = $_SESSION['user_id'];

//searches query where the user_id is the session logged in from pictures 
    $sql = "SELECT * FROM pictures WHERE user_id = '$user_id'";
    return mysqli_query($conn, $sql);
 } //end function get_pictures

 function get_url_pic_id()
 {//gets the pic id from the url
 	$s = $_SERVER['QUERY_STRING']; //gets the end of picture  id from the url
    $s = ltrim($s, "picture_id=?"); //cuts the string so it only returns the picture id number

    return $s;
 }//end function get_url_pic_id

 function get_url_album_id()
 {//gets album id from url
    $s = $_SERVER['QUERY_STRING']; //gets the end of picture  id from the url
    $s = ltrim($s, "album_id=?"); //cuts the string so it only returns the picture id number

    return $s;
 }//end function get url album id

 function admin_get_userid()
 {//gets user_id from url
    $s = $_SERVER['QUERY_STRING']; //gets the end of url
    $s = ltrim($s, "user_id=?"); //cuts the string so it only returns the username

    return $s;
 } //end fuction


?>