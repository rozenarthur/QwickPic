<?php

    function register($username, $password, $email, $firstName, $lastName)
    {//function for registering user into the database
      $conn = db_connect();//connects to database from qwickPic_dbh.php
      if(isset($_SESSION['admin']))
      {//if an admin is logged in they can create admin accounts
      //sql string which will look if an admin username already exists
          $sql_admin = "SELECT admin_username FROM admin_accounts where admin_username = '$username'";
          $result_admin = mysqli_query($conn, $sql_admin);

          if(mysqli_num_rows($result_admin) >=1)
          { // if at least 1 row is found in query than the username exists
            echo "<script type = 'text/javascript'>
                  alert('The username already exists');
                  </script>";
          }//end inner if

          else
          {// no rows found in query, username doesn't exist in database

            //now we have to search database if the regular user name exists in database
            $sql_src = "SELECT username FROM accounts where username = '$username'";
            $result_src = mysqli_query($conn, $sql_src);

              if (mysqli_num_rows($result_src) >=1)
              {//if user's username exists in database
                  echo "<script type = 'text/javascript'>
                      alert('The username already exists');
                      </script>";
              }//end inner if

              else
              {//if the admin usnerame was not found in user's table

              //insert values entered in textfield into admin accounts table database
              $ins = "INSERT INTO admin_accounts (admin_username, admin_password, admin_firstName, admin_lastName)
              VALUES ('$username', '$password', '$firstName', '$lastName')";

              $ins_result = mysqli_query($conn, $ins);

              echo "<script type = 'text/javascript'>
                    alert('The administrator account has been created!');
                    </script>";
              }//end inner else
          }//end else
      }//end outer if

      else
      {//if an admin is not logged in, then user can create regular

//sql string which will looks if entered username exists in table and returns the username row if found
      $sql1 = "SELECT username FROM accounts WHERE username = '$username'";

      $result = mysqli_query($conn, $sql1); // actual query of the previous sql string

//sql string which will looks if entered username exists in table and returns the username row if found
      $sql_email = "SELECT email FROM accounts WHERE email = '$email'";
      $result_email = mysqli_query($conn, $sql_email);

      if(mysqli_num_rows($result)>=1 || mysqli_num_rows($result_email)>=1 )//checks if the entered username or email was found in database
            { //returns true if it finds a row with the matching username
                if(mysqli_num_rows($result)>=1 )
                {//if entered username was found
                      echo "<script type = 'text/javascript'>
                            alert('The username already exists');
                            </script>";
                }//end inner if

                if(mysqli_num_rows($result_email)>=1)//checks if the entered email was found in database
                { //returns true if it finds a row with the matching email
                        echo "<script type = 'text/javascript'>
                              alert('The emailed entered is already associated with an account!');
                              </script>";
                }//end inner if
              }//end outter if

      else
          {// if username or email was not found in database, we have to search if the admin's username exists
            $sql_p = "SELECT admin_username FROM admin_accounts where admin_username = '$username'";
            $result_p = mysqli_query($conn, $sql_p);

            if(mysqli_num_rows($result_p)>=1)
            {//if admin's username exists
              echo "<script type = 'text/javascript'>
                  alert('The username already exists');
                  </script>";
            }//end if

            else
            {//if admin username does not exist in datebase

              //then insert values into the table
              $sql2 = "INSERT INTO accounts (username, password, email, first_Name, last_name)
              Values ('$username', '$password', '$email', '$firstName', '$lastName')";

              $result2 = mysqli_query($conn, $sql2);

              echo "<script type = 'text/javascript'>
                    alert('The account was successfully created! You will be redirected to the Log In page!');
                    </script>";

              header("Refresh: 0.01; url = index.php"); //refreshes page and goes to the log in page
            }//end else
          } //end inner else
      }//end else
    }//end function register


    function login($username, $password)
    {//function for checking if username and password exists in datbase

        $conn = db_connect();
//selects all rows in accounts if the entered username is found in the accounts table
        $sql = "SELECT * FROM accounts WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
//puts values of all rows found from the entered username into an associative array
        $row = mysqli_fetch_assoc($result);

//gets the encrypted password stored in database from the password row from the username that was found
        $encryted_password = $row['password'];

//decrypts the encrypted_password, if the newly decrpyted password matches the password entered then true, else false
        $decrypted_password = password_verify($password, $encryted_password);

        if($decrypted_password == 0)
        {//occurs if the decrypted password and the password entered do not match (returned false)
          $sql = "SELECT * FROM admin_accounts WHERE admin_username = '$username'";
          $result3 = mysqli_query($conn, $sql);
          $row3 = mysqli_fetch_assoc($result3);

          $en_password = $row3['admin_password']; //gets encrypted password of admin
//compares password entered and admins encrypted password
          $dec_password = password_verify($password, $en_password);

          if($dec_password == 0)
          {//occurs if the decrypted password and the password entered do not match (returned false)

            //sends user back to the log in page with incorrect username or password
            header("location: qwickPic_wrongLogin_page.php");
          }//end if
          else
          {//if result of was found in database of the entered username and password
            $sql_check = "SELECT * FROM admin_accounts WHERE admin_username = '$username' AND admin_password = '$en_password'";
            $result4 = mysqli_query($conn, $sql_check);

            if(!$row4 = mysqli_fetch_assoc($result4))
            { //if no result was found in admin table for username and password
                header("location: qwickPic_wrongLogin_page.php");
            }//end else
            else
            { //if admins username and password is correct
                $_SESSION['admin'] = $row4['admin_username'];//creates  a session variable for username admin
                $_SESSION['admin_firstName'] = $row4['admin_firstName']; //gets admin's first name from database
                $_SESSION['admin_lastName'] = $row4['admin_lastName']; //gets admin's last name from database
            }//end inner else
          }//end inner else
        }//end if

        else
        {//occurs if the decrypted password and entered password match

//sql string which will looks if entered username and password exists in the accounts table
            $sql_check = "SELECT * FROM accounts WHERE username = '$username' AND password = '$encryted_password'";
            $result2 = mysqli_query($conn, $sql_check);

            if(!$row2 = mysqli_fetch_assoc($result2))
            {//if no result was found in database of the entered username and password

                //sends user back to the log in page with incorrect username or password
                header("location: qwickPic_wrongLogin_page.php");
            }//end if
            else
            {//if result of was found in database of the entered username and password
//creates a session variable to so we can reference the username of each user from the database
                $_SESSION['user'] = $row2['username'];//gets users username from table
                $_SESSION['user_id'] = $row2['user_id'];//gets user's id from database
                $_SESSION['first_Name'] = $row2['first_Name']; //gets user's first name from database
                $_SESSION['last_Name'] = $row2['last_Name']; //gets user's last name from database
            } //end inner else
        } //end else
    } //end function login


    function email_password($email)
    { //emails the user to change their password if they forgot it

          $conn = db_connect();

//looks for the email that matches what the user typed into the email textfield
          $sql = "SELECT email FROM accounts WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result)>=1)
          {//if email was found in database (at least one row exists)

              $new_pass = "";
    //sql string of the password that matches with the entered email
              $sql_password = "SELECT password FROM accounts WHERE email = '$email'";
              $result = mysqli_query($conn, $sql);

//concatenates the $msg with the new random password generated from reset_password function
              $new_pass .= reset_password($email);
              send_email($email, $new_pass); //calls the send_email function to actually send email
          }//end if

          else{//if the email was not found in the database (no rows exist)
              echo "<p class = 'wrong'>There is no accounts associated with this email!</p>";
          } //end else
    }//end function email_password


    function reset_password($email)
    {//creates a random password from lowercase, uppercase, and numbers, encrypts ane makes it new password

            $conn = db_connect();

//possible characters of our random password
          $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
//length of the $characters string
          $length = strlen($characters);

          $random_password = ""; //your new random password
          $random_length = rand(8, 20); //random length between of password between 8 and 20 characters

          for($i = 0; $i < $random_length; $i++)
          {//generates a random letter, whatever value random_length is the number of iterations

//generates one  random character every iteration of the loop and concatentaes it with $random_password
                $random_password  .= substr($characters, rand(0, ($length - 1)), 1);
          }//end for

          //the random password is encryted before putting into databse
          $encrypted = password_hash($random_password,PASSWORD_DEFAULT, ['cost' => 5]);
//changes password to the random_password with the associated email
          $sql = "UPDATE accounts SET password = '$encrypted' WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);

          return $random_password;
    }//end function random password


  function send_email($to, $msg)
    {//function to send emails
    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                               // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'supqwickpic@gmail.com';                 // SMTP username
    $mail->Password = 'qwickPic33';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('from@support.qwickPic', 'QwickPic Support');
    $mail->addAddress($to);     // Add a recipient

    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = '"QwickPic Forgotten Password"';
    $mail->Body    = "You have forgotten your password and requested for a temporary password to be sent to this email. Please change your password immediately after login!
                    <br><br>Your password is: <strong>".$msg."</strong>";

    if(!$mail->send())
    {//if the email was not successfully sent
      echo "<script type = 'text/javascript'>
            alert('An Error has occured: The email has not been sent! Please Try Again!');
            </script>";
    }//end if

    else
    {//message was successfully sent
      echo "<script type = 'text/javascript'>
            alert('The account has been emailed!');
            </script>";

      header("Refresh: 0.01; url = index.php"); //redirect to login
    }//end else

    }//end function send_mail


    function change_password($old_pass, $new_pass, $confirm_pass)
    {// allows user and admin to change their passwords
          $conn = db_connect();

          if(isset($_SESSION['user']))
          { //if the session is on the user access user accounts table

// gets the password from THE username
              $s1 = $_SESSION['user'];
              $sql = "SELECT password from accounts WHERE username = '$s1'";
              $result = mysqli_query($conn, $sql);
              $fetch_pass = mysqli_fetch_assoc($result);
              $db_pass = $fetch_pass['password'];

              $check_pass = password_verify($old_pass, $db_pass);

              if($check_pass == 0)
              {//if the old password entered does not match the user's current password
                      echo "<script type = 'text/javascript'>
                            alert('Your current password was entered incorrectly!');
                      </script>";
              }//end if

              else
              {//old password was entered correctly
                if($new_pass === $confirm_pass)
                {//new password and confirm password match
                  $encrypted = password_hash($new_pass,PASSWORD_DEFAULT, ['cost' => 5]); //encryption new password
                  $s = $_SESSION['user'];

                  $sql2 = "UPDATE accounts SET password = '$encrypted' WHERE username = '$s'";
                  $result = mysqli_query($conn, $sql2);

                  echo "<script type = 'text/javascript'>
                        alert('Your Password was successfully changed!');
                        </script>";

                  header("Refresh: 0.01; url = qwickPic_home.php");

                }//end if new_pass == $confirm_pass

              else
              {//confirm password and new password do not match
                  echo "<script type = 'text/javascript'>
                      alert('The new password does not match with confirm password! Please try again!');
                      </script>";
              }//end else
            }//end else old password matches new password
          }//end if isset($_SESSION['user']

          else
            {//if the admin is using the session than access admin table
              $s2 = $_SESSION['admin'];
              $sql2 = "SELECT admin_password from admin_accounts WHERE admin_username = '$s2'";
              $result2 = mysqli_query($conn, $sql2);
              $fetch_pass2 = mysqli_fetch_assoc($result2);
              $db_pass2 = $fetch_pass2['admin_password'];

              $check_pass2 = password_verify($old_pass, $db_pass2);

              if($check_pass2 == 0)
              {//if the old password entered does not match the admin's current password
                      echo "<script type = 'text/javascript'>
                            alert('Your current password was entered incorrectly!');
                            </script>";
              }//end if

              else
              {//if the old password does not match the admin's current password
                  if($new_pass === $confirm_pass)
                  {
                    $encrypted = password_hash($new_pass,PASSWORD_DEFAULT, ['cost' => 5]); //encryption new password
                    $s4 = $_SESSION['admin'];

                    $sql3 = "UPDATE admin_accounts SET admin_password = '$encrypted' WHERE admin_username = '$s4'";
                    $result3 = mysqli_query($conn, $sql3);

                    echo "<script type = 'text/javascript'>
                          alert('Your Password was successfully changed!');
                          </script>";

                    header("Refresh: 0.01; url = qwickPic_home.php");
                    }//end if

                    else
                      {//confirm password and new password do not match
                          echo "<script type = 'text/javascript'>
                                alert('The new password does not match with confirm password! Please try again!');
                                </script>";
                      }//end confirm password and new password do not match else
              }//end old password doen't match current password else
            }//end  admin using session else
    }//end function change_password

?>
