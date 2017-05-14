<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$column = $_POST['column'];
$editval = $_POST['editval'];
$id = $_POST['location_id'];
$sql = "UPDATE `Locations` SET `$column` = '$editval' WHERE `location_id`='$id'";
$result = $db_handle->executeUpdate($sql);
return $result;
?>
