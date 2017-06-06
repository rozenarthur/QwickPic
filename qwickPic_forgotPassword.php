<?php
    require_once("qwickPic_loginHeader.php");
    require_once("qwickPic_functionShortcuts.php");

    if(isset($_POST['email']))
    {//checks if email textbox was filled in

    //gets the text from the entered email textbox from the form
      $email = $_POST['email'];
      email_password($email);
    }//end if
?>

    <form method = "POST" action="qwickPic_forgotPassword.php">
        <input type = "email" class = "email_pic" autocomplete =  "off" name = "email" required="required" placeholder="Enter E-mail" title = "Make sure to include '@' and '.com', '.net', etc." autofocus>
        <button type = "submit" focus>Submit</button><br><br>
    </form>

<?php
        require_once("qwickPic_loginFooter.php");
?>
