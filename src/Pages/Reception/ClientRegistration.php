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
        <?php include "../../Components/Reception/NavbarSide.php" ?>

        <div class="main-content" id="panel">
            <?php include "../../Components/Reception/Navbar.php" ?>

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
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-first-name">First name<span style="color: red;">*</span></label>
                                                                        <input name="firstname" type="text" id="input-first-name" class="form-control" placeholder="First name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-last-name">Last name<span style="color: red;">*</span></label>
                                                                        <input name="lastname" type="text" id="input-last-name" class="form-control" placeholder="Last name" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label" for="input-email">Email address</label>
                                                                        <input name="email" type="email" id="input-email" class="form-control" placeholder="pasan@lakderana.com">
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
                                                                        <label class="form-control-label" for="input-address">Address<span style="color: red;">*</span></label>
                                                                        <input name="address" id="input-address" class="form-control" placeholder="Home Address" type="text" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">


                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Conatact Number<span style="color: red;">*</span></label>
                                                                        <input name="contactno" type="text" id="contactno" class="phone form-control" placeholder="+94 71 000 0000" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <button type="submit" name="submit" class="btn btn-success">Register</button>
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

                <?php include "../../Components/Common/Footer.php" ?>
            </div>
        </div>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>
            function validateForm() {
                let FirstName = document.forms["customerRegForm"]["firstname"].value;
                if (FirstName == "") {
                    swal("Registration Failed!", "First Name Must be filled!", "error");
                    return false;
                }
                let LastName = document.forms["customerRegForm"]["lastname"].value;
                if (LastName == "") {
                    swal("Registration Failed!", "Last Name Must be filled!", "error");
                    return false;
                }
                var num = document.forms["customerRegForm"]["contactno"].value;
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
        <script>$('input[name="firstname"]').mask('0000000000');</script>
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
    if (isset($_POST['submit'])){
        include '../../Helpers/Reception/function/FClientHandler.inc.php';
        $customer = new Client();
        
        if ($customer->customerEmailExists($_POST['email'])) {
            echo'
                <script>
                    location.replace("customer_registration.php?emailexists=true");
                </script>
            ';
        
        } else {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['contactno'];
            
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