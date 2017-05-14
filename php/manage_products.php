<!-- allows client to modify product offerings as needed, making changes
     to the site database -->
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

/****** ADDING PRODUCT ******/
       // form for adding product
       echo "
        <form class='manage_form_add' method='post' enctype='multipart/form-data'>
           <span><strong> Add Product </strong></span>
           <div class='form_fields_add'>
             Name: <input type='text' name='add_name' required>
             Description: <input type='text' name='add_description' required>
             Image: <input type='file' name='add_image' required>
             <br><input type='submit' name='add_submit' value='Add'>
           </div>
        </form> <br>";

      // initialize add variables
      (isset($_POST['add_name'])) ? $name = htmlentities($_POST['add_name']) : $name = "";
      (isset($_FILES['add_image'])) ? $image_url = $_FILES['add_image'] : $image_url = "";
      (isset($_POST['add_description'])) ? $description = htmlentities($_POST['add_description']) : $description = "";

      // if admin submits product addition form
      if(isset($_POST['add_submit'])){
        // uploads image file
        $image_name = $image_url['name'];
        $image_temp_name = $image_url['tmp_name'];
        move_uploaded_file($image_temp_name, "../img/$image_name");
        // update mysql database with product addition
        $sql_add = "INSERT INTO `Products`(`product_id`, `name`, `description`, `image_url`)
        VALUES (NULL,'$name','$description','$image_name')";
        $result = FALSE;
        $result = $mysqli->query($sql_add);
        // refresh product table
        header("Refresh:0");
        // product added successfully or unsuccessfully
        if(!$result) {
          if(empty($name)) {print('Please give this product a name.');}
          if(empty($description)) {print('Please give this product a description.');}
          else{print('Update unsuccessful.');}
        }
      }

// GET IMAGE FILE UPLOAD WORKING WITH AJAX
/****** EDITING PRODUCT ******/
  include 'dbtable_products.php';

  (isset($_FILES['mod_image'])) ? $mod_image = $_FILES['mod_image'] : $mod_image = '';
  if(!empty($mod_image)){
     $image_name = $mod_image['name'];
     $image_temp_name = $mod_image['tmp_name'];
     move_uploaded_file($image_temp_name, "../img/$image_name");}

  // update mysql database with product modifications
  $sql_mod = "UPDATE `Products` SET `image_url`='$image_name' WHERE `product_id`='$mod_product'";

  $result = FALSE;
  $result = $mysqli->query($sql_mod);

/****** DELETING PRODUCT ******/
      // gather all product information
      $sql = "SELECT * FROM `Products`";
      $product_request = $mysqli->query($sql);

      echo " <br>
      <form class='manage_form' method='post'>
       <table id='product_table'>
         <thead>
           <tr>
             <th> Remove Product</th>
           </tr>
         </thead>
         <tbody>";
      //print product names
      while($product = $product_request->fetch_assoc()) {
        $product_name = $product['name'];
        $product_id = $product['product_id'];
        echo "<tr>
        <td><input type='checkbox' name='del_check[]' value='$product_id'></td>
        <td>$product_name</td> </tr>";
      }
      echo "</tbody> </table> <br>
          <div class='form_fields_mod'>
            <input type='submit' name='del_submit' value='Remove'>
          </div>
       </form>";

      //form for deleting product
      if(isset($_POST['del_submit'])){
        (isset($_POST['del_check'])) ? $del_products = $_POST['del_check'] : $del_products = array();
      foreach ($del_products as $id) {
         // update mysql database with product deletion
        $sql_del = "DELETE FROM `Products` WHERE $id = `product_id`";
        $result = $mysqli->query($sql_del);
        // refresh product table
        header("Refresh:0");
        if(!$result) {print('Remove unsuccessful.');}
      }
    }
  }
      else {
        print("<h1> Please Login To View This Page's Content. </h1>");
      }

   ?>
 </body>
</html>
