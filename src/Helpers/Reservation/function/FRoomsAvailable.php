<?php
    require_once '../../Models/Database.php';
    $conn = new Database();
    $db = $conn->db();
    $output = '';

    if (isset($_POST["hotel"]) && isset($_POST["room_type"])) {
	    $hotel = mysqli_real_escape_string($db, $_POST["hotel"]);
        $room_type = mysqli_real_escape_string($db, $_POST["room_type"]);
	    $query = "SELECT room.*,hotel.name AS hotel,room_types.name AS room_type FROM room
                		INNER JOIN hotel ON room.hotel_code = hotel.code
                    	INNER JOIN room_types ON room.room_type_id = room_types.id WHERE hotel_code = '".$hotel."' AND room_type_id = '".$room_type."' AND status = 1";
	    $result = mysqli_query($db, $query);

	    if (mysqli_num_rows($result) > 0) {
            $output .= '<div class="table-responsive">
						    <table class="table table bordered">
							    <tr>
								    <th>ID</th>
								    <th>Hotel</th>
								    <th>Room No.</th>
								    <th>Room Type</th>
                                    <th>AC</th>
                                    <th>Action</th>
							    </tr>
			';
			
			while($row = mysqli_fetch_array($result)) {
				$roomno = $row["room_no"];
				$AC = $row["is_ac"] == 1 ? 'Yes' : 'No';
				$output .= '
							<tr>
								<td>'.$row["id"].'</td>
								<td>'.$row["hotel"].'</td>
								<td>'.$row["room_no"].'</td>
								<td>'.$row["room_type"].'</td>
								<td>'.$AC.'</td>
								<td><a href="register_room_customer.php?room='.$roomno.'" type="button" style="color:white" class="btn btn-warning btn-sm">REGISTER CUSTOMER</a></td>
							</tr>
				';
			}
			echo $output;
        }
        else {
	        echo 'Room not available for the search!';
        }
    }
?>