<?php

session_start();

if (isset($_POST['submit'])){
	
	include 'dbh-bg.php';
	
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	
	//Error handler
	//Check if inputs are empty
	if(empty($uid) || empty($pass)){
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if($row = mysqli_fetch_assoc($result)){
				//Dehash password
				$hashedPassCheck = password_verify($pass, $row['user_pass']);
				if($hashedPassCheck == false){
					header("Location: ../index.php?login=error");
					exit();
				} elseif($hashedPassCheck == true) {
					//Logs user into system
					$_SESSION['user_id']=$row['user_id'];
					$_SESSION['user_first']=$row['user_first'];
					$_SESSION['user_last']=$row['user_last'];
					$_SESSION['user_email']=$row['user_email'];
					$_SESSION['user_uid']=$row['user_uid'];
					header('Location: ../index.php?login=success');
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=error");
	exit();
}