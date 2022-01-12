<?php  
    require_once '../../Models/Database.php';
    $connect = new Database();
    $db = $connect->db();

    if (isset($_POST["action"])) {
        if ($_POST["action"] == "present") { 
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d");
            $query = $db->query("SELECT * FROM employees WHERE id = '".$_POST["id"]."' ");
            $userid = $_POST['hrID'];
            $empid = $_POST['id'];

            if ($query->num_rows == 1){
                $sql = "INSERT INTO `attendance`( `employee`, `date`, `is_present`, `duration`, `updated_by`) 
                VALUES ('$empid', '$current_date', '1', '0', '$userid')";

                if (mysqli_query($db, $sql)) {
                    echo'<script>
                        location.replace("manageAttendance.php?success=true");
                        </script>';
                } else {
                    echo'<script>
                        location.replace("manageAttendance.php?failed=true");
                        </script>';
                }
                mysqli_close($db);
            }
        }

        if ($_POST["action"] == "absent") {  
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d");
            $query = $db->query("SELECT * FROM employees WHERE id = '".$_POST["id"]."' ");
            $userid = $_POST['hrID'];
            $empid = $_POST['id'];

            if ($query->num_rows == 1){
                $sql = "INSERT INTO `attendance`( `employee`, `date`, `is_present`, `duration`, `updated_by`) 
                VALUES ('$empid', '$current_date', '0', '0', '$userid')";

                if (mysqli_query($db, $sql)) {
                    echo'
                        <script>
                            location.replace("manageAttendance.php?success=true");
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                            location.replace("manageAttendance.php?failed=true");
                        </script>
                    ';
                }
                mysqli_close($db);
            }
        }
    }
 ?>