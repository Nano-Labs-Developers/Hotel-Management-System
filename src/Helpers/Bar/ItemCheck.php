<?php
    session_start();
    // if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
    //     header("location: /login");
    // }
    // if ($_SESSION['role_id'] != 1) {
    //     header("location: /login");
    // }
    // $user = $_SESSION['username'];
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
                                        <li class="breadcrumb-item active" aria-current="page">Sold Items</li>
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
                                <h3 class="mb-0">Sold Item List</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-4 order-xl-1">
                                        <div class="card">
                                            <a href="/hotelbar/itemsold" style="color: white" type="button" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table_id" class="display table align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col" class="sort">Sold ID</th>
                                                            <th scope="col" class="sort">Bar ID</th>
                                                            <th scope="col" class="sort">Sold Date</th>
                                                            <th scope="col" class="sort">Item ID</th>
                                                            <th scope="col" class="sort">Item Name</th>
                                                            <th scope="col" class="sort">QTY</th>
                                                            <th scope="col" class="sort">Income</th>
                                                            <th scope="col" class="sort">Updated By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <?php
                                                            require_once '../../Models/Database.inc.php';

                                                            $conn = new Database();
                                                            $db = $conn->db();
                                                            $sql = "SELECT * FROM bar_income";
                                                            $result = mysqli_query($db, $sql);
                                                            $items = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                                            foreach ($items as $item) {
                                                                $sql2 = "SELECT * FROM liquor_items WHERE id = '".$item['item']."'";
                                                                $result2 = mysqli_query($db, $sql2);
                                                                $liitems = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                                                
                                                                foreach ($liitems as $liitem) {
                                                                    $sql3 = "SELECT * FROM users WHERE id = '".$item['updated_by']."'";
                                                                    $result3 = mysqli_query($db, $sql3);
                                                                    $bartenders = mysqli_fetch_all($result3, MYSQLI_ASSOC);

                                                                    foreach ($bartenders as $bartender) {
                                                                        echo '
                                                                            <tr>
                                                                                <td>'. $item['ib_ID'] .'</td>
                                                                                <td>'. $item['ib_BarID'] .'</td>
                                                                                <td>'. $item['DateTine'] .'</td>
                                                                                <td>'. $item['ib_Item'] .'</td>
                                                                                <td>'. $item['ib_Name'] .'</td>
                                                                                <td>'. $item['ib_quantity'] .'</td>
                                                                                <td>'. $item['ib_income'] .'</td>
                                                                                <td>'. $item['ib_updater'] .'</td>
                                                                            </tr>
                                                                        ';
                                                                    }
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

                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>

        <script src="/src/Lib/js/argon.js?v=1.2.0"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script>$(document).ready(function() { $('#table_id').DataTable(); });</script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>
