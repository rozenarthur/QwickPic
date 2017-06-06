<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//if an admin tries to access this page

    	throw new exception("Admins do not have any pictures");
    }//end if

    $result = get_albums();

    if(!$s = mysqli_fetch_assoc($result))
    {//if user has no albums
    	echo "<h2> Your do not have any albums!</h2>";
    }//end if

    else
    {//if user has at least 1 album 
    	echo "<h2> Your Pictures</h2>";
    	display_dropdown();
    	echo "<br><br>";
    	display_pictures();
    }//end else
    
    
?>