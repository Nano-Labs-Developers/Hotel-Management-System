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
        <?php include "../../Components/Bar/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/Bar/Navbar.php" ?>

            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Update Customers</li>
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
                                <h3 class="mb-0">Update Customers</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="table_id" class="display table align-items-center">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col" class="sort">ID</th>
                                                                    <th scope="col" class="sort">First Name</th>
                                                                    <th scope="col" class="sort">Last Name</th>
                                                                    <th scope="col" class="sort">Email</th>
                                                                    <th scope="col" class="sort">Address</th>
                                                                    <th scope="col" class="sort">Contact</th>
                                                                    <th scope="col" class="sort">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="list">
                                                                <?php
                                                                    require_once '../../Models/Database.inc.php';
                                                                    $connect = new Database();

                                                                    $db = $connect->db();
                                                                    $sql = "SELECT * FROM customers";
                                                                    $result = mysqli_query($db, $sql);
                                                                    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                                                    foreach ($customers as $customer) {
                                                                        $customerid = $customer['id'];
                                                                        $button = '<a href="edit_customer.php?id='.$customerid.'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> UPDATE</a>';

                                                                        echo '
                                                                            <tr>
                                                                                <td>'. $customer['id'] .'</td>
                                                                                <td>'. $customer['first_name'] .'</td>
                                                                                <td>'. $customer['last_name'] .'</td>
                                                                                <td>'. $customer['email'] .'</td>
                                                                                <td>'. $customer['address'] .'</td>
                                                                                <td>'. $customer['mobile'] .'</td>
                                                                                <td>'. $button .'</td>
                                                                                </td>
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
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>

        <script>$(document).ready(function() { $('#table_id').DataTable(); });
        </script>
        <script src="/Assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/Assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/Assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/Assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/Assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/Assets/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>