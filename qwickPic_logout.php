<?php
    session_start();

    if(isset($_SESSION['user']) || isset($_SESSION['admin']) )
    {//if there is a userername in session variable for username or admin
        require_once("qwickPic_functionShortcuts.php");

        unset($_SESSION['user']);//destroy the session userername
        unset($_SESSION['admin']);//destroy the session admin username
        unset($_SESSION['admin_firstName']); //destroys sessions admins first name
        unset($_SESSION['admin_lastName']); //destroys sessions admins last name
        unset($_SESSION['user_id']); //destroys sessions user id
        unset($_SESSION['first_Name']); //destroys sessions user first name
        unset($_SESSION['last_Name']); //destroys sessions user last name);

        session_destroy();//end the session
    }

    header("location: index.php");//redirect back to login screen
 ?>
