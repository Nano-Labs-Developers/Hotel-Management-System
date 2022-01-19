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
                                        <li class="breadcrumb-item active" aria-current="page">Check Inquiries</li>
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
                                <h3 class="mb-0">Check Inquiries</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center"></div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="table_id" class="display table align-items-center">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col" class="sort">ID</th>
                                                                    <th scope="col" class="sort">Customer ID</th>
                                                                    <th scope="col" class="sort">Room Type</th>
                                                                    <th scope="col" class="sort">AC</th>
                                                                    <th scope="col" class="sort">Status</th>
                                                                    <th scope="col" class="sort">Recipient ID</th>
                                                                    <th scope="col" class="sort">Check In</th>
                                                                    <th scope="col" class="sort">Check Out</th>
                                                                    <th scope="col" class="sort">Adults</th>
                                                                    <th scope="col" class="sort">Children</th>
                                                                    <th scope="col" class="sort">Action</th>
                                                                    <th scope="col" class="sort">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="list">
                                                                <?php
                                                                    require_once '../../Models/Database.inc.php';

                                                                    $conn = new Database();
                                                                    $db = $conn->db();
                                                                    $sql = "SELECT * FROM inquiry";
                                                                    $result = mysqli_query($db, $sql);
                                                                    $inquiries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                    
                                                                    foreach ($inquiries as $inquiry) {
                                                                        $button = ''; 

                                                                        if ($inquiry['status'] == 0) {
                                                                            $in_status = '
                                                                                <span class="badge badge-dot mr-4">
                                                                                    <i class="bg-danger"></i>
                                                                                    <span class="status">Pending</span>
                                                                                </span>
                                                                            ';
                                                                            $button = '<a href="edit_inquiry.php?inquiry='.$inquiry['id'].'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> UPDATE</a>'; 

                                                                        } else if ($inquiry['status'] == 1) {
                                                                            $button = ''; 
                                                                            $in_status ='
                                                                                <span class="badge badge-dot mr-4">
                                                                                    <i class="bg-primary"></i>
                                                                                    <span class="status">Transferred</span>
                                                                                </span>
                                                                            ';

                                                                        } else {
                                                                            $in_status ='
                                                                                <span class="badge badge-dot mr-4">
                                                                                    <i class="bg-success"></i>
                                                                                    <span class="status">Completed</span>
                                                                                </span>
                                                                            ';
                                                                            $button = '';
                                                                        }

                                                                        if ($inquiry['is_ac'] == 1) {
                                                                            $ac_type = '<i style="color:green" class="fas fa-check"></i>';
                                                                        }
                                                                        else {
                                                                            $ac_type = '<i style="color:red" class="fas fa-times"></i>';
                                                                        }

                                                                        $viewButton = '<a href="view_inquiry.php?inquiry='.$inquiry['id'].'" type="button" class="btn btn-success btn-sm"><i class="fas fa-file"></i> SHOW MORE INFO</a>';
                                                                        
                                                                        $sql2 = "SELECT * FROM room_types WHERE id = '".$inquiry['room_type_id']."'";
                                                                        $result2 = mysqli_query($db, $sql2);
                                                                        $rooms = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                                                                        foreach ($rooms as $room) {
                                                                            echo'    
                                                                                <tr>
                                                                                    <td>'. $inquiry['id'] .'</td>
                                                                                    <td>'. $inquiry['customer_id'] .'</td>
                                                                                    <td>'. $room['name'] .'</td>
                                                                                    <td>'. $ac_type .'</td>
                                                                                    <td>'. $inquiry['recipient_id'] .'</td>
                                                                                    <td>'. $inquiry['check_in'] .'</td>
                                                                                    <td>'. $inquiry['check_out'] .'</td>
                                                                                    <td>'. $inquiry['adults'] .'</td>
                                                                                    <td>'. $inquiry['children'] .'</td>
                                                                                    <td>'. $viewButton .'</td>
                                                                                    <td>'. $button .'</td>
                                                                                </tr>
                                                                            ';
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "../../Components/Common/Footer.php" ?>

            </div>
        </div>

        <script>$(document).ready(function() { $('#table_id').DataTable(); });</script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>