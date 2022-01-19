<?php
	include '../../Models/Database.inc.php';

	$conn = new Database();
	$db = $conn->db();
	$output = '';

	if (isset($_POST["query"])) {
		$search = mysqli_real_escape_string($db, $_POST["query"]);
		$query = "SELECT * FROM client WHERE (`client_ID` LIKE '%". $search ."%')
						OR (`client_FName` LIKE '%". $search ."%')
						OR (`client_LName` LIKE '%". $search ."%')
						OR (`client_Email` LIKE '%". $search ."%')
						OR (`client_Contact` LIKE '%". $search ."%');
		";
		$result = mysqli_query($db, $query);

		if (mysqli_num_rows($result) > 0) {
			$output .= '
				<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Action</th>
						</tr>
			';

			while ($row = mysqli_fetch_array($result)) {
				$customerid = $row["id"];
				$output .= '
					<tr>
						<td>'. $row["client_ID"] .'</td>
						<td>'. $row["client_FName"] .'</td>
						<td>'. $row["client_LName"] .'</td>
						<td>'. $row["client_Email"] .'</td>
						<td>'. $row["client_Address"] .'</td>
						<td>'. $row["client_Contact"] .'</td>
						<td><a href="add_inquiry.php?customer='. $customerid .'" type="button" style="color:white" class="btn btn-warning btn-sm">ADD INQUIRY</a></td>
					</tr>
				';
			}
			echo $output;
		} else {
			echo 'No Data Found';
		}
	}
?>