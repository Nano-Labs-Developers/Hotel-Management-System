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
                                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
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
                                <h3 class="mb-0">Add User Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">                      
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                            </div>
                                            <div class="card-body">
                                                <form name="userAddForm" action="" method="post">
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-first-name">First Name</label>
                                                                    <input name="fname" type="text" id="input-first-name" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-last-name">Last Name</label>
                                                                    <input name="lname" type="text" id="input-last-name" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-email">Email</label>
                                                                    <input name="email" type="email" id="input-email" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-username">Username</label>
                                                                    <input name="username" id="input-username" class="form-control" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pl-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Hotel No.</label>
                                                                    <select name="hotel" class="form-control" required>
                                                                        <option value="">Please Select</option>
                                                                        <?php
                                                                            $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                                            while ($row = mysqli_fetch_assoc($list)) {
                                                                                echo' <option value="'.$row['code'].'">'.$row['code'].'</option>';
                                                                            } 
                                                                        ?>    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-rolename">Role</label>
                                                                    <select name="role" class="form-control" required>'
                                                                        <option value="">Please Select</option>
                                                                        <?php
                                                                            $list = mysqli_query($db,"SELECT * FROM `roles`");
                                                                            while ($row = mysqli_fetch_assoc($list)) {
                                                                                echo' <option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                                            }
                                                                        ?>    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <button type="submit" name="submit" class="btn btn-warning">Add</button>
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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script src="/src/Assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/src/Assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/src/Assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/src/Assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/src/Assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <script src="/src/Assets/vendor/clipboard/dist/clipboard.min.js"></script>
        <script src="/src/Assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>

<?php
    if (isset($_POST['submit'])){
        include 'Function.inc.php';
        require_once '../../Models/Database.inc.php';
        $connect = new Database();
        $admin = new Admin(); 
        $db = $connect->db();

        if ($admin->checkEmailExists($_POST['email'], 0)) {
            echo'
                <script>
                    location.replace("new_user.php?emailexists=true");
                </script>
            ';
        }elseif($admin->checkUsernameExists($_POST['username'], 0)){
            echo'
                <script>
                    location.replace("edit_user.php?usernameexists=true");
                </script>
            ';
        } else {
            $firstName = $_POST['fname'];
            $firstName= ucwords(strtolower($firstName));
            $lastName = $_POST['lname'];
            $lastName= ucwords(strtolower($lastName));

            $username = $_POST['username'];
            $email = $_POST['email'];

            $userhotelno = filter_input(INPUT_POST, 'hotel', FILTER_SANITIZE_STRING);
            $userroleid = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

            $firstName = stripslashes($firstName);
            $firstName = addslashes($firstName);
            $firstName = ucwords(strtolower($firstName));

            $lastName = stripslashes($lastName);
            $lastName = addslashes($lastName);
            $lastName = ucwords(strtolower($lastName));

            $email = stripslashes($email);
            $email = addslashes($email);

            $hotel = $userhotelno;
            $role = $userroleid;

            $admin->createUser($firstName, $lastName, $email, $username, $hotel, $role);
        }
    }

    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("User Create Success!", "User Details Created!", "success");
            </script>
        ';
    
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("User Create Failed!", "Something went wrong!", "error");
            </script>
        '; 
    }
    if(isset($_GET['emailexists'])) {
        echo'
            <script>
                swal("User Create Failed!", "User Email Already exists! Enter new email", "error");
            </script>
        ';
    }
    if(isset($_GET['usernameexists'])) {
        echo'
            <script>
                swal("User Create Failed!", "Username Already exists! Enter new username", "error");
            </script>
        ';
    }
?>