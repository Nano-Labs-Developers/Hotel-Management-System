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
                                        <li class="breadcrumb-item active" aria-current="page">Rooms</li>
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
                                <h3 class="mb-0">Room Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <a href="/admin/rooms/editroom" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Add New Room</a>
                                </div><br>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="rooms_table" class="display table align-items-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort">ID</th>
                                                    <th scope="col" class="sort">Hotel</th>
                                                    <th scope="col" class="sort">Room No.</th>
                                                    <th scope="col" class="sort">Room Type</th>
                                                    <th scope="col" class="sort">AC</th>
                                                    <th scope="col" class="sort">Room Availability</th>
                                                    <th scope="col" class="sort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php
                                                    require_once '../../Models/Database.inc.php';
                                                    $connect = new Database();
                                                    $db = $connect->db();

                                                    $sql = "SELECT room.*, hotel.hotel_Name AS hotel, room_type.rt_Type AS room_type FROM room INNER JOIN hotel ON room.hotel_Code = hotel.hotel_Code INNER JOIN room_type ON room.rt_ID  = room_type.rt_ID";
                                                    $result = mysqli_query($db, $sql);
                                                    $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                    
                                                    foreach ($rooms as $room) {
                                                        $roomid = $room['room_ID'];
                                                        $button = '<a href="/admin/rooms/editroom?id='. $roomid .'" type="button" class="btn btn-success btn-sm"><i class="fas fa-marker"></i> UPDATE</a>';
                                                        $button .= '<a href="#" id="delete-room" data-id="'. $roomid .'" type="button" class="btn btn-success btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>';
                                                        
                                                        echo'
                                                            <tr>
                                                                <td>'. $room['hotel_ID'] .'</td>
                                                                <td>'. $room['hotel_Name'] .'</td>
                                                                <td>'. $room['room_Number'] .'</td>
                                                                <td>'. $room['rt_Type'] .'</td>
                                                                <td>'($room['room_AC'] == 1 ? '<span style="background-color:green; color:white; padding: 5px;">Yes</span>' : '<span style="background-color:red; color:white; padding: 5px;">No</span>');'</td>
                                                                <td>'($room['room_Status'] == 1 ? '<span style="background-color:green; color:white; padding: 5px;">Available</span>' : '<span style="background-color:red; color:white; padding: 5px;">Not Available</span>');'</td>
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

        <script>
            $(document).ready( function () {
                $('#rooms_table').DataTable();
            });

            $("#delete-room").click(function(e) {
                var elem = document.getElementById('delete-room');
                var id = elem.getAttribute('data-id');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "delete_room.php",
                    data: { 
                        id: id
                    },
                    success: function(result) {
                        console.log('ok');
                    },
                    error: function(result) {
                        console.log('error');
                    }
                });
            });
        </script>
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