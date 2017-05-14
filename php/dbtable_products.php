<?php
// CREDIT FOR DB INTERACTION AND TABLE STYLING VINCY OF phppot.com::
// http://phppot.com/php/php-mysql-inline-editing-using-jquery-ajax/
require_once("dbcontroller.php");
$db_handle = new DBController();
// Edit Table FROM
$sql = "SELECT * FROM `Products`";
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
				url: "saveedit_products.php",
				type: "POST",
        //edit post variables below for specific table
				data:'column='+column+'&editval='+editableObj.innerHTML+'&product_id='+id,
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
				<th class="table-header">Name</th>
				<th class="table-header">Description</th>
        <th class="table-header">Image</th>
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
  				<td contenteditable="true" onBlur="saveToDatabase(this,'name','<?php echo $result[$k]["product_id"]; ?>')" onClick="showEdit(this);"><?php echo $result[$k]["name"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'description','<?php echo $result[$k]["product_id"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["description"]; ?></td>
          <td contenteditable="true" onBlur="saveToDatabase(this,'image_url','<?php echo $result[$k]["product_id"];?>"
              <form class='manage_form' method='post' enctype='multipart/form-data'>
              <input type='file' name='mod_image'><?php echo $result[$k]["image_url"]; ?> </form>
          </td>
  			  </tr>
  		<?php
  		}
  	}?>
		  </tbody>
		</table>
    </body>
</html>
