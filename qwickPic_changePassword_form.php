<?php
      require_once("qwickPic_header.php");
      require_once("qwickPic_functionShortcuts.php");

      if(isset($_POST['password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']))
      {//checks if all text fields are entered
          $old_pass = $_POST['password'];
          $new_pass = $_POST['new_password'];
          $confirm = $_POST['confirm_password'];

          change_password($old_pass, $new_pass, $confirm);
      }//end if
 ?>
      <h2>Change your Password: </h2><br><br>
 <form method = "post" action = "qwickPic_changePassword_form.php">
      <input type = "password" class = "password_pic" autocomplete =  "off" name = "password" pattern = "[a-zA-Z0-9]{8,30}" title = "Enter your Old Password" required="required" placeholder="Enter your Old Password" autofocus><br><br><br>
      <input type = "password" class = "password_pic" autocomplete =  "off" name = "new_password" pattern = "[a-zA-Z0-9]{8,30}" title = "Password can consist of only letters and numbers and must be 8-30 characters" required="required" placeholder="Enter your new Password"><br><br><br>
      <input type = "password" class = "password_pic" autocomplete =  "off" name = "confirm_password" pattern = "[a-zA-Z0-9]{8,30}" title = "Please input the same password you typed in the previous field" required="required" placeholder="Confirm new password"><br><br><br>
      <button type = "submit" focus>Submit</button><br><br>
</form>
