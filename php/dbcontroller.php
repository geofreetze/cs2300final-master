<?php
// CREDIT FOR IMPLEMENTATION OF DB QUERY AND FUNCTIONS GOES TO VINCY OF phppot.com::
// http://phppot.com/php/php-mysql-inline-editing-using-jquery-ajax/

class DBController {
	private $host = "localhost";
	private $user = "fp_griesers";
	private $password = "56years";
	private $database = "info230_SP17_fp_griesers";
	private $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}

	function numRows($query) {
		$result = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);
		return $result;
    }
}
?>
