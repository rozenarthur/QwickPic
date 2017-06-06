<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['admin']))
    { //if user is not an admin
    	throw new exception ('Error: You do not have access to this Page!');
    }//end if

    admin_display_pictures(); //displays the all the user's photos
?>