<?php
session_start();//starts a session when logged in

if(isset($_SESSION['user']) || isset($_SESSION['admin']))
{// if the session variable has a user_id then user is logged in
    header('location: qwickPic_home.php'); //redirect user to logged in home page
}
 ?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>QwickPic</title>
    <link rel="stylesheet" type="text/css" href="qwickPic.css"/>
  </head>
  <body>
    <article id = "article_login">
      <h1>QwickPic</h1>
      <div class = "logo_login">
        <a href = "index.php"><img src = "Textbox_icons/logo.png"></a>
      </div>
    <div class = "login">
