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
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Client Registation</li>
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
                            <h3 class="mb-0">Client Registation</h3>
                        </div>
                        <div class="card-body">
                            <div class="row icon-examples">
                                <div class="col-xl-8 order-xl-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center"></div>
                                            <div class="card-body">
                                                <form>
                                                    <h6 class="heading-small text-muted mb-4">Client Information</h6>
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-email">Email</label>
                                                                    <input type="email" id="input-email" class="form-control" placeholder="contact@lakderana.com">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-first-name">First Name</label>
                                                                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Mike">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-last-name">Last Name</label>
                                                                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Hash">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-4" />
                                                    <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-address">Address</label>
                                                                    <input id="input-address" class="form-control" placeholder="Home Address" value="509/1, Kurunegala." type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-country">Contact Number</label>
                                                                    <input type="number" id="input-postal-code" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <button type="submit" class="btn btn-warning">Register</button>
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
                
                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="../src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../src/Lib/vendor/js-cookie/js.cookie.js"></script>
        <script src="../src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="../src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="../src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="../src/Lib/js/argon.js?v=1.2.0"></script>
</body>

</html>