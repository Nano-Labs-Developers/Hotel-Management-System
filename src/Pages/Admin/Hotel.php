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
                                        <li class="breadcrumb-item active" aria-current="page">Hotels</li>
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
                                <h3 class="mb-0">Hotel Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <a href="/admin/hotels/edithotel" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Add New Hotel</a>
                                </div><br>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="hotels_table" class="display table align-items-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort">ID</th>
                                                    <th scope="col" class="sort">Name</th>
                                                    <th scope="col" class="sort">Code</th>
                                                    <th scope="col" class="sort">Address</th>
                                                    <th scope="col" class="sort">Phone</th>
                                                    <th scope="col" class="sort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php
                                                    require_once '../../Models/Database.inc.php';
                                                    $conn = new Database();
                                                    $db = $conn->db();
                                                    $sql = "SELECT * FROM hotel";
                                                    $result = mysqli_query($db, $sql);
                                                    $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                    foreach ($hotels as $hotel) {
                                                        $hotelID = $hotel['hotel_ID'];
                                                        $button = '<a href="admin/hotels/edithotel?id='. $hotelID .'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-marker"></i> UPDATE</a>';
                                                        $button = '<a href="#" id="delete-hotel" data-id="'. $hotelID .'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>';
                                                    
                                                        echo'
                                                            <tr>
                                                                <td> '.$hotel['hotel_ID'].'</td>
                                                                <td> '.$hotel['hotel_Address'].'</td>
                                                                <td> '.$hotel['hotel_Address'].'</td>
                                                                <td> '.$hotel['hotel_Address'].'</td>
                                                                <td> '.$hotel['hotel_Contact'].'</td>
                                                                <td> '.$button.'</td>
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
                $('#hotels_table').DataTable();
            });

            $("#delete-hotel").click(function(e) {
                var elem = document.getElementById('delete-hotel');
                var id = elem.getAttribute('data-id');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "delete_hotel.php",
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
        <script src="/src/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    </body>
</html>