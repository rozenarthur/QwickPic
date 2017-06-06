<?php
      require_once("qwickPic_header.php");
      require_once("qwickPic_functionShortcuts.php");

      if(!isset($_SESSION['admin']))
      {//if a non admin tries to access this page they will get an error
          throw new Exception('You do not have Access to this page');
      }

      if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName']))
      {//checks if all fields have been filled in
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 5]); //encrypts the given password by hashing
        $first = $_POST['firstName'];
        $last = $_POST['lastName'];

        register($username, $password, "", $first, $last); //calls register function, admins dont have emails
      } //end if
 ?>

 <h2>Create an Admin Account:</h2><br><br>

 <form method = "post" action = "qwickPic_createAdmin.php">
   <input type = "text" pattern ="[a-z]{5,20}" name = "username" class = "username_pic" autocomplete =  "off" required="required" placeholder="Enter Username" title = "Username should consist of all lower case letters, have no numbers, and must be 5-20 characters" autofocus><br><br><br>
   <input type = "password" class = "password_pic" autocomplete =  "off" name = "password" pattern = "[a-zA-Z0-9]{8,30}" title = "Password can consist of only letters and numbers and must be 8-30 characters" required="required" placeholder="Enter Password"><br><br><br>
   <input type = "text" pattern="[a-zA-Z]{1, 50}" class = "name_pic" autocomplete =  "off" name = "firstName" required="required" placeholder="Enter First Name" title = "Enter only lower and uppercase letters"><br><br><br>
   <input type = "text" pattern="[a-zA-Z]{1, 50}" class = "name_pic" autocomplete =  "off" name = "lastName" required="required" placeholder="Enter Last Name" title = "Enter only lower and uppercase letters"><br><br><br><br>
   <button type = "submit" focus>Create Account</button><br><br>
</form>
