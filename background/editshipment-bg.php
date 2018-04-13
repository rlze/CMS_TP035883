<?php

if(isset($_POST['submit'])){
	include_once('dbh-bg.php');
	
	$id = mysqli_real_escape_string($conn, $_POST['ship_id']);
	$vessel = mysqli_real_escape_string($conn, $_POST['ship_vessel']);
	$amount = mysqli_real_escape_string($conn, $_POST['ship_amount']);
	$origin = mysqli_real_escape_string($conn, $_POST['ship_origin']);
	$destination = mysqli_real_escape_string($conn, $_POST['ship_destination']);
	$departure = mysqli_real_escape_string($conn, $_POST['ship_departure']);
	$arrival = mysqli_real_escape_string($conn, $_POST['ship_arrival']);
		
	//Error Handlers
	//Check for empty fields
	if(empty($vessel) || empty($amount) || empty($origin) || empty($destination) || empty($departure) || empty($arrival)){
		header("Location: ../editshipment.php?editshipment=empty");
		exit();
	} else {
		//Update shipments database
		$sql = "UPDATE shipments
		SET ship_vessel = '$vessel', ship_amount = '$amount', ship_origin = '$origin', ship_destination = '$destination', ship_departure = '$departure', ship_arrival = '$arrival'
		WHERE ship_id = '$id';";
		mysqli_query($conn, $sql);
		echo $id.$vessel.$amount;
		header("Location: ../editshipment.php?editshipment=success");
	}
} else {
	header("Location: ../editshipment.php");
}