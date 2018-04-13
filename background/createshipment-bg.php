<?php

if(isset($_POST['submit'])){
	
	include_once 'dbh-bg.php';
	
	$vessel = mysqli_real_escape_string($conn, $_POST['vessel']);
	$amount = mysqli_real_escape_string($conn, $_POST['amount']);
	$origin = mysqli_real_escape_string($conn, $_POST['origin']);
	$destination = mysqli_real_escape_string($conn, $_POST['destination']);
	$departure = mysqli_real_escape_string($conn, $_POST['departure']);
	$arrival = mysqli_real_escape_string($conn, $_POST['arrival']);
	
	//Check for empty fields
	if(empty($vessel) || empty($amount) || empty($origin) || empty($destination) || empty($departure) || empty($arrival)){
		header("Location: ../createshipment.php?shipment=empty");
		exit();
	} else {
			$sql = "INSERT INTO shipments (ship_vessel, ship_amount, ship_origin, ship_destination, ship_departure, ship_arrival) 
					VALUES ('$vessel', '$amount', '$origin', '$destination', '$departure', '$arrival');";
					mysqli_query($conn, $sql);
					header("Location: ../createshipment.php?shipment=success");
					exit();
			}
}

else {
	header("Location: ../createshipment.php");
	exit();
}
