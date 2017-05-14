<!-- Allows the user to change their password, and if the user is an admin, to
    create a new account for another person, modify permissions, or delete an
    account -->
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

    // connect to database
    require_once '../config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // form for changing password
    echo "";

    // update user password
    $sql_mod_pass = "UPDATE `Users` SET `password`=$password WHERE $username = `username`";
    $result = $mysqli->query($sql_mod_pass);

    // fetch current user's permission
    $user = $_SESSION['logged_user'];
    $sql_pass = "SELECT `permission` FROM `Users` WHERE '$user' = `username`";
    $permission = $mysqli->query($sql_pass);

    if($permission){
      // ADMINS ONLY: form for creating account

      // update database with user addition
      $sql_add = "INSERT INTO `Users`(`username`, `password`) VALUES ($username,$password)";
      $result = $mysqli->query($sql_add);



      include 'dbtable_users.php';



      // ADMINS ONLY: form for deleting account
      echo "";

      //update database with user deletion
      $sql_del = "DELETE FROM `Users` WHERE $username=`username`";
      $result = $mysqli->query($sql_del);
    }
   }
    else {
      print("<h1> Please Login To View This Page's Content. </h1>");
    }
   ?>
 </body>
</html>
