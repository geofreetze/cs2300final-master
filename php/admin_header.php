<?php
// This file contains the header for the admin interface

if(isset($_SESSION['logged_user'])) {
    $login = 'Logout';
} else { $login = 'Login'; }
echo '<div class="nav">
      <a href="login.php" class="admin-header">'.$login.'</a>
      <a href="manage_accounts.php" class="admin-header">Accounts</a>
      <a href="manage_locations.php" class="admin-header">Locations</a>
      <a href="manage_products.php" class="admin-header">Products</a>
      <a href="manage_media.php" class="admin-header">Media</a>
      </div>';
?>
