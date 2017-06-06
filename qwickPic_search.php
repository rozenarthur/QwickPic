<?php
	require_once("qwickPic_header.php");
    require_once("qwickPic_functionShortcuts.php");

//uses search function to search the enry typed into the search textfield
    if($_GET['search'] === "")
    {//if search bar has empty string
    	echo "<h2>No Results Found for: ".$_GET['search']. "</h2>";
    }//end if

    else if(isset($_GET['search']))
    {//if something was typed into search bar
    	
    	search($_GET['search']);//calls function to search the entered value
    }//end if



?>