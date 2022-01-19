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
                                        <li class="breadcrumb-item active" aria-current="page">Generate Bar Income Report</li>
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
                                <h3 class="mb-0">Bar Income Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-8 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                                <div class="card-body">
                                                    <form name="addItemForm" action="reports/bar_income_report.php" method="post" onsubmit="return validateForm()">
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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>
            function validateForm() {
                let Name = document.forms["addItemForm"]["name"].value;
                if (Name == "") {
                    swal("Item Adding Failed!", "Item Name Must be filled!", "error");
                    return false;
                }
                let Size = document.forms["addItemForm"]["size"].value;
                if (Size == "") {
                    swal("Item Adding Failed!", "Size Must be filled!", "error");
                    return false;
                }

                let Stock = document.forms["addItemForm"]["stock"].value;
                if (Stock == "") {
                    swal("Item Adding Failed!", "Stock Must be filled!", "error");
                    return false;
                }
            }
        </script>
        <script>
            $('input[name="stock"]').mask('0000000000');

            function isNumberDot(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46 && charCode != 127) {
                    return false;
                }
                return true;
            }
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

<?php
    if (isset($_POST['submit'])) {
        

    }

    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("Success!", "New Item Details added!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("Failed!", "Something went wrong!", "error");
            </script>
        ';
    }
?>