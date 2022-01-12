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
                                        <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                <h3 class="mb-0">System User Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <a href="/admin/users/NewUser" type="button" class="btn btn-success"><i class="fas fa-user-plus"></i> Add New User</a>
                                </div><br>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="users_table" class="display table align-items-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort">ID</th>
                                                    <th scope="col" class="sort">First Name</th>
                                                    <th scope="col" class="sort">Last Name</th>
                                                    <th scope="col" class="sort">Email</th>
                                                    <th scope="col" class="sort">Username</th>
                                                    <th scope="col" class="sort">Hotel No.</th>
                                                    <th scope="col" class="sort">Active</th>
                                                    <th scope="col" class="sort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php
                                                    require_once '../../Models/Database.inc.php';
                                                    $connect = new Database();
                                                    $db = $connect->db();
                                                    $sql = "SELECT * FROM user";
                                                    $result = mysqli_query($db, $sql);
                                                    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                    
                                                    foreach ($users as $user) {
                                                        $userid = $user['user_ID'];
                                                        $button = '<a href="/admin/users/editusers?id='. $userid .'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> UPDATE</a>';
                                                        //'. $user['hotel_no'] .'
                                                        echo '
                                                            <tr>
                                                                <td>'. $user['user_ID'] .'</td>
                                                                <td>'. $user['user_FName'] .'</td>
                                                                <td>'. $user['user_LName'] .'</td>
                                                                <td>'. $user['user_Email'] .'</td>
                                                                <td>'. $user['user_Username'] .'</td>
                                                                <td>55</td>
                                                                <td>'. ($user['user_AccStatus'] == 1 ? '<span style="background-color:green; color:white; padding: 5px;">Yes</span>' : '<span style="background-color:red; color:white; padding: 5px;">No</span>') .'</td>
                                                                <td>'. $button .'</td>
                                                            </tr>
                                                        ';
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
                
                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>

        <script>$(document).ready(function() { $('#users_table').DataTable(); });</script>
        <script src="/src/Assets/js/argon.js?v=1.2.0"></script>
        <script src="/src/Assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Assets/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>