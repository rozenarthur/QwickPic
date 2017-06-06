<?php
    require_once("qwickPic_loginHeader.php");
    require_once("qwickPic_functionShortcuts.php");

    if (isset($_POST["username"]) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['firstName']) && isset($_POST['lastName']))
    {//checks if every textbox was entered

    //gets text entered from each textbox
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 5]); //encrypts the given password by hashing
      $email = $_POST['email'];
      $first = $_POST['firstName'];
      $last = $_POST['lastName'];

      register($username, $password, $email, $first, $last); //calls the register function from qwickPic_login_functions
    }//end of if(isset)
 ?>

     <form method = "post" action = "qwickPic_createAccount.php">
          <h2>Create Account:</h2>
         <input class = "username_pic" type = "text" autocomplete =  "off" pattern ="[a-z]{5,20}" name = "username" required="required" placeholder="Enter Username" title = "Username should consist of all lower case letters, have no numbers, and must be 5-20 characters" autofocus><br><br>
         <input class = "password_pic" type = "password" autocomplete =  "off" name = "password" pattern = "[a-zA-Z0-9]{8,30}" title = "Password can consist of only letters and numbers and must be 8-30 characters" required="required" placeholder="Enter Password"><br><br>
         <input class = "email_pic" type = "email" name = "email" autocomplete =  "off" required="required" placeholder="Enter E-mail" title = "Make sure to include '@' and '.com', '.net', etc."><br><br>
         <input class = "name_pic" type = "text" autocomplete =  "off" pattern="[a-zA-Z]{1, 50}" name = "firstName" required="required" placeholder="Enter First Name" title = "Enter only lower and uppercase letters"><br><br>
         <input class = "name_pic" type = "text" autocomplete =  "off" pattern="[a-zA-Z]{1, 50}" name = "lastName" required="required" placeholder="Enter Last Name" title = "Enter only lower and uppercase letters"><br><br>
         <button type = "submit" focus>Create Account</button><br><br>

</body>
</html>
