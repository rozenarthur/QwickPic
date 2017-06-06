<?php
  //connects to Database with credentials
  function db_connect(){
  $conn = mysqli_connect("localhost", "Arthur_Rozenberg", "Chris_Dahdouh", "qwickPic");

  if(!$conn)
  {
      die("Connection Failed: Could not connect to Database!");
  }//end if

  else{
      return $conn;
  } //end else
}//end function db_connect
 ?>
