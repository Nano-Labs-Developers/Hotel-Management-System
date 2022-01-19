<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != 'c56eaf051e59063eac323a11a52ff50d73ad7435') {
        header("location: /login");
    }
    $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <?php include "../../Components/Admin/Header.php" ?>

    <body style="background-color: #f7f3f2;">
        <?php include "../../Components/Admin/NavbarSide.php" ?>
        
        <div class="main-content" id="panel">
            <?php include "../../Components/Admin/Navbar.php" ?>

            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Hotel</li>
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
                                <h3 class="mb-0">Edit Hotel Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                                        if (isset($_GET['id'])){ 
                                            $hotelid = $_GET['id'];
                                            if ( is_numeric($hotelid) == true){
                                                require_once '../../Models/Database.php';

                                                try {
                                                    $conn = new Database();
                                                    $db = $conn->db();
                                                    $hotelid = mysqli_real_escape_string($db, $_GET['id']);
                                                    $query = " SELECT hotel.* FROM hotel WHERE hotel.hotel_ID = '".$hotelid."'";
                                                    $result = mysqli_query($db, $query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_array($result)){
                                                            $id = $row['hotel_ID'];
                                                            $name=$row['hotel_Name'];
                                                            $code=$row['hotel_Code'];
                                                            $address=$row['hotel_Address'];
                                                            $contact = $row['hotel_Contact'];

                                                            echo'                        
                                                                <div class="col-xl-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <div class="row align-items-center">
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form name="hotelUpdateForm" action="" method="post">
                                                                                <div class="pl-lg-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label">ID</label>
                                                                                                <input name="id" type="text" class="form-control" value="'.$id.'" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-name">Name</label>
                                                                                                <input name="name" type="name" id="input-name" class="form-control" value="'.$name.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-code">Code</label>
                                                                                                <input name="code" type="text" id="input-code" class="form-control" value="'.$code.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-address">Address</label>
                                                                                                <input name="address" type="text" id="input-address" class="form-control" value="'.$address.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="pl-lg-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-contact">Contact</label>
                                                                                                <input name="contact" id="input-contact" class="form-control" value="'.$contact.'" type="text" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <button type="submit" name="submit" class="btn btn-warning">Update</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ';

                                                            $db = null;
                                                        }
                                                    }
                                                    else {
                                                        echo '<center>Sorry No Hotel Found!!</center>';
                                                    }
                                                    $db = null;
                                                }
                                                catch (Exception $ex){
                                                    http_response_code(500);
                                                    die('Error establishing connection with database');
                                                }
                                            }
                                            else {
                                                http_response_code(400);
                                                die('Error processing bad or malformed request');
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "../../Components/Admin/Footer.php" ?>

        </div>

        <?php
            if (isset($_POST['submit'])){
                include 'Function.inc.php';
                
                $admin = new Admin(); 
                $hotel_id = $_POST['id'];
                
                if ($admin->checkHotelCodeExists($_POST['code'], $hotel_id)) {
                    echo'
                        <script>
                            location.replace("/admin/hotels/edithotel.php?id='.$hotel_id.'&hotelcodeexists=true");
                        </script>
                    ';
                }
                else {
                    $name = $_POST['hotel_Name'];
                    $code = $_POST['hotel_Code'];
                    $address = $_POST['hotel_Address'];
                    $contact = $_POST['hotel_Contact'];
                    $admin->updateHotel($name, $code, $address, $contact, $hotel_id);
                }
            }
        ?>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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
    if(isset($_GET['success']))
    {
        echo'<script>
                swal("Hotel Update Success!", "Hotel Details Updated!", "success");
            </script>';
    
    }
    if(isset($_GET['failed']))
    {
        echo'<script>
                swal("Hotel Update Failed!", "Something went wrong!", "error");
            </script>'; 
    }
    if(isset($_GET['hotelcodeexists']))
    {
        echo'<script>
                swal("Hotel Update Failed!", "Hotel Code Already exists! Enter new code", "error");
            </script>';
    }
?>