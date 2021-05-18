<?php 
	require_once "account.php";
	// Create connection
	// echo $root ."-";
	
	$username = $_SESSION['username'];
	echo $username;
	$conn = new mysqli(HOST, USER, PASS, "userInfo");
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// sql to delete a record
	$sql = "DELETE FROM $username WHERE filePath =  '$deletelink' ";

	if ($conn->query($sql) === TRUE) {
	  // echo "Record deleted successfully";
	  // echo $deletelink;
	  
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

	$conn->close();


?>