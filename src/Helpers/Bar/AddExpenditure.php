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
                                        <li class="breadcrumb-item active" aria-current="page">Add Expenditure</li>
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
                                <h3 class="mb-0">Add Expenditure</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <div class="col-xl-8 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                                <div class="card-body">
                                                    <form name="addExpenditureForm" action="" method="post" onsubmit="return validateForm()">
                                                        <h6 class="heading-small text-muted mb-4">Item information</h6>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-name">Item Name</label>
                                                                        <input name="name" type="text" id="input-name" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-price">Amount</label>
                                                                        <input type="text" name="amount" value="0.00" class="form-control" onKeyPress="return isNumberDot(event);" autocomplete="off" onFocus="this.select();" onChange="if(this.value=='NaN' || this.value==''){this.value='0.00'};this.value=parseFloat(this.value).toFixed(2);"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-address">Select Bar</label>
                                                                        <select id="bar" name="bar" class="form-control">
                                                                            <?php
                                                                                require_once '../../Models/Database.inc.php';
                                                                                $conn = new Database();
                                                                                $db = $conn->db();
                                                                                $list = mysqli_query($db,"SELECT * FROM `bar`");

                                                                                while ($row = mysqli_fetch_assoc($list)) {
                                                                                    echo'
                                                                                        <option value="'.$row['id'].'">'.$row['hotel_no'].'</option>
                                                                                    ';
                                                                                } 
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">QTY</label>
                                                                        <input name="qty" type="text" id="stock" class="phone form-control" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="submit" name="submit" class="btn btn-warning">Submit</button>
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

                let Name = document.forms["addExpenditureForm"]["name"].value;
                if (Name == "") {
                    swal("Item Adding Failed!", "Item Name Must be filled!", "error");
                    return false;
                }
                let Qty = document.forms["addExpenditureForm"]["qty"].value;
                if (Qty == "") {
                    swal("Item Adding Failed!", "QTY Must be filled!", "error");
                    return false;
                }

                let Amount = document.forms["addExpenditureForm"]["amount"].value;
                if (Amount == "") {
                    swal("Item Adding Failed!", "Amount Must be filled!", "error");
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
    if (isset($_POST['submit']))
    {
        include 'Bartender.php';

        $bartender = new Bartender(); 

        $bartenderid = $_SESSION['id'];
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $qty = $_POST['qty'];

        $bar = filter_input(INPUT_POST, 'bar', FILTER_SANITIZE_STRING);
        $bar = $bar;
        
        $name= ucwords(strtolower($name));
        $name = stripslashes($name);
        $name = addslashes($name);
        $name = ucwords(strtolower($name));

        $amount = stripslashes($amount);
        $amount = addslashes($amount);
        $amount = ucwords(strtolower($amount));

        $qty= stripslashes($qty);
        $qty = addslashes($qty);

        $total = 0;
        $total = $amount * $qty;

        $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
        $current_date = $current_date->format("Y-m-d");

        $bartender->addExpenditure($bar, $current_date, $amount, $name, $qty, $total, $bartenderid);

    }

    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("Success!", "New Expenditure Details added!", "success");
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