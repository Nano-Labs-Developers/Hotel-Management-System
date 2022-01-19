<?php
    include '../../Models/Database.php';

    $conn = new Database();
    $db = $conn->db();

    if (isset($_POST["id"])) { 
        $id = $_POST['id'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $bartender = $_POST['bartenderid'];
        $bar = $_POST['bar'];

        $total = $price * $qty;

        $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
        $current_date = $current_date->format("Y-m-d");

        $list = mysqli_query($db,"SELECT * FROM liquor_items WHERE id = '".$_POST["id"]."'");

        while ($row = mysqli_fetch_assoc($list)) {
            $getQTY = $row['stock'];
            $currentQTY = $getQTY - $qty;
            $sql = "INSERT INTO `bar_income`( `bar_id`, `date`, `income`, `item`, `qty`, `updated_by`) VALUES ('$bar', '$current_date', '$total', '$id', '$qty', '$bartender')";
            
            if (mysqli_query($db, $sql)) {
                $result= mysqli_query($db,"UPDATE liquor_items SET stock='$currentQTY' WHERE id='".$id."'");

                if ($result) {
                    return "sent";
                }
            } 
            else {
                echo'
                    <script>
                        location.replace("soldItems.php?failed=true");
                    </script>
                ';
            }
            mysqli_close($db);
        }
    }
?>