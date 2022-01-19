<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != '1b1c9df50fb107e510b219734d95099ec467ff2f') {
        header("location: /login");
    }
    $user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <?php include "../../Components/Common/Header.php" ?>

    <body>
        <?php include "../../Components/Reservation/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/Reservation/Navbar.php" ?>
            
            <div class="header bg-gradient-info pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Search Customer</li>
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
                                <h3 class="mb-0">Customers</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-12 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                            <div class="card-body">
                                                <input type="text" name="search_text" id="search_text" class="form-control form-control-muted" placeholder="Search Customer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="col-xl-12 order-xl-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                            </div>
                                            <div class="card-body">
                                                <div id="result"></div>
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

        <script>
            $(document).ready(function() {
                function load_data(query) {
                    $.ajax({
                        url:"search_customers.php",
                        method:"post",
                        data:{query:query},
                        success:function(data) {
                            $('#result').html(data);
                        }
                    });
                }
  
                $('#search_text').keyup(function() {
                    var search = $(this).val();
                    if(search != '') {
                        load_data(search);
                    }
                    else {
                        load_data();      
                    }
                });
            });
        </script>
        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>