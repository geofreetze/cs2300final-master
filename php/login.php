<!-- /* login.php is the admin login page for Over the Wall Whiskey accessed through
   the following link: */ -->

<?php session_start(); ?>
<!DOCTYPE html>
<html>
 <head>
     <link href="../css/stylesheet.css" type="text/css" rel="stylesheet">
     <title>Over The Wall | Login </title>
 </head>
 <body>
     <div class = "container-fluid content">
        <?php include 'admin_header.php' ?>
          <?php
                if(!isset($_SESSION['logged_user'])) {
                    echo "
                    <form method='post'>
                        <h2>Login</h2>
                        Username: <input type='text' required name='username'>
                        Password: <input type='password' required name='password'>
                        <input type='submit' name='login' value='Login'>
                    </form>
                    ";
                }
                else {
                    echo "
                    <form method='post'>
                        <h2>Logout</h2>
                        <input type='submit' name='logout' value='Logout'>
                    </form>
                    ";
                }
             ?>

             <?php
                 require_once '../config.php';
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            (isset($_POST['username'])) ? $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING ) : $username = "";
                (isset($_POST['password'])) ? $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING ) : $password = "";
                (isset($_POST['login'])) ? $login = htmlentities($_POST['login']) : $login = "";

              if(isset($_POST['login']) && $login == "Login") {
                $sql = "SELECT * FROM Users WHERE username = '$username'";
                    $result = $mysqli->query($sql);
                    if($result && $result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $password_hash = $row['password'];
                        if(password_verify($password, $password_hash)) {
                            //right credentials
                            $_SESSION['logged_user'] = $username;
                            header("Refresh:0");
                        }
                        else {
                            //wrong credentials
                            echo "<p>You entered an incorrect username or password.</p>";
                        }
                    }
                    else {
                        //too many or no results
                        echo "<p>You entered an incorrect username or password.</p>";
                    }
                }

             //Logout form
                (isset($_POST['logout'])) ? $logout = htmlentities($_POST['logout']) : $logout = "";

                if(isset($_POST['logout']) && $logout == "Logout"){
                    session_destroy();
                    echo "<p>You have logged out.</p>";
                    header("Refresh:0");
                }

                if(isset($_SESSION['logged_user'])) {
                    $username = $_SESSION['logged_user'];
                    echo "<p>Hello $username!  You have successfully logged in.</p>";
                }
                else {
                    echo "<p>Enter username and password.</p>";
                }

                //close connection
                $mysqli->close();

             ?>
     </div>
   <!-- header file -->
 </body>

</html>
