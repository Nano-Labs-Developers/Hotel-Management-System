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
                                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                <h3 class="mb-0">Edit User Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                                        if (isset($_GET['id'])) { 
                                            $userid = $_GET['id'];

                                            if (is_numeric($userid) == true) {
                                                require_once '../../Models/Database.inc.php';

                                                try {
                                                    $connect = new Database();
                                                    $db = $connect->db();
                                                    $userid = mysqli_real_escape_string($db, $_GET['id']);
                                                    $query = "SELECT user.*, user_role.role_ID AS role_ID, `role.role_Name` AS `role_Name`
                                                                    FROM user
                                                                    INNER JOIN user_role ON user.user_ID = user_role.user_ID
                                                                    INNER JOIN role ON user_role.role_ID = role.role_ID
                                                                    WHERE user.user_ID = '".$userid."'";
                                                    $result = mysqli_query($db, $query);
                                                    
                                                    if(mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_array($result)){
                                                            $id = $row['user_ID'];
                                                            $firstname=$row['user_FName'];
                                                            $lastname=$row['user_LName'];
                                                            $email=$row['user_Email'];
                                                            $username = $row['user_Username'];
                                                            $hotel_no = $row['hotel_no'];
                                                            $role_id = $row['role_ID'];
                                                            $role = $row['role_Name'];
                                                            $active_status = $row['user_AccStatus'];

                                                            echo'                        
                                                                <div class="col-xl-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <div class="row align-items-center">
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form name="userUpdateForm" action="" method="post">
                                                                                <div class="pl-lg-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label">ID</label>
                                                                                                <input name="id" type="text" class="form-control" value="'.$id.'" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-email">Email</label>
                                                                                                <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-first-name">First Name</label>
                                                                                                <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-last-name">Last Name</label>
                                                                                                <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="pl-lg-4">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-username">Username</label>
                                                                                                <input name="username" id="input-username" class="form-control" value="'.$username.'" type="text" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label">Hotel No.</label>
                                                                                                <select name="hotel" class="form-control" required>';
                                                                                                    ?>
                                                                                                    <?php
                                                                                                        $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                                                                        while ($row = mysqli_fetch_assoc($list)) {
                                                                                                            if ($row['hotel_Code'] == $hotel_no) {
                                                                                                                echo' <option value="'.$row['hotel_Code'].'" selected="selected">'.$row['hotel_Code'].'</option>';
                                                                                                            } else {
                                                                                                                echo' <option value="'.$row['hotel_Code'].'">'.$row['hotel_Code'].'</option>';
                                                                                                            }
                                                                                                        }
                                                                                                    ?>    
                                                                                                    <?php echo'
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label" for="input-rolename">Role</label>
                                                                                                <select name="role" class="form-control" required>';?>
                                                                                                    <?php
                                                                                                        $list = mysqli_query($db,"SELECT * FROM `role`");
                                                                                                        while ($row = mysqli_fetch_assoc($list)) {
                                                                                                            if ($row['id'] == $role_id){
                                                                                                                echo' <option value="'.$row['role_ID'].'" selected="selected">'.$row['role_Name'].'</option>';
                                                                                                            }else{
                                                                                                                echo' <option value="'.$row['role_ID'].'">'.$row['role_Name'].'</option>';
                                                                                                            }
                                                                                                        }
                                                                                                    ?>    
                                                                                                    <?php echo'
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>                  
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label">Active</label>
                                                                                                <br/>
                                                                                                <label class="custom-toggle">
                                                                                                    <input name="useractivestatus" type="checkbox"';?><?php echo ($active_status==1 ? 'checked' : '');?> <?php echo'>
                                                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
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
                                                            $db = null;
                                                        }
                                                    } else {
                                                        echo '<center>Sorry No User Found!!</center>';
                                                    }
                                                    $db = null;

                                                } catch(Exception $ex){
                                                    http_response_code(500);
                                                    die('Error establishing connection with database');
                                                }
                                            } else {
                                                http_response_code(400);
                                                die('Error processing bad or malformed request');
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

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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
        include 'Admin.php';

        $admin = new Admin(); 
        $user_id = $_POST['id'];
        
        if ($admin->checkEmailExists($_POST['email'], $user_id)) {
            echo'
            <script>
                location.replace("/admin/users/editusers?id='.$user_id.'&emailexists=true");
            </script>';
        }
        else if($admin->checkUsernameExists($_POST['username'], $user_id)){
            echo'
            <script>
                location.replace("/admin/users/editusers?id='.$user_id.'&usernameexists=true");
            </script>';
        }
        else {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            
            $userhotelno = filter_input(INPUT_POST, 'hotel', FILTER_SANITIZE_STRING);
            $userroleid = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

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

            $hotel = $userhotelno;
            $role = $userroleid;
            $is_active = $_POST['useractivestatus'];

            if ($is_active == "on") {
                $active_status = 1;
            } else {
                $active_status = 0;
            }

            $admin->updateUser($firstName, $lastName, $email, $username, $hotel, $role, $user_id, $active_status);
        }
    }

    if(isset($_GET['success'])) {
        echo'
            <script>
                swal("User Updated Success!", "User Details Updated!", "success");
            </script>
        ';
    }
    if(isset($_GET['failed'])) {
        echo'
            <script>
                swal("User Update Failed!", "Something went wrong!", "error");
            </script>
        '; 
    }
    if(isset($_GET['emailexists'])) {
        echo'
            <script>
                swal("User Update Failed!", "User Email Already exists! Enter new email", "error");
            </script>
        ';
    }
    if(isset($_GET['usernameexists'])) {
        echo'
            <script>
                swal("User Update Failed!", "Username Already exists! Enter new username", "error");
            </script>
        ';
    }
?>