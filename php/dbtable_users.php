<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from `Users`";
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
        //edit the url to respective saveeddit
				url: "saveedit_users.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&username='+id,
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
				<th class="table-header">User</th>
				<th class="table-header">Permission</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
      if($result){
  		  foreach($result as $k=>$v) {
  		  ?>
  			  <tr class="table-row">
  				<!--<td><?php //echo $k+1; ?></td>-->
  				<td contenteditable="true" onBlur="saveToDatabase(this,'username','<?php echo $result[$k]["username"]; ?>')" onClick="showEdit(this);"><?php echo $result[$k]["username"]; ?></td>
  				<td contenteditable="true" onBlur="saveToDatabase(this,'permission','<?php echo $result[$k]["username"] ?>')" onClick="showEdit(this);"><?php echo $result[$k]["permission"]; ?></td>
  			  </tr>
  		<?php
  		}
    }
		?>
		  </tbody>
		</table>
    </body>
</html>
