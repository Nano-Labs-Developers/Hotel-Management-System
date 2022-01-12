<?php
include '../../Models/Database.inc.php';
$connect = new Database();
$db = $connect->db();
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($db, $_POST["query"]);
	$query = "
	SELECT customers.*, inquiry.id AS inquiry
    FROM customers
    INNER JOIN inquiry ON customers.id = inquiry.customer_id
	WHERE (`first_name` LIKE '%".$search."%') OR (`last_name` LIKE '%".$search."%') OR (`email` LIKE '%".$search."%') OR (`mobile` LIKE '%".$search."%')
    AND status = 0
	";

	$result = mysqli_query($db, $query) or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error($db), E_USER_ERROR);
    
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '<div class="table-responsive">
						<table class="table table bordered">
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>Mobile</th>
								<th>Action</th>
							</tr>';
		        while($row = mysqli_fetch_array($result))
		        {
			        $customerid = $row["id"];
                    $roomno = isset($_GET['room']) ? $_GET['room'] : "RM001";
                    $inquiryid = $row["inquiry"];
			        $output .= '<tr>
                                    <td>'.$row["id"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["address"].'</td>
                                    <td>'.$row["mobile"].'</td>
					                <td><a href="add_room.php?customer='.$customerid.'&room='.$roomno.'&inquiry='.$inquiryid.'" type="button" style="color:white" class="btn btn-warning btn-sm">ADD ROOM</a></td>
				                </tr>
			                ';
		        }
		        echo $output;
            }
            else
            {
	            echo 'Data Not Found';
            }
    }
?>