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
                                        <li class="breadcrumb-item active" aria-current="page">Manage Attendance</li>
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
                                <h3 class="mb-0">Manage Attendance</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-4 order-xl-1">
                                        <div class="card">
                                            <a href="checkAttendance.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-briefcase"></i> Check Attendance</a>
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
                                                            <th scope="col" class="sort">Hotel</th>
                                                            <th scope="col" class="sort">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        <?php
                                                            require_once '../../Models/Database.inc.php';
                                                            $connect = new Database();
                                                            $db = $connect->db();
                                                            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                            $current_date = $current_date->format("Y-m-d");
                                                            $sql = "SELECT * FROM employees";
                                                            $result = mysqli_query($db, $sql);
                                                            $employees= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                            
                                                            foreach ($employees as $employee) {
                                                                $query = $db->query("SELECT * FROM attendance WHERE (`employee` = '".$employee['id']."') AND (`date` = '".$current_date."') ");
                                                                
                                                                if($query->num_rows != 1) {
                                                                    $presentButton = '<button type="button" name="present" id="'.$employee['id'].'" class="present btn btn-primary btn-sm"><i class="fas fa-check"></i> Mark as Present</button>';
                                                                    $absentButton = '<button type="button" name="absent" id="'.$employee['id'].'" class="absent btn btn-danger btn-sm"><i class="fas fa-times"></i> Mark as Absent</button>';
                                                                    
                                                                    echo '
                                                                        <tr>
                                                                            <td>'. $employee['id'] .'</td>
                                                                            <td>'. $employee['first_name'] .'</td>
                                                                            <td>'. $employee['last_name'] .'</td>
                                                                            <td>'. $employee['email'] .'</td>
                                                                            <td>'. $employee['hotel_no'] .'</td>
                                                                            <td>'. $presentButton; echo $absentButton .'</td>
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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.present', function() {
                    var id = $(this).attr("id");
                    var hrID = <?php echo $_SESSION['id']; ?>;

                    swal({
                        title: "Are you sure you want to mark as present this employee?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var action = "Present";
                            $.ajax({
                                url: "markEmployee.php",
                                method: "POST",
                                data: {
                                    id: id,
                                    action: action,
                                    hrID: hrID
                                },
                                success: function(data) {
                                    location.replace("manageAttendance.php?success=true");
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.absent', function() {
                    var id = $(this).attr("id");
                    var hrID = <?php echo $_SESSION['id']; ?>;

                    swal({
                        title: "Are you sure you want to mark as absent this employee?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var action = "Absent";
                            $.ajax({
                                url: "markEmployee.php",
                                method: "POST",
                                data: {
                                    id: id,
                                    action: action,
                                    hrID: hrID
                                },
                                success: function(data) {
                                    location.replace("manageAttendance.php?success=true");
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <script>$(document).ready(function() { $('#table_id').DataTable(); });</script>
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