<?php
    session_start();
    // if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
    //     header("location: /login");
    // }
    // if ($_SESSION['user_secret'] != '1b1c9df50fb107e510b219734d95099ec467ff2f') {
    //     header("location: /login");
    // }
    // $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <?php include "../../Components/Common/Header.php" ?>

    <body>
        <?php include "../../Components/Reservation/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/Reservation/Navbar.php" ?>
            
            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Room</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt--6">
                <div class="row justify-content-center">
                    <div class=" col ">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <h3 class="mb-0">Add Room</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                                        if (isset($_GET['customer']) && isset($_GET['room']) && isset($_GET['inquiry'])){
                                            $customerid = $_GET['customer'];
                                            $roomno = $_GET['room'];
                                            $inquiryid = $_GET['inquiry'];
                                            if ( is_numeric($customerid) == true){
                                                require_once '../../Models/Database.inc.php';
                                                try{
                                                    $conn = new Database();
                                                    $db = $conn->db();
                                                    
                                                    $customerid = mysqli_real_escape_string($db, $_GET['customer']);
                                                    $roomno = mysqli_real_escape_string($db, $_GET['room']);
                                                    $inquiryid = mysqli_real_escape_string($db, $_GET['inquiry']);

                                                    $query = "SELECT * FROM client WHERE client_ID = '".$customerid."'";

                                                    $result = mysqli_query($db, $query);
                                                    if(mysqli_num_rows($result) > 0)
                                                    {
                                                        //create current date
                                                        $c_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                        $c_date = $c_date->format("Y-m-d");
                                                        //create current time
                                                        $c_time = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                        $c_time = $c_time->format("H:i");
                                                        while($row = mysqli_fetch_array($result)){
                                                            $id = $row['client_ID'];
                                                            $firstname=$row['client_FName'];
                                                            $lastname=$row['client_LName'];
                                                            $email=$row['client_Email'];
                                                            $address = $row['client_Address'];
                                                            $contactno = $row['client_Contact'];
                                                            echo 
                                                                '<div class="col-xl-12 order-xl-1">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <div class="row align-items-center">
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form name="addInquiryForm" action="" method="post"">
                                                                                    <h6 class="heading-small text-muted mb-4">Customer Information</h6>
                                                                                    <div class="pl-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label">Customer ID</label>
                                                                                                    <input name="id" type="text" class="form-control" value="'.$id.'" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-email">Email address</label>
                                                                                                    <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-first-name">First name</label>
                                                                                                    <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-last-name">Last name</label>
                                                                                                    <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr class="my-4" />
                                                                                    
                                                                                    <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                                                                                        <div class="pl-lg-4">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-control-label" for="input-address">Address</label>
                                                                                                        <input name="address" id="input-address" class="form-control" value="'.$address.'" readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row"> 
                                                                                                <div class="col-lg-12">
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-control-label">Mobile</label>
                                                                                                        <input name="contactno" type="text" id="phone" class="phone form-control" value="'.$contactno.'" readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr class="my-4" />
                                                                                        
                                                                                        <h6 class="heading-small text-muted mb-4">Room Information</h6>'?>
                                                                                        <?php
                                                                                            $query1 = "SELECT room.*, hotel.hotel_Name AS hotel, room_type.rt_Type AS room_type FROM room
                                                                                                                INNER JOIN hotel ON room.hotel_Code = hotel.hotel_Code
                                                                                                                INNER JOIN room_type ON room.rt_ID = room_type.rt_ID
                                                                                                                WHERE room_Number = '". $roomno ."'";
                                                                                            $result2 = mysqli_query($db,$query1) or trigger_error("Query Failed! SQL: $query1 - Error: ".mysqli_error($db), E_USER_ERROR);
                                                                                            if(mysqli_num_rows($result2) > 0){
                                                                                                while($row2 = mysqli_fetch_array($result2)){
                                                                                                    $room_id = $row2['room_ID'];
                                                                                                    $room_room_no = $row2['room_Number'];
                                                                                                    $room_hotel = $row2['hotel'];
                                                                                                    $room_type = $row2['room_type'];
                                                                                                    $room_ac = $row2['room_AC'];

                                                                                                    echo '
                                                                                                        <div class="pl-lg-4">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="form-control-label" for="input-room_id">Room ID</label>
                                                                                                                        <input name="room_id" id="input-room_id" class="form-control" value="'.$room_id.'" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-6">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="form-control-label" for="input-room_room_no">Room No.</label>
                                                                                                                        <input name="room_room_no" id="input-room_room_no" class="form-control" value="'.$room_room_no.'" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="row"> 
                                                                                                                <div class="col-lg-6">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="form-control-label">Hotel</label>
                                                                                                                        <input name="hotel" type="text" id="hotel" class="form-control" value="'.$room_hotel.'" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-lg-6">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="form-control-label">Room Type</label>
                                                                                                                        <input name="room_type" type="text" id="room_type" class="form-control" value="'.$room_type.'" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    ';
                                                                                                }
                                                                                            }
                                                                                                            
                                                                                        ?>
                                                                                        <?php
                                                                                            echo'
                                                                                            <div class="col-lg-12">
                                                                                                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ' ;
                                                            $db = null;
                                                        }
                                                    } else {
                                                        echo '<center>Sorry No Customer Found!!</center>';
                                                    }
                                                    $db = null;

                                                } catch (Exception $ex){
                                                    http_response_code(500);
                                                    die('Error establishing connection with database');
                                                }
                                            } else {
                                                http_response_code(400);
                                                die('Error processing bad or malformed request');
                                            }
                                        } else {
                                            echo 'no';
                                        }
                                        
                                        if(isset($_GET['success'])) {
                                            echo'<a href="inquiry.php" type="button" style="color:white" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Inquiry</a>';  
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>
        
        <script>
            $('input[name="adults"]').mask('0000000000');
            $('input[name="child"]').mask('0000000000');
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/src/Lib/js/argon.js?v=1.2.0"></script>
    </body>
</html>

<?php
    if (isset($_POST['submit'])){
        include 'Receptionist.php';

        $receptionist = new Reception(); 
        $customer_id = $customerid;
        $adults = $_POST['adults'];
        $child = $_POST['child'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        if ($adults == "") {
            $adults = 0;
        }
        if ($child == "") {
            $child = 0;
        }

        $rm_type = filter_input(INPUT_POST, 'room_types', FILTER_SANITIZE_STRING);
        $room_type_id = $rm_type;
        $is_ac = $_POST['ac_type'];
        if ($is_ac == "on") {
            $ac_value = 1;
        }else {
            $ac_value = 0;
        }
        $status = 0;
        $receptionist_id = $_SESSION['id'];
        $receptionist->addInquiry($customer_id, $room_type_id, $ac_value, $status, $receptionist_id, $checkin, $checkout, $adults, $child);
    }

    if(isset($_GET['registration']))
    {
        echo'<script>
            swal("Customer Registration Success!", "New Customer Details added!", "success");
        </script>';
    }
    if(isset($_GET['failed']))
    {
        echo'<script>
            swal("Inquiry Adding Failed!", "Something went wrong!", "error");
        </script>'; 
    }
    if(isset($_GET['success']))
    {
        echo'<script>
            swal("Success!", "Inquiry Added Successfully!", "success");
        </script>';
    }
?>