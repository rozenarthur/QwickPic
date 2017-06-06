<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

    if(!isset($_SESSION['user']))
    {//give an error if an admin tries to access this page

    	throw new exception("Admins do not have pictures!");
    }//end if

    if(isset($_POST['delete']) || isset($_POST['recap']) || isset($_POST['cap']) || isset($_POST['move']) || isset($_POST['move']) || isset($_POST['drop']))
    {//if any of the buttons were clicked
    	if(isset($_POST['delete']))
    	{//if delete button was pressed
    		delete_photo();//deletes the photo of the current id
    	}

    	if(isset($_POST['recap']))
    	{
    		echo "<h2>Rename Your Caption</h2><br>
    		<form method = 'POST' action = 'qwickPic_profile.php?".$_SERVER['QUERY_STRING']. "'>
    		<input type = 'text' name = 'cap' class = 'photo2_pic' placeholder = 'Enter a caption' autocomplete = 'off'></input><br>
    		<br><button type = 'submit'>Submit</button";
    	}

    	if(isset($_POST['cap']))
    	{
    		change_caption($_POST['cap']);
    	}

    	if(isset($_POST['move']))
    	{	
    		echo "<h2>Pick an album to move to </h2>
    		<form method = 'POST' action = 'qwickPic_profile.php?".$_SERVER['QUERY_STRING']. "'>";
    		display_dropdown();
    		echo "<br><br><button type = 'submit'>Submit</button></form>";
    	}

    	if(isset($_POST['drop']))
    	{
    		move_albums($_POST['drop']);
    	}

    }//end if

    else
    { //if not buttons were clicked display profile
	    display_pic_profile(); //displays the profile

	    echo "<span>
	    			<form method = 'POST' action = 'qwickPic_profile.php?".$_SERVER['QUERY_STRING']. "'>
	    			<button type = 'submit' id = 'recap' name = 'recap'>Rename Caption</button></form><br>
	    			
	    			<form method = 'POST' action = 'qwickPic_profile.php?".$_SERVER['QUERY_STRING']. "'>
	    			<button type = 'submit' id= 'move' name = 'move'>Move to another Album</button></form>			

	    			<form method = 'POST' action = 'qwickPic_profile.php?".$_SERVER['QUERY_STRING']. "'>
	    				<br><button name = 'delete' id = 'delete' type = 'submit'>Delete Photo</button>
	    	</span>";
    }
?>