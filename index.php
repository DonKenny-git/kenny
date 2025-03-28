<!DOCTYPE html>
<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="reset_stylesheet.css">
    <link rel="stylesheet" href="styleko/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>GSweet.</title> 
</head>
<body>
    <div>
      <?php
       include "header.php"; 
       include "./sidebar.php";      
      ?>
    </div>
    
    <div class="content">
       <?php   
            if (isset ($_GET['page'])){
                $pg = $_GET['page'];
                if ($pg == "movie1") {
                    include "pg1.php";
                }
                elseif ($pg == "movie2"){
                    include "pg2.php";
                }
                elseif ($pg == "movie3"){
                    include "pg3.php";
                }
                elseif ($pg == "home"){
                    include "home.php";
                }
                elseif ($pg == "about"){
                    include "about.php";
                }
                elseif ($pg == "watch"){
                    include "watch_movie.php";
                }
                elseif ($pg == "login"){
                    include "login.php";
                }
                elseif ($pg == "signup"){
                    include "signup.php";
                }
                elseif ($pg == "user"){
                    include "display.php";
                }
                elseif ($pg == "find"){
                    include "find.php";
                }
                elseif ($pg == "profile"){
                    include "profile.php";
                }
                elseif ($pg == "admin"){
                    include "admin_manager.php";
                }
                elseif ($pg == "am1"){
                    include "admin_panel_movie1.php";
                }
                elseif ($pg == "am2"){
                    include "admin_panel_movie2.php";
                }
                elseif ($pg == "am3"){
                    include "admin_panel_movie3.php";
                }
                elseif ($pg == "logout") {
                    session_destroy();
                    $_SESSION["logged_in"] = 'no'; // Adjust based on your logic
                    header("Location: index.php?page=login");
                    exit(); // Ensure no further code is executed after the redirect
                }
            } else {
                include "home.php";
            }
       ?>
    </div>

    <div class="footer">
        <?php include "footer.php"; ?>
    </div>
</body>
</html>
