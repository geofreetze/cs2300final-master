<!-- client can modify links to social media -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>
 <head>
   <link href="../css/stylesheet.css" type="text/css" rel="stylesheet">
   <title>Over The Wall | Administration </title>
 </head>
 <body>
   <!-- header file -->
   <?php include 'admin_header.php'; ?>
   <?php
    if (isset($_SESSION['logged_user'])) {
      // user session logged out after 15 minutes
      if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
      // request 15 minutes ago
      session_destroy();
      session_unset();
      }
      $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time``
     // form for editing social media link
     echo "";

    }
    else {
      print("<h1> Please Login To View This Page's Content. </h1>");
    }
   ?>
 </body>
</html>
