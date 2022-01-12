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
                                        <li class="breadcrumb-item active" aria-current="page">Check Attendance</li>
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
                                <h3 class="mb-0">Check Attendance</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-4 order-xl-1">
                                        <div class="card">
                                            <a href="manageAttendance.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Mark Attendance</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table_id" class="display table align-items-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col" class="sort">Attendance ID</th>
                                                            <th scope="col" class="sort">Emp ID</th>
                                                            <th scope="col" class="sort">First Name</th>
                                                            <th scope="col" class="sort">Last Name</th>
                                                            <th scope="col" class="sort">Email</th>
                                                            <th scope="col" class="sort">Hotel</th>
                                                            <th scope="col" class="sort">Date</th>
                                                            <th scope="col" class="sort">Status</th>
                                                            <th scope="col" class="sort">Duration</th>
                                                            <th scope="col" class="sort">Updated By</th>
                                                            <th scope="col" class="sort">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <?php
                                                            require_once '../../Models/Database.php';
                                                            $connect = new Database();
                                                            $db = $connect->db();
                                                            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                            $current_date = $current_date->format("Y-m-d");
                                                            $sql = "SELECT * FROM attendance";
                                                            $result = mysqli_query($db, $sql);
                                                            $attendances= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            
                                                            foreach ($attendances as $attendance) {
                                                                if ($attendance['is_present'] == 1) {
                                                                    $status = '<span class="badge badge-pill badge-success">Present</span>';
                                                                } else {
                                                                    $status = '<span class="badge badge-pill badge-danger">Absent</span>';
                                                                }

                                                                $sql2 = "SELECT * FROM employees WHERE id = '".$attendance['employee']."'";
                                                                $result2 = mysqli_query($db, $sql2);
                                                                $employees = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                                                                if ($result2->num_rows == 1) {
                                                                    foreach ($employees as $employee) {
                                                                        $updateButton = '<a href="editAttendance.php?id='.$attendance['id'].'" type="button" class="present btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> Update</a>';
                                                                        $sql3 = "SELECT * FROM users WHERE id = '".$attendance['updated_by']."'";
                                                                        $result3 = mysqli_query($db, $sql3);
                                                                        $hrManagers = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                                                        
                                                                        if ($result3->num_rows == 1) {
                                                                            foreach ($hrManagers as $hrManager) { 
                                                                                $hrName= $hrManager['username'];
                                                                                
                                                                                echo '
                                                                                    <tr>
                                                                                        <td>'. $attendance['id'] .'</td>
                                                                                        <td>'. $attendance['employee'] .'</td>
                                                                                        <td>'. $employee['first_name'] .'</td>
                                                                                        <td>'. $employee['last_name'] .'</td>
                                                                                        <td>'. $employee['email'] .'</td>
                                                                                        <td>'. $employee['hotel_no'] .'</td>
                                                                                        <td>'. $attendance['date'] .'</td>
                                                                                        <td>'. $status .'</td>
                                                                                        <td>'. $attendance['duration'] .'</td>
                                                                                        <td>'. $hrName .'</td>
                                                                                        <td>'. $updateButton .'</td>
                                                                                    </tr>
                                                                                ';
                                                                            }
                                                                        }
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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>$(document).ready(function() { $('#table_id').DataTable();});</script>
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

<?php
    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("Success", "Attendance Marked Success!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("Failed", "Attendance Marked Failed!", "error");
            </script>
        ';
    }
?>