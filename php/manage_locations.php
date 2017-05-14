<!-- allows client to make modifications to the locations where the product can
     be found, by providing a new list of locations -->
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

    // validates input
    function validate($input, $nil) {
      (isset($_POST[$input])) ? $input = htmlentities($_POST[$input]) : $input = $nil;
      return $input;
      }

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

/****** ADDING LOCATION ******/
       // form for adding location
       echo "
        <form class='manage_form_add' method='post' action='manage_locations.php'>
           <span><strong> Add Location </strong></span>
           <div class='form_fields_add'>
             Name: <input type='text' name='add_name' required><br>
             Type: <input type='text' name='add_type' required><br>
             Street: <input type='text' name='add_street' required><br>
             City: <input type='text' name='add_city' required><br>
             State: <input type='text' name='add_state' required><br>
             Country: <input type='text' name='add_country' required><br>
             Latitude Coordinates: <input type='number' name='add_lat' optional><br>
             Longitude Coordinates: <input type='number' name='add_long' optional><br>
             <br><input type='submit' name='add_submit' value='Add'>
           </div>
        </form> <br>";

        // initialize add variables
        $name =  validate('add_name', "");
        $type =  validate('add_type', "");
        $street =  validate('add_street', "");
        $city =  validate('add_city', "");
        $state =  validate('add_state', "");
        $country =  validate('add_country', "");
        $lat = intval(validate('add_lat', '0'));
        $long = intval(validate('add_long', '0'));

      // if admin submits product addition form
      if(isset($_POST['add_submit'])){
        // update mysql database with product addition
        $sql_add = "INSERT INTO `Locations`(`location_id`,`type`, `name`, `street`, `city`, `state_province`, `country`, `coord_lat`, `coord_long`)
        VALUES (NULL,'$name','$type','$street','$city','$state','$country',$lat,$long)";
        $result = FALSE;
        $result = $mysqli->query($sql_add);
        // refresh product table
        //header("Refresh:0");
        // product added successfully or unsuccessfully
        if(!$result) {
          print('Please submit again.');
        }
      }

/****** EDIT LOCATIONS ******/
  include 'dbtable_locations.php';

/****** REMOVE LOCATIONS ******/
      // gather all product information
      $sql = "SELECT * FROM `Locations`";
      $location_request = $mysqli->query($sql);

      echo " <br>
      <form class='manage_form' method='post'>
       <table id='product_table'>
         <thead>
           <tr>
             <th> Remove Location</th>
           </tr>
         </thead>
         <tbody>";
      //print product names
      while($location = $location_request->fetch_assoc()) {
        $location_name = $location['name'];
        $location_id = $location['location_id'];
        echo "<tr>
        <td><input type='checkbox' name='del_check[]' value='$location_id'></td>
        <td>$location_name</td> </tr>";
      }
      echo "</tbody> </table> <br>
          <div class='form_fields_mod'>
            <input type='submit' name='del_submit' value='Remove'>
          </div>
       </form>";

      //update mysql database with product deletion
      if(isset($_POST['del_submit'])){
        (isset($_POST['del_check'])) ? $del_location = $_POST['del_check'] : $del_location = array();
        foreach ($del_location as $id) {
           // update mysql database with product deletion
          $sql_del = "DELETE FROM `Locations` WHERE $id = `location_id`";
          $result = $mysqli->query($sql_del);
          // refresh product table
          header("Refresh:0");
          if(!$result) {print('Remove unsuccessful.');}
        }
      }
    }

    // user is not logged in
    else {
      print("<h1> Please Login To View This Page's Content. </h1>");
    }
    ?>
  </body>
</html>
