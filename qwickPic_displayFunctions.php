<?php

 function html_url($url, $title) 
 {//creates a url link to access another page

        return '<a href='.$url.'?'.$title. '>';
} //end function html_url


 function display_navbar()
 {//displays the navigation bar for users and for admins
        if(isset($_SESSION['admin']))
        { //if admin is logged in display this nav bar
            echo "<div id = 'nav_table'>
                    <ul>
                        <li><form method = 'GET' action = 'qwickPic_search.php'><input type = 'search' name = 'search' class = 'search_pic' placeholder = 'Search users' autocomplete = 'off'></form></li>

                        <a href = 'qwickPic_createAdmin.php'><li>
                        <button type = 'submit'>Create Admin</button></li></a>
                        <li><div id = 'sidebar_btn'>
                                <span></span>
                                <span></span>
                                <span></span>
                        </li></ul>
                  </div>";
        } //end if

        else
        {//otherwise display user's nav bar
          echo "<div id = 'nav_table'><ul>
                <li><form method = 'GET' action = 'qwickPic_search.php'><input type = 'search' name = 'search' class = 'search_pic' placeholder = 'Search your albums' autocomplete = 'off'></form></li>
                <a href = 'qwickPic_upload.php'><li>
                        <button type = 'submit'>Upload</button></li></a>
                        <a href = 'qwickPic_pictures.php'><li><button type = 'submit'>My Pictures</button></li></a>
                        <li>
                            <div id = 'sidebar_btn'>
                                <span></span>
                                <span></span>
                                <span></span>
                        </li></button>
                </ul></div>";
        }//end else

 } //end function display nav bar


 function display_sidebar()
 {//displays the side bar for users and admins

    if(isset($_SESSION['admin']))
    {//if admin is logged in display this side bar
            echo  '<div id = "sidebar">
                        <ul>
                            <li><a href = "qwickPic_home.php" id = "profile">My Profile</a></li>
                            <li><a href = "qwickPic_changePassword_form.php" id = "change_pass">Change Password</a></li>
                            <li><a href = "qwickPic_createAdmin.php" id = "create_admin">Create Admin</a></li>
                            <li><a href = "qwickPic_logout.php" id = "logout">Log Out</a></li>
                        </ul>
                        <br><button id = "close">Close</button></div>';
    }//end if

    else
    {//if user is logged in display this sidebar
        echo '<div id = "sidebar">
                        <ul>
                            <li><a href = "qwickPic_home.php" id = "profile">My Profile</a></li>
                            <li><a href = "qwickPic_changePassword_form.php" id = "change_pass">Change Password</a></li>
                            <li><a href = "qwickPic_pictures.php" id = "picture">My Pictures</a></li>
                            <li><a href = "qwickPic_upload.php" id = "upload">Upload</a></li>
                            <li><a href = "qwickPic_album.php" id = "album">Create an Album</a></li>
                            <li><a href = "qwickPic_logout.php" id = "logout">Log Out</a></li>
                        </ul>
                        <br><button  id = "close">Close</button></div>';
    }//end else

 } //end function display side bar

 function display_homepage()
 {
    if(isset($_SESSION['admin']))
    {//displays home page for admin
        echo "<h2>Welcome, " .$_SESSION['admin_firstName']. " " .$_SESSION['admin_lastName'] ."</h2><br>
        <img src = 'Textbox_icons/admin.png'></img><br>
        <p>As a qwickPic admin your goal is to make sure that no users upload any inapropriate pictures. If you think a
        user has uploaded an innapropriate picture you can type in their name in the search bar and results will show all that user's
        pictures which you can delete accordingly. Admins can also create other admin accounts if instructed to do so.</p>";
    }//end if

    else
    {//displays the homepage for user

        echo "<h2>Welcome, " .$_SESSION['first_Name']. " " .$_SESSION['last_Name'] ."</h2><br>
        <img src = 'Textbox_icons/user.png'></img><br>
        <p>As a qwickPic user you can upload your photos and save them accordingly.
        You can also create albums to sort all your photos. You can search your albums if 
        you forget their names. What are you waiting for? Start uploading photos now!</p>";
    }//end else
 }//end function display_homepage


function display_dropdown()
{//displays a dropdown of all the user's albums

    $result = get_albums();//gets all albums from query that matches user's id
    $drop = "<select name = 'drop' id = 'drop' title = 'Select an album' required>
     <option disabled selected value> -- Select an Album -- </option>";//drop down string

    while($row = mysqli_fetch_assoc($result))// adds all queried albums into an array
    {//goes through all albums of the array and adds them to a drop down

        $drop .= "<option value = '".$row['album_name']. "'>" .$row['album_name']."</option>";
    }//end while loop

//concatentates the end of the drop down tag
    $drop .= "</select>";
    echo $drop;
}//end function display_dropdown()


function display_pictures()
{//displays  pictures from the particular user's account
    
    $result = get_pictures(); //gets pictures from the query that matches the user's id
    $img = "<span id = 'your_img'>";
    
    while($row = mysqli_fetch_assoc($result))
    {//goes through all queried pictures and displays them
        $url = "qwickPic_profile.php?picture_id=";
        $title = $row['picture_id'];
        $s = html_url($url, $title);

        $img .= "<span id = 'my_pictures'>".$s."<img src = '" .$row['source']."' title = '".$row['caption']."'></a></img></span>";
    }

    $img.= "</span><span id = 'your_img2'></span>";
    echo $img;
}//end function display pictures

