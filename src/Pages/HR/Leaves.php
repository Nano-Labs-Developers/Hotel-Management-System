<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != '7894eecc71d998d2eedd5522816a25b282752eec') {
        header("location: /login");
    }
    $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <?php include "../../Components/Common/Header.php" ?>

    <body>
        <?php include "../../Components/HR/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/HR/Navbar.php" ?>

            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Employee Leaves</li>
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
                                <h3 class="mb-0">Manage Employee Leaves</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-4 order-xl-1">
                                        <div class="card">
                                            <a href="checkLeaves.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-file"></i> Check Leaves</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table_id" class="display table align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col" class="sort">Emp ID</th>
                                                            <th scope="col" class="sort">First Name</th>
                                                            <th scope="col" class="sort">Last Name</th>
                                                            <th scope="col" class="sort">Email</th>
                                                            <th scope="col" class="sort">Hotel Code</th>
                                                            <th scope="col" class="sort">Job Role</th>
                                                            <th scope="col" class="sort">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <?php
                                                            require_once '../../Models/Database.inc.php';
                                                            $conn = new Database();
                                                            $db = $conn->db();
                                                            $sql = "SELECT * FROM employees";
                                                            $result = mysqli_query($db, $sql);
                                                            $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            
                                                            foreach ($employees as $employee){
                                                                $sql2 = "SELECT * FROM job_roles WHERE id = '".$employee['job_role_id']."'";
                                                                $result2 = mysqli_query($db, $sql2);
                                                                $jobs = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                                                                foreach ($jobs as $job) {
                                                                    $jobType = $job['name'];
                                                                    $button = '<a href="addLeave.php?id='.$employee['id'].'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> Add Leave</a>';
                                                                    
                                                                    echo '
                                                                        <tr>
                                                                            <td>'. $employee['id'] .'</td>
                                                                            <td>'. $employee['first_name'] .'</td>
                                                                            <td>'. $employee['last_name'] .'</td>
                                                                            <td>'. $employee['email'] .'</td>
                                                                            <td>'. $employee['hotel_no'] .'</td>
                                                                            <td>'. $jobType .'</td>
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