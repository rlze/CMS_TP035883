<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
	<nav>
		<div class="main-wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
				<?php
					if(isset($_SESSION['user_id'])){
						if($_SESSION['user_uid'] == 'admin')
						echo '
							<li>
								<a href="createshipment.php">Create a Shipment</a>
								<a href="viewshipments.php">View Shipments</a>
								<a href="editshipment.php">Edit Shipments</a>
								<a href="deleteshipment.php">Delete Shipment</a>
							</li>
							';
							
					}
				?>
			</ul>
			<div class="nav-login">
				<?php
					if(isset($_SESSION['user_id'])){
						echo '
							<form action="background/logout-bg.php" method="POST">
								<button type="submit" name="submit">Logout</button>
							</form>';
					} else {
						echo '
							<form action="background/login-bg.php" method="POST">
								<input type="text" name="uid" placeholder="Username/Email">
								<input type="password" name="pass" placeholder="Password">
								<button type="submit" name="submit">Login</button>
							</form>
							<a href="signup.php">Sign up</a>';
					}
				?>
			</div>
		</div>
	</nav>	
</header>