function display_albums()
{//gets album from based on the album id from url
    $conn = db_connect();
    $result = get_url_album_id();
    $img = "<span id = 'your_img'>";

    $sql = "SELECT * FROM pictures where album_id = '$result'";
    $result2 = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result2) < 1)
     { //if user has no photos
        echo "<h2>This User has No Photos in this Album</h2>";
     }//end if

     else
     {// if user has pictures
         while($row = mysqli_fetch_assoc($result2))
         {//goes through all queried pictures and displays them
            $url = "qwickPic_profile.php?picture_id=";
            $title = $row['picture_id'];
            $s = html_url($url, $title);

            $img .= "<span id = 'my_pictures'>".$s."<img src = '" .$row['source']."' title = '".$row['caption']."'></a></img></span>";
         }
         $img .= "</span>";
         echo $img;
    }// end else
}//end function display album


function admin_display_pictures()
{ //displays a user's photos for the admin based on the username they typed in
     $conn = db_connect(); 
     $img = "<span id = 'your_img'>";
     $user_id = admin_get_userid(); //gets the url user_id

//sql string to get the username data using the username we got from url
     $sql = "SELECT * FROM pictures WHERE user_id = '$user_id'";
     $result = mysqli_query($conn, $sql);

     if(mysqli_num_rows($result) <= 1)
     { //if user has no photos
        echo "<h2>This User has No Photos</h2>";
     }//end if

     else
     {// if user has pictures

         while($row = mysqli_fetch_assoc($result))
         {//goes through all queried pictures and displays them

            $url = 'qwickPic_admin_disp_prof.php?picture_id=';
            $title = $row['picture_id'];
            $s = html_url($url, $title);

            $img .= "<span id = 'my_pictures'>".$s."<img src = '" .$row['source']."' title = '".$row['caption']."'></a></img></span>";
         }//end while

         $img.= "</span>";
        echo $img;
     }//end else
} //end function admin_display_pictures 


function display_pic_profile()
{ //displays a different profile page for each image clicked on
    $conn = db_connect();    

    $s = get_url_pic_id(); //calls function to get the picture id from url
    $sql = "SELECT * FROM pictures WHERE picture_id = '$s'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    echo "<h2>".$row['caption']."</h2><br>";
    echo "<div><img src ='". $row['source']. "' id = 'pic_profile'></img></div>";
}//end function display_pic_profile


function search($txt)
{//searches the database for what is typed in
    $conn = db_connect();

    if(isset($_SESSION['admin']))
    {//if admin searches

        //GETS all users that are similiar to text entered
        $sql = "SELECT * from accounts WHERE username LIKE '%$txt%'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >= 1)
        {//if some search results were found
            $num = mysqli_num_rows($result);//number of results
            echo "<h2>Results Found: " .$num. "</h2>";

            while($row = mysqli_fetch_assoc($result))
            {//print all usernames found
                $url2 = 'qwickPic_admin_disp_pic.php?user_id=';
                $title2 = $row['user_id'];
                $s2 = html_url($url2, $title2);

                echo $s2."<h3>".$row['username']."</h3></a><hr>";
            }//end while     
        }//end inner if

        else
        {//if no search results found
            echo "<h2>No Results Found</h2>";
        }//end inner else
    }//end if

    else
    { //user searches
        $user_id = $_SESSION['user_id'];

//gets all the user's albums where the text entered is similiar to album_name
        $sql2 = "SELECT * FROM album 
        WHERE user_id = '$user_id' AND album_name LIKE '%$txt%'";

        $result2 = mysqli_query($conn, $sql2);

        if(mysqli_num_rows($result2) >= 1)
        {//if some search results were found

            $num = mysqli_num_rows($result2);//number of results
            echo "<h2>Results Found: " .$num. "</h2>";

            while($row = mysqli_fetch_assoc($result2))
            {//print all albums with their cover photos
                $url3 = 'qwickPic_displayAlbum.php?album_id=';
                $title3 = $row['album_id'];
                $s3 = html_url($url3, $title3);

                echo $s3."<h3>".$row['album_name']."</h3>
                <img src = '".$row['cover_photo']."'></a><hr>";
            }//end while

        }//end if

        else
        {//if no search results found
            echo "<h2>No Results Found</h2>";
        }//end inner else

    }//end else

}//end function search


function sort_album($name)
{//displays all pictures within the the album name
    $conn = db_connect();
// gets the album id of the parameter album name
    $sql2 = "SELECT * FROM  album WHERE album_name = '$name'";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $album_id = $row['album_id'];

//gets all the photos that belong to that album
    $sql = "SELECT * FROM pictures WHERE album_id = '$album_id'";
    $result = mysqli_query($conn, $sql);
    $img = "";

     if(mysqli_num_rows($result) < 1)
     { //if user has no photos
        echo "<h2>This album has No Photos</h2>";
     }//end if

     else
     {// if user has pictures

         while($row = mysqli_fetch_assoc($result))
         {//goes through all queried pictures and displays them

            $url = 'qwickPic_profile.php?picture_id=';
            $title = $row['picture_id'];
            $s = html_url($url, $title);

            $img .= "<span id = 'my_pictures'>".$s."<img src = '" .$row['source']."' title = '".$row['caption']."'></a></img></span>";
         }//end while
       
        echo $img;
     }//end else

}// end function sort album

?>
