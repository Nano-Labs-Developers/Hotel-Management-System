<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != '8f69f7bef0f6592cbddb3de0eb707efca94c9100') {
        header("location: /login");
    }
    $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <?php include "../../Components/Common/Header.php" ?>

    <body>
        <?php include "../../Components/Reception/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/Reception/Navbar.php" ?>

            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Inquiry</li>
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
                                <h3 class="mb-0">Add Inquiry</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                                        if (isset($_GET['client'])) {
                                            $clientID = $_GET['client'];

                                            if (is_numeric($clientID) == true) {
                                                require_once '../../Models/Database.inc.php';
                                                try {
                                                    $conn = new Database();
                                                    $db = $conn->db();
                                            
                                                    $clientID = mysqli_real_escape_string($db, $_GET['client']);
                                                    $query = "SELECT * FROM client WHERE client_ID = '". $clientID ."' ";
                                                    $result = mysqli_query($db, $query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        $c_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                        $c_date = $c_date->format("Y-m-d");
                                                        $c_time = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                        $c_time = $c_time->format("H:i");

                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $id = $row['client_ID'];
                                                            $firstname=$row['client_FName'];
                                                            $lastname=$row['client_LName'];
                                                            $email=$row['client_Email'];
                                                            $address = $row['client_Address'];
                                                            $contact = $row['client_Contact'];

                                                            echo'
                                                                <div class="col-xl-8 order-xl-1">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <div class="row align-items-center"></div>
                                                                            <div class="card-body">
                                                                                <form name="addInquiryForm" action="" method="post" ">
                                                                                    <h6 class="heading-small text-muted mb-4 ">Customer Information</h6>
                                                                                    <div class="pl-lg-4 ">
                                                                                        <div class="row ">
                                                                                            <div class="col-lg-6 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label ">Customer ID</label>
                                                                                                    <input name="id " type="text " class="form-control " value=" '.$id.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label " for="input-email ">Email address</label>
                                                                                                    <input name="email " type="email " id="input-email " class="form-control " value=" '.$email.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row ">
                                                                                            <div class="col-lg-6 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label " for="input-first-name ">First name</label>
                                                                                                    <input name="fname " type="text " id="input-first-name " class="form-control " value=" '.$firstname.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label " for="input-last-name ">Last name</label>
                                                                                                    <input name="lname " type="text " id="input-last-name " class="form-control " value=" '.$lastname.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr class="my-4 " />
                                                                                    <h6 class="heading-small text-muted mb-4 ">Contact Information</h6>
                                                                                    <div class="pl-lg-4 ">
                                                                                        <div class="row ">
                                                                                            <div class="col-md-12 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label " for="input-address ">Address</label>
                                                                                                    <input name="address " id="input-address " class="form-control " value=" '.$address.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row ">
                                                                                            <div class="col-lg-12 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label ">Mobile</label>
                                                                                                    <input name="mobile " type="text " id="phone " class="phone form-control " value=" '.$contact.' " readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr class="my-4 " />
                                                                                    <h6 class="heading-small text-muted mb-4 ">Enter Room Information</h6>
                                                                                    <div class="pl-lg-4 ">
                                                                                        <div class="row ">
                                                                                            <div class="col-md-12 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label " for="input-address ">Select Room Type</label>
                                                                                                    <select name="room_types " class="form-control ">
                                                                                                        '.
                                                                                                        $list = mysqli_query($db,"SELECT * FROM `room_type` ");
                                                                                                        while ($row = mysqli_fetch_assoc($list)) {
                                                                                                            echo' <option value="'. $row['rt_ID']. '">'. $row['rt_Type'] .'</option>';
                                                                                                        }
                                                                                                        '
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row ">
                                                                                            <div class="col-lg-12 ">
                                                                                                <div class="form-group ">
                                                                                                    <label for="adults " class="form-control-label ">Enter Total Adults</label>
                                                                                                    <input name="adults " class="form-control " type="text " id="adults " min="0 ">
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label for="children " class="form-control-label ">Enter Total Children</label>
                                                                                                    <input name="children " class="form-control " type="text " id="children " min="0 ">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row ">
                                                                                            <div class="col-lg-12 ">
                                                                                                <div class="form-group ">
                                                                                                    <label class="form-control-label ">AC ?</label>
                                                                                                    <br/>
                                                                                                    <label class="custom-toggle ">
                                                                                                        <input name="ac_type " type="checkbox " checked>
                                                                                                        <span class="custom-toggle-slider rounded-circle " data-label-off="No " data-label-on="Yes "></span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label for="example-datetime-local-input " class="form-control-label ">Check In</label>
                                                                                                    <input name="checkin " class="form-control " type="datetime-local " value=" '.$c_date.'T '.$c_time.':00 " id="example-datetime-local-input ">
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label for="example-datetime-local-input " class="form-control-label ">Check Out</label>
                                                                                                    <input name="checkout " class="form-control " type="datetime-local " value=" '.$c_date.'T '.$c_time.':00 " id="example-datetime-local-input ">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-12 ">
                                                                                                <button type="submit " name="submit " class="btn btn-warning ">Submit</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ';
                                                        }
                                                    } else {
                                                        echo '<center>Sorry No Customer Found!!</center>';
                                                    }
                                                    $db = null;
                                                } catch(Exception $ex){
                                                    http_response_code(500);
                                                    die('Error establishing connection with database');
                                                }
                                            } else {
                                                http_response_code(400);
                                                die('Error processing bad or malformed request');
                                            }
                                        }
                                    ?>

                                    <?php
                                        if(isset($_GET['success'])) {
                                            echo'<a href="inquiry.php" type="button" style="color:white" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Inquiry</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "../../Components/Common/Footer.php" ?>
            </div>
        </div>

        <script>
            $('input[name="adults"]').mask('0000000000');
            $('input[name="children"]').mask('0000000000');
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>

<?php
    if (isset($_POST['submit'])){
        include 'Receptionist.php';
        $receptionist = new Reception(); 
    
        $client_id = $clientID;
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
        
        $rm_type = filter_input(INPUT_POST, 'room_type', FILTER_SANITIZE_STRING);
        $room_type_id = $rm_type;
        $AC = $_POST['ac_type'];
        
        if ($AC == "on") {
            $ac_value = 1;
        } else {
            $ac_value = 0;
        }
        
        $status = 0;
        $receptionist_id = $_SESSION['id'];
    
        $receptionist->addInquiry($client_id, $room_type_id, $ac_value, $status, $receptionist_id, $checkin, $checkout, $adults, $children);
    }

    if(isset($_GET['registration'])) {
        echo'
            <script>
                swal("Customer Registration Success!", "New Customer Details added!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("Inquiry Adding Failed!", "Something went wrong!", "error");
            </script>
        ';
    }
    if(isset($_GET['success']))
    {
        echo'
            <script>
                swal("Success!", "Inquiry Added Successfully!", "success");
            </script>
        ';
    }
?>