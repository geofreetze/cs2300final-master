<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$column = $_POST['column'];
$editval = $_POST['editval'];
// edit id
$id = $_POST['product_id'];
// edit table and id
$sql = "UPDATE `Products` SET `$column` = '$editval' WHERE `product_id`='$id'";
$result = $db_handle->executeUpdate($sql);
return $result;
?>
