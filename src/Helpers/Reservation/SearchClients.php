<?php
	include '../../Models/Database.inc.php';
	$conn = new Database();
	$db = $conn->db();
	$output = '';

	if(isset($_POST["query"])) {
		$search = mysqli_real_escape_string($db, $_POST["query"]);
		$query = "SELECT client.*, inquiry.inq_ID AS inquiry FROM client
						INNER JOIN inquiry ON client.client_ID = inquiry.client_ID
						WHERE (`client_FName` LIKE '%".$search."%') OR (`client_LName` LIKE '%".$search."%') OR (`client_Email` LIKE '%".$search."%') OR (`client_Contact` LIKE '%".$search."%') AND status = 0
		";
		$result = mysqli_query($db, $query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error($db), E_USER_ERROR);
		
		if(mysqli_num_rows($result) > 0) {
			$output .= '
						<div class="table-responsive">
							<table class="table table bordered">
								<tr>
									<th>ID</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Address</th>
									<th>Contact</th>
									<th>Action</th>
								</tr>
			';

			while ($row = mysqli_fetch_array($result)) {
				$clientid = $row["id"];
				$roomno = isset($_GET['room']) ? $_GET['room'] : "RM001";
				$inquiryid = $row["inquiry"];
				$output .= '
							<tr>
								<td>'.$row["client_ID"].'</td>
								<td>'.$row["client_FName"].'</td>
								<td>'.$row["client_LName"].'</td>
								<td>'.$row["client_Email"].'</td>
								<td>'.$row["client_Address"].'</td>
								<td>'.$row["client_Contact"].'</td>
								<td><a href="reservation/addroom?client='.$clientid.'&room='.$roomno.'&inquiry='.$inquiryid.'" type="button" style="color:white" class="btn btn-success btn-sm">ADD ROOM</a></td>
							</tr>
				';
			}
			echo $output;
		}
		else {
			echo 'Data Not Found';
		}
    }
?>