<?php
// CREDIT FOR DB INTERACTION AND TABLE STYLING VINCY OF phppot.com::
// http://phppot.com/php/php-mysql-inline-editing-using-jquery-ajax/
require_once("dbcontroller.php");
$db_handle = new DBController();
// Edit Table FROM
$sql = "SELECT * FROM `Locations`";
$result = $db_handle->runQuery($sql);
?>
<html>
    <head>
      <title>This is a Test</title>
		<style>
			body{width:610px;}
			.current-row{background-color:#B24926;color:#FFF;}
			.current-col{background-color:#1b1b1b;color:#FFF;}
			.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
			.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
			.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
		</style>
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		}

		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(../img/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit_locations.php",
				type: "POST",
        //edit post variables below for specific table
				data:'column='+column+'&editval='+editableObj.innerHTML+'&location_id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}
		   });
		}
		</script>
    </head>
    <body>
	   <table class="tbl-qa">
		  <thead>
			  <tr>
          <!-- edit table headers for specific table -->
				<th class="table-header">Type</th>
				<th class="table-header">Name</th>
        <th class="table-header">Street</th>
				<th class="table-header">City</th>
        <th class="table-header">State</th>
				<th class="table-header">Country</th>
        <th class="table-header">Latitude</th>
				<th class="table-header">Longitude</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
      if($result){
  		  foreach($result as $k=>$v) {
  		  ?>
  			  <tr class="table-row">
  				<!--<td><?php //echo $k+1; ?></td>-->
          <!-- edit post variables below for specific table -->
  				<td contenteditable="true" onBlur="saveToDatabase(this,'type','<?php echo $result[$k]["location_id"]; ?>')" onClick="showEdit(this);"><?php echo $result[$k]["type"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'name','<?php echo $result[$k]["location_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["name"]; ?></td>
          <td contenteditable="true" onBlur="saveToDatabase(this,'street','<?php echo $result[$k]["location_id"]; ?>')" onClick="showEdit(this);"><?php echo $result[$k]["street"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'city','<?php echo $result[$k]["location_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["city"]; ?></td>
          <td contenteditable="true" onBlur="saveToDatabase(this,'state_province','<?php echo $result[$k]["location_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["state_province"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'country','<?php echo $result[$k]["location_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["country"]; ?></td>
          <td contenteditable="true" onBlur="saveToDatabase(this,'coord_lat','<?php echo $result[$k]["location_id"]; ?>')" onClick="showEdit(this);"><?php echo $result[$k]["coord_lat"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'coord_long','<?php echo $result[$k]["location_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["coord_long"]; ?></td>
  			  </tr>
  		<?php
  		}
  	}?>
		  </tbody>
		</table>
    </body>
</html>
