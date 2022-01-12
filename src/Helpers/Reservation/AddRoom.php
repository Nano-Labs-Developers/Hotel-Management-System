<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 3) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>
    
    <?php include "../dashboard_header.php" ?>
    <body>
        
        <?php include "side_navbar.php" ?>
        
        <div class="main-content" id="panel">
            
            <?php include "top_navbar.php" ?>
            
            
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
                                                    $connect = new Database();
                                                    $db = $connect->db();
                                                    
                                                    $customerid = mysqli_real_escape_string($db, $_GET['customer']);
                                                    $roomno = mysqli_real_escape_string($db, $_GET['room']);
                                                    $inquiryid = mysqli_real_escape_string($db, $_GET['inquiry']);

                                                    $query = "
                                                        SELECT * FROM customers 
                                                        WHERE id = '".$customerid."'
                                                    ";

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
                                                            $id = $row['id'];
                                                            $firstname=$row['first_name'];
                                                            $lastname=$row['last_name'];
                                                            $email=$row['email'];
                                                            $address = $row['address'];
                                                            $mobile = $row['mobile'];
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
                                                                                                        <input name="mobile" type="text" id="phone" class="phone form-control" value="'.$mobile.'" readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr class="my-4" />
                                                                                        
                                                                                        <h6 class="heading-small text-muted mb-4">Room Information</h6>'?>
                                                                                        <?php
                                                                                            $query1 = "SELECT room.*, hotel.name AS hotel, room_types.name AS room_type 
                                                                                                        FROM room
                                                                                                        INNER JOIN hotel ON room.hotel_code = hotel.code
                                                                                                        INNER JOIN room_types ON room.room_type_id = room_types.id
                                                                                                        WHERE room_no = '".$roomno."'";
                                                                                            $result2 = mysqli_query($db,$query1) or trigger_error("Query Failed! SQL: $query1 - Error: ".mysqli_error($db), E_USER_ERROR);
                                                                                            if(mysqli_num_rows($result2) > 0){
                                                                                                while($row2 = mysqli_fetch_array($result2)){
                                                                                                    $room_id = $row2['id'];
                                                                                                    $room_room_no = $row2['room_no'];
                                                                                                    $room_hotel = $row2['hotel'];
                                                                                                    $room_type = $row2['room_type'];
                                                                                                    $room_ac = $row2['is_ac'];

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
                                                                                        
                                                                                        
                                                                                                        <?php echo'
                                                                                                        
                                                                                            <div class="col-lg-12">
                                                                                                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>' ;
                                                                $db = null;
                                                        }
                                                    }else{
                                                        echo '<center>Sorry No Customer Found!!</center>';
                                                    }
                                                    //Close the connection to the database.
                                                    $db = null;
                                                }
                                                catch(Exception $e){
                                                    http_response_code(500);
                                                    die('Error establishing connection with database');
                                                }
                                            }else{
                                                http_response_code(400);
                                                die('Error processing bad or malformed request');
                                            }
                                        }
                                        else{
                                            echo 'no';
                                        }
                                    ?>   
                                    <?php if(isset($_GET['success']))
                                    {
                                        echo'<a href="inquiry.php" type="button" style="color:white" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Inquiry</a>';  
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------- Registration process ------------------------------>
                <?php
                    if (isset($_POST['submit'])){
                        include 'Receptionist.php';
                        //create new instance from Receptionist class
                        $receptionist = new Receptionist(); 
                        $customer_id = $customerid;
                        $adults = $_POST['adults'];
                        $children = $_POST['children'];
                        $checkin = $_POST['checkin'];
                        $checkout = $_POST['checkout'];
                        if ($adults == "") {
                            $adults = 0;
                        }
                        if ($children == "") {
                            $children = 0;
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
                        $receptionist->addInquiry($customer_id, $room_type_id, $ac_value, $status, $receptionist_id, $checkin, $checkout, $adults, $children);
                    }
                ?>
                <!--------------------- add inquiry process end ------------------------>
                <script>
                    $('input[name="adults"]').mask('0000000000');
                    $('input[name="children"]').mask('0000000000');
                </script>
                
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                <?php 
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
                
                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>
        
        
        <script src="/Assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/Assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/Assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/Assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/Assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        
        <script src="/Assets/vendor/clipboard/dist/clipboard.min.js"></script>
        
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>