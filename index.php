<?php
    require_once("qwickPic_loginHeader.php");
 ?>

        <form method = "post" action = "qwickPic_home.php">
            <input type = "text" autocomplete =  "off" class = "username_pic" pattern ="[a-z]{5,20}" name = "username" required="required" placeholder="Enter Username" 
            title = "Username should consist of all lower case letters, have no numbers, and must be 5-20 characters" ><br><br>
            <input type = "password" autocomplete =  "off" class = "password_pic" name = "password" pattern = "[a-zA-Z0-9]{8,30}" title = "Password can consist of only letters and numbers and must be 8-30 characters"
            required="required" placeholder="Enter Password">
            <br><br>
            <button type = "submit" focus>Log In</button>
            <p><a href = "qwickPic_createAccount.php">Sign Up</a> |
            <a href = "qwickPic_forgotPassword.php">Forgot Password?</a></p><br>
