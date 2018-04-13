<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<?php
		if(isset($_SESSION['user_id'])) {
			if($_SESSION['user_uid'] == 'admin'){
				include_once 'background/dbh-bg.php';
				$sql = 'SELECT * FROM shipments;';
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if(!$resultCheck) {
					echo'There are no shipments to show at the moment';
				} else {
					echo '
						<h2>Edit Shipments</h2>
						<table>
						<tr>
							<th>ID</th>
							<th>Vessel</th>
							<th>Container(s)</th>
							<th>Origin</th>
							<th>Destination</th>
							<th>Departure</th>
							<th>Arrival</th>
						</tr>';
						
					while ($row = mysqli_fetch_assoc($result)){
						echo '
							
							<form class="shipment-form" action="background/editshipment-bg.php" method="POST">
								<tr>
									<th><input type="text" name="ship_id" value="'.$row['ship_id'].'" readonly></th>
									<th><input type="text" name="ship_vessel" value="'.$row['ship_vessel'].'"></th>
									<th><input type="text" name="ship_amount" value="'.$row['ship_amount'].'"></th>
									<th><input type="text" name="ship_origin" value="'.$row['ship_origin'].'"></th>
									<th><input type="text" name="ship_destination" value="'.$row['ship_destination'].'"></th>
									<th><input type="text" name="ship_departure" value="'.$row['ship_departure'].'"></th>
									<th><input type="text" name="ship_arrival" value="'.$row['ship_arrival'].'"></th>
									<th><button type="submit" name="submit">Submit Edit</button></th><br/>
								</tr>
							</from>';
					}
					
					echo '</table>';
				}
			} else {
				header('Location: index.php?hello');
			}

		} else {
			header('Location: index.php?hello');
		}
		?>
	</div>
</section>

<?php
	include_once 'footer.php'
?>

