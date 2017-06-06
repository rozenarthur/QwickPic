<?php
	
    if(isset($_POST['drop']))
    {//if a drop down was selected

    	require_once("qwickPic_functionShortcuts.php");
    	sort_album($_POST['drop']);
    }//end if

    else
    { //if drop down was not selected
    	header('location: qwickPic_pictures.php');
    }
?>