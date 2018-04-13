<?php

if(isset($_POST['submit'])){
	
	include_once 'dbh-bg.php';
	
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	
	//Error Handlers
	//Check for empty fields
	if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pass)){
		header("Location: ../signup.php?signup=empty");
		exit();
	} else {
		//Check if input chars are valid
		if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
			header("Location: ../signup.php?signup=invalid");
			exit();
		} else {
			//Check if email is valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../signup.php?signup=email");
				exit();
			} else {
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck > 0){
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} else {
					//Hash password
					$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
					//Insert user to database
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pass) 
					VALUES ('$first', '$last', '$email', '$uid', '$hashedPass');";
					mysqli_query($conn, $sql);
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	}
}

else {
	header("Location: ../signup.php");
	exit();
}