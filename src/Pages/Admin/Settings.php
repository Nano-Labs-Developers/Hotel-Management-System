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
                                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
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
                                <h3 class="mb-0">Account Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                                        if (isset($_SESSION['id'])){
                                            $user_id = $_SESSION['id'];

                                            try{
                                                require_once '../../Models/Database.inc.php';
                                                $connect = new Database();
                                                $db = $connect->db();
                                            
                                                $userid = mysqli_real_escape_string($db, $user_id);
                                                $query = "SELECT * FROM user WHERE `user_ID` = '". $userid ."'";
                                                $result = mysqli_query($db, $query);

                                                if(mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_array($result)) {
                                                        $id = $row['user_ID'];
                                                        $firstname=$row['user_FName'];
                                                        $lastname=$row['user_LName'];
                                                        $email=$row['user_Email'];
                                                        $username = $row['user_Username'];

                                                        echo'                        
                                                            <div class="col-xl-8 order-xl-1">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="row align-items-center">
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form name="accountUpdateForm" action="" method="post" onsubmit="return validateForm()">
                                                                            <h6 class="heading-small text-muted mb-4">Personal information</h6>
                                                                            <div class="pl-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">Your ID</label>
                                                                                            <input name="id" type="text" class="form-control" value="'. $id .'" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label" for="input-email">Email address</label>
                                                                                            <input name="email" type="email" id="input-email" class="form-control" value="'. $email .'">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label" for="input-first-name">First name</label>
                                                                                            <input name="fname" type="text" id="input-first-name" class="form-control" value="'. $firstname .'" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label" for="input-last-name">Last name</label>
                                                                                            <input name="lname" type="text" id="input-last-name" class="form-control" value="'. $lastname .'" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <hr class="my-4" />
                                                                            
                                                                            <h6 class="heading-small text-muted mb-4">Account information</h6>
                                                                            <div class="pl-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label class="form-control-label" for="input-address">Username</label>
                                                                                        <input name="username" id="input-username" class="form-control" value="'. $username .'" type="text" required="">
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">New Password</label>
                                                                                            <input name="password" type="password" id="password" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <button type="submit" name="submit" class="btn btn-warning">Update</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        ';
                                                    }
                                                } else {
                                                    echo '<center>Invalid User Login!!</center>';
                                                }
                                                $db = null;

                                            } catch(Exception $ex) {
                                                http_response_code(500);
                                                die('Error establishing connection with database');
                                            }
                                        }
                                    ?>
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
                let FirstName = document.forms["accountUpdateForm"]["fname"].value;
                if (FirstName == "") {
                    swal("Update Failed!", "First Name Must be filled!", "error");
                    return false;
                }

                let LastName = document.forms["accountUpdateForm"]["lname"].value;
                if (LastName == "") {
                    swal("Update Failed!", "Last Name Must be filled!", "error");
                    return false;
                }

                let Username = document.forms["accountUpdateForm"]["username"].value;
                if (Username == "") {
                    swal("Update Failed!", "Last Name Must be filled!", "error");
                    return false;
                }

                var x = document.forms["accountUpdateForm"]["email"].value; //get form email value
                var atpos = x.indexOf("@");
                var dotpos = x.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                    swal("Update Failed!", "Not a valid e-mail address.", "error");
                    return false;
                }
            }
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

<?php
    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("Account Updated Success!", "Account Details Updated!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("Account Update Failed!", "Something went wrong!", "error");
            </script>
        ';
    }
    if(isset($_GET['emailexists'])) {
        echo'
            <script>
                swal("Account Update Failed!", "Email Already exists! Enter new email", "error");
            </script>
        ';
    }
    if(isset($_GET['usernameexists'])) {
        echo'
            <script>
                swal("Account Update Failed!", "Username Already exists! Enter new username", "error");
            </script>
        ';
    }
?>

<?php
    if (isset($_POST['submit'])){
        include 'Function.inc.php';

        $firstName = $_POST['fname'];
        $firstName= ucwords(strtolower($firstName));
        $lastName = $_POST['lname'];
        $lastName= ucwords(strtolower($lastName));

        $email = $_POST['email'];
        $username= $_POST['username'];
        $password= $_POST['password'];

        $firstName = stripslashes($firstName);
        $firstName = addslashes($firstName);
        $firstName = ucwords(strtolower($firstName));
        $lastName = stripslashes($lastName);
        $lastName = addslashes($lastName);
        $lastName = ucwords(strtolower($lastName));

        $email = stripslashes($email);
        $email = addslashes($email);
        $username = stripslashes($username);
        $username = addslashes($username);
        $password = stripslashes($password);
        $password = addslashes($password);

        $admin = new Admin(); 
        $userid = $_POST['id'];

        if ($admin->checkEmailExists($_POST['email'], $userid)) {
            echo'
                <script>
                    location.replace("settings.php?emailexists=true");
                </script>
            ';

        } else if ($admin->checkUsernameExists($username, $userid)) {
            echo'
                <script>
                    location.replace("settings.php?usernameexists=true");
                </script>
            ';
        } else {
            $admin->updateAccount($firstName, $lastName, $email, $username, $password, $userid);
        }
    }
?>