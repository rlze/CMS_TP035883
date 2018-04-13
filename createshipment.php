<?php
	include_once 'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<?php
		if (isset($_SESSION['user_id'])) {	
				echo '
				<h2>Create a Shipment</h2>
				<table>
				<tr>
				<form class="shipment-form" action="background/createshipment-bg.php" method="POST">
					<th><input  type="text" name="vessel" placeholder="Vessel Name"></th>
					<th><input  type="text" name="amount" placeholder="Number of container(s)"></th>
					<th><input  type="text" name="origin" placeholder="Origin"></th>
					<th><input  type="text" name="destination" placeholder="Destination"></th>
					<th><input  type="text" name="departure" placeholder="Departure Date"></th>
					<th><input  type="text" name="arrival" placeholder="Arrival Date"></th>
					<th><button type="submit" name="submit">Create Shipment</button></th>
				</form>
				</tr>
				</table>';
		}
		else {
			header('Location: index.php');
		}
		?>
	</div>
</section>

<?php
	include_once 'footer.php'
?>
