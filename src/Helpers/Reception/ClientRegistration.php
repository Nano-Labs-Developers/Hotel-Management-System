<?php
    session_start();
    if(!(isset($_SESSION['user_secret'])) && !(isset($_SESSION['username']))){
        header("location: /login");
    }
    if ($_SESSION['user_secret'] != '8f69f7bef0f6592cbddb3de0eb707efca94c9100') {
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
                                        <li class="breadcrumb-item active" aria-current="page">Register Customer</li>
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
                                <h3 class="mb-0">Register Customer</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">

                                    <div class="col-xl-8 order-xl-1">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                </div>
                                                <div class="card-body">
                                                    <form name="customerRegForm" action="" method="post" onsubmit="return validateForm()">
                                                        <h6 class="heading-small text-muted mb-4">Customer information</h6>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-email">Email address</label>
                                                                        <input name="email" type="email" id="input-email" class="form-control" placeholder="jesse@example.com">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-first-name">First name</label>
                                                                        <input name="fname" type="text" id="input-first-name" class="form-control" placeholder="First name" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-last-name">Last name</label>
                                                                        <input name="lname" type="text" id="input-last-name" class="form-control" placeholder="Last name" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="my-4" />

                                                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                                        <div class="pl-lg-4">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-address">Address</label>
                                                                        <input name="address" id="input-address" class="form-control" placeholder="Home Address" type="text" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">


                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Mobile</label>
                                                                        <input name="mobile" type="text" id="phone" class="phone form-control" placeholder="077 123 4567" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <button type="submit" name="submit" class="btn btn-warning">Register</button>
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
                let FirstName = document.forms["customerRegForm"]["fname"].value;
                if (FirstName == "") {
                    swal("Registration Failed!", "First Name Must be filled!", "error");
                    return false;
                }
                let LastName = document.forms["customerRegForm"]["lname"].value;
                if (LastName == "") {
                    swal("Registration Failed!", "Last Name Must be filled!", "error");
                    return false;
                }
                var num = document.forms["customerRegForm"]["mobile"].value;
                if (num == null || num.length != "10") {
                    swal("Registration Failed!", "Enter Correct number!", "error");
                    return false;
                }
                var x = document.forms["customerRegForm"]["email"].value;
                var atpos = x.indexOf("@");
                var dotpos = x.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                    swal("Registration Failed!", "Not a valid e-mail address.", "error");
                    return false;
                }
            }
        </script>
        <script>$('input[name="mobile"]').mask('0000000000');</script>
        <script src="/Assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/Assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/Assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/Assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/Assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/Assets/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>

<?php
    if (isset($_POST['submit'])){
        include 'Customer.php';
        $customer = new Customer();
        
        if ($customer->customerEmailExists($_POST['email'])) {
            echo'
                <script>
                    location.replace("customer_registration.php?emailexists=true");
                </script>
            ';
        
        } else {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['mobile'];
            
            $firstName= ucwords(strtolower($firstName));
            $firstName = stripslashes($firstName);
            $firstName = addslashes($firstName);
            $firstName = ucwords(strtolower($firstName));
            
            $lastName= ucwords(strtolower($lastName));
            $lastName = stripslashes($lastName);
            $lastName = addslashes($lastName);
            $lastName = ucwords(strtolower($lastName));
            
            $email = stripslashes($email);
            $email = addslashes($email);
            
            $address = stripslashes($address);
            $address = addslashes($address);
            
            $contact = stripslashes($contact);
            $contact = addslashes($contact);
            
            $customer->registerCustomer($firstName, $lastName, $email, $address, $contact);
        }
    }

    if(isset($_GET['registration'])) {
        echo'
            <script>
                swal("Customer Registration Success!", "New Customer Details added!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("Customer Registration Failed!", "Something went wrong!", "error");
            </script>
        ';
    }
    if(isset($_GET['emailexists'])) {
        echo'
            <script>
                swal("Customer Registration Failed!", "Customer Email Already exists! Enter new email", "error");
            </script>
        ';
    }
?>