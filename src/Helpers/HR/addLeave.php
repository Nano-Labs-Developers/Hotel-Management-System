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
                                        <li class="breadcrumb-item active" aria-current="page">Add Leave</li>
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
                                <h3 class="mb-0">Add Leave</h3>
                            </div>
                            <div class="card-body">
                                <div class="row icon-examples">
                                    <?php 
                if (isset($_GET['id'])){
                  
                   $employeeid = $_GET['id'];

                    if ( is_numeric($employeeid) == true){
                       require_once '../../Models/Database.inc.php';
                    try{

                       $conn = new Database();
                       $db = $conn->db();
                       
                        $employeeid = mysqli_real_escape_string($db, $_GET['id']);
                        $query = "
                        SELECT * FROM employees 
                        WHERE id = '".$employeeid."'
                        ";

                        $result = mysqli_query($db, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                    

                        while($row = mysqli_fetch_array($result)){

                                    $empid = $row['id'];
                                    $firstname=$row['first_name'];
                                    $lastname=$row['last_name'];
                                    $email=$row['email'];
                                    $address = $row['address'];
                                    $mobile = $row['mobile'];
                                    $job_role_id = $row['job_role_id'];
                                    $hotel_no = $row['hotel_no'];

                         

                             echo'
                            <div class="col-xl-12 order-xl-1">
                                    <div class="card">
                                            <div class="card-header">
                                            <div class="row align-items-center">
                                            </div>
                                                <div class="card-body">
                                                        <form name="employeeRegForm" action="" method="post" onsubmit="return validateForm()">
                                                                <h6 class="heading-small text-muted mb-4">Employee information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-email">Email address</label>
                                                                                <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                                                <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                                                <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                
                                                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="input-address">Address</label>
                                                                            <input name="address" id="input-address" class="form-control" value="'.$address.'" type="text" readonly>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label">Mobile</label>
                                                                                <input name="mobile" type="text" id="phone" class="phone form-control" value="'.$mobile.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                
                                                                <h6 class="heading-small text-muted mb-4">Job information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-address">Job Role</label>
                                                                                    <select name="job_roles" class="form-control" readonly>';?>
                                    <!--select job type -->
                                    <?php
                                                                                            require_once '../../Models/Database.inc.php';
                                                                                            $conn = new Database();
                                                                                            $db = $conn->db();
                                                                                            $list = mysqli_query($db,"SELECT * FROM `job_roles`");
                                                                                            while ($row = mysqli_fetch_assoc($list)) 
                                                                                            {
                                                                                                if ($job_role_id == $row['id'] )
                                                                                                    {
                                                                                                        echo' <option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                                                                                                    }
                                                                                            }
                                                                                            $db = null;
                                                                                        ?>
                                        <?php echo'</select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-address">Hotel</label>
                                                                                    <select name="hotel" class="form-control" readonly>';?>
                                        <!--select hotel -->
                                        <?php
                                                                                            require_once '../../Models/Database.inc.php';
                                                                                            $conn = new Database();
                                                                                            $db = $conn->db();
                                                                                            $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                                                            while ($row = mysqli_fetch_assoc($list)) 
                                                                                            {
                                                                                               if ($hotel_no == $row['code'] )
                                                                                                    {
                                                                                                        echo' <option value="'.$row['code'].'" selected>'.$row['name'].'</option>';
                                                                                                    }
                                                                                            } 
                                                                                        ?>
                                            <?php echo' </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                
                                                                <h6 class="heading-small text-muted mb-4">Enter Leave Information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">';?>
                                            <?php
                                                                            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                                                            $current_date = $current_date->format("Y-m-d");
                                                                            $date_to = date('Y-m-d', strtotime($current_date . ' +1 day'));

                                                                            echo' <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                    <label for="example-datetime-local-input" class="form-control-label">Date From</label>
                                                                                    <input name="fromDate" class="form-control" type="date" value="'.$current_date.'" id="example-datetime-local-input">
                                                                                    </div> 
                                                                                </div> 

                                                                            <div class="col-lg-6">
                                                                                 <div class="form-group">
                                                                                    <label for="example-datetime-local-input" class="form-control-label">Date To</label>
                                                                                    <input name="toDate" class="form-control" type="date" value="'.$date_to.'" id="example-datetime-local-input">
                                                                                 </div> 
                                                                            </div>     
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                              <div class="form-group">
                                                                                    <label for="exampleFormControlTextarea1">Enter Reason for Leave</label>
                                                                                    <textarea name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3" required=""></textarea>
                                                                              </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                    
                                                            </div>
                                                        </form>
                                                </div>
                            </div>
                        </div>
                    </div>';
                     $db = null;
                     }
                  }else{

                              echo '<center>Sorry No Employee Record Found!!</center>';
                          }

                           //Close the connection to the database.
                              $db = null;
                 }
                 catch(Exception $e){
                      http_response_code(500);
                      die('Error establishing connection with database');
                    }
                   }else{
                
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

                <?php include "../../Components/Admin/Footer.php" ?>
            </div>
        </div>

        <!---------------------------- Update process ------------------------------>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php

if (isset($_POST['submit']))
{   
    $toDate = $_POST['toDate']; 
    $fromDate = $_POST['fromDate'];

    if($fromDate <= $toDate)
    {
        include 'Employee.php';

        //create new instance from Employee class
        $employee = new Employee(); 

        $reason= $_POST['reason'];
        
        $earlier = new DateTime($toDate);
        $later = new DateTime($fromDate);

        //calculate total days
        $total_days = $later->diff($earlier)->format("%a"); 

        

        $hrid = $_SESSION['id'];

        $employee->addLeave($employeeid, $fromDate, $toDate, $total_days, $reason, $hrid);

    }else{
        echo'<script>
                 swal("Failed!", "Selected [Date To] larger than [Date From]!", "error");
                </script>';
    }

}

?>

            <!--------------------- Update process end ------------------------>



            <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>




            <script>
                $('input[name="duration"]').mask('0000000000');
            </script>





            <?php 

if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Success!", "Employee Leave Added Success!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal(" Failed!", "Something went wrong!", "error");
                </script>';
             
          }


 ?>



            <script src="/src/Lib/vendor/jquery/dist/jquery.min.js"></script>
            <script src="/src/Lib/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="/src/Lib/vendor/js-cookie/js.cookie.js"></script>
            <script src="/src/Lib/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
            <script src="/src/Lib/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

            <script src="/src/Lib/vendor/clipboard/dist/clipboard.min.js"></script>

            <script src="/Assets/js/argon.js?v=1.2.0"></script>
    </body>

    </html>