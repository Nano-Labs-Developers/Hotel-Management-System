<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != 'b44dee55ec976b5792aa82b5df830587818648b2') {
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
                                        <li class="breadcrumb-item active" aria-current="page">Generate Hotel Income Report</li>
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
                                <h3 class="mb-0">Hotel Income Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-8 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                                <div class="card-body">
                                                    <form name="addItemForm" action="reports/hotel_income_report.php" method="post" onsubmit="return validateForm()">
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <?php
                                                                    $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                                    $current_date = $current_date->format("Y-m-d");
                                                                    $last_date= date('Y-m-d', strtotime($current_date . ' -1 month'));

                                                                    echo'
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                            <label for="example-datetime-local-input" class="form-control-label">Date From</label>
                                                                            <input name="fromDate" class="form-control" type="date" value="'.$last_date.'" id="example-datetime-local-input">
                                                                            </div> 
                                                                        </div> 

                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                            <label for="example-datetime-local-input" class="form-control-label">Date To</label>
                                                                            <input name="toDate" class="form-control" type="date" value="'.$current_date.'" id="example-datetime-local-input">
                                                                            </div> 
                                                                        </div>
                                                                    ';
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="submit" name="submit" class="btn btn-warning">Generate</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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

        <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>

<?php
    if (isset($_POST['submit'])) {
        

    }
?>