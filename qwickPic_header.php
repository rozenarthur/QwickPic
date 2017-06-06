<?php
    session_start();//starts a session when logged in

    if(!isset($_SESSION['user']) && !isset($_SESSION['admin']))
    {// if the session variable does not have a user_id then user did not log in
        header('location: index.php'); //redirect user to log in
    }
 ?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title>QwickPic</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="qwickPic.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
    </script>
    <script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
    <script src = "qwickPic_jsFunctions.js" type= "text/javascript">
    </script>
  </head>
  <body>
    
<?php
      require_once("qwickPic_functionShortcuts.php");
      display_sidebar(); //displays sidebar for particular user
?>

      <article>
          <h1>QwickPic</h1>
          <div class = "logo">
          <a href = "qwickPic_home.php"><img src = "Textbox_icons/logo.png"></a>
        </div>
    <div class = "header_div">

<?php
      
      display_navbar(); //displays nav bar for the particular user
?>