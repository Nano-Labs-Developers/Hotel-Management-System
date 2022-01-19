<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != 'be882d21e7a861094e65f6c509360b0cca9eadc0') {
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
                                        <li class="breadcrumb-item active" aria-current="page">Daily Sales</li>
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
                                <h3 class="mb-0">Daily Sales</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
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

                                                            $total = 0;
                                                            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                            $current_date = $current_date->format("Y-m-d");

                                                            $sql = "SELECT * FROM bar_income WHERE date = '".$current_date."'";
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
                                                                        $total = $total + $item['income'];

                                                                        echo '
                                                                            <tr>
                                                                                <td>'. $item['id'] .'</td>
                                                                                <td>'. $item['bar_id'] .'</td>
                                                                                <td>'. $item['date'] .'</td>
                                                                                <td>'. $item['item'] .'</td>
                                                                                <td>'. $liitem['name'] .'</td>
                                                                                <td>'. $item['qty'] .'</td>
                                                                                <td>Rs.'. $item['income'] .'</td>
                                                                                <td>'. $bartender['username'] .'</td>
                                                                            </tr>
                                                                        ';
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <div class="card card-stats">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Daily Income</h5>
                                                                <span class="h2 font-weight-bold mb-0">Rs. <?php echo $total; ?></span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-0 text-sm">
                                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                            <span class="text-nowrap">Since last day</span>
                                                        </p>
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
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>