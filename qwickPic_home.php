<?php
    require_once("qwickPic_header.php");

    if(isset($_POST['username']) && isset($_POST['password']))
    {//checks if username and password have been filled in
        require_once("qwickPic_functionShortcuts.php");

        $username = $_POST['username'];
        $password = $_POST['password'];

//login function with parameters of the entered username and password
        login($username, $password);

  }//end if

  display_homepage(); //displays the proper home page for user or admin

 ?>

<br><a href = "qwickPic_changePassword_form.php">Change Password</a><br><br><br>
<form action = "qwickPic_logout.php">
 <button type = "submit">Log Out</button>
 </form>
