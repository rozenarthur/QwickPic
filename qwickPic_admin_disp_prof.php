<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['admin']))
    { //if user is not an admin
    	throw new exception ('Error: You do not have access to this Page!');
    }//end if

    display_pic_profile();

    if(isset($_POST['delete']))
    {//if delete button was clicked
    	delete_photo();
    }//end if
    
    else
    {//if button was not clicked

		echo "<span>
	    			<form method = 'POST' action = 'qwickPic_admin_disp_prof.php?".$_SERVER['QUERY_STRING']. "'>
	    				<button name = 'delete' id = 'delete' type = 'submit'>Delete Photo</button>
	    				</span>";
	}
 ?>

 
