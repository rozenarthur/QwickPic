<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//if an admin tries to access this page

    	throw new exception("Admins do not have any pictures");
    }//end if

    display_albums();
?>