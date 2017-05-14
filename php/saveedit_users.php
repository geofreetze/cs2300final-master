<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$column = $_POST['column'];
$editval = $_POST['editval'];
$username = $_POST['username'];
$sql = "UPDATE `Users` SET `$column` = '$editval' WHERE `username`='$username'";
$result = $db_handle->executeUpdate($sql);
return $result;
?>
