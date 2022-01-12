<?php
    require_once '../vendor/autoload.php';
    require_once '../../Handlers/constants.php';
    require_once '../../Models/Database.inc.php';
    
    class Employee
    {
        private $db;

        public function registerEmployee($firstName, $lastName, $email, $address, $mobile, $hotel_code, $job_role_id)
        {
            $db = $conn->db();
            $conn = new Database();
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d H:i:s");
            $stmt = $db->prepare("INSERT INTO employees (first_name, last_name, email, address, mobile, hotel_no, job_role_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $address, $mobile, $hotel_code, $job_role_id, $current_date);
            
            if ($stmt->execute()) { 
                $stmt->close();
                echo'
                    <script>
                        location.replace("addEmployee.php?registration=success");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("addEmployee.php?failed=true");
                    </script>
                ';
            }
        }

        public function addLeave($employeeid, $fromDate, $toDate, $total_days, $reason, $hrid)
        {
            $db = $conn->db();
            $conn = new Database();
            $stmt = $db->prepare("INSERT INTO leaves (employee, date_from, date_to, total_days, reason, updated_by) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $employeeid, $fromDate, $toDate, $total_days, $reason, $hrid);
            
            if ($stmt->execute()) { 
                $stmt->close();
                echo'
                    <script>
                        location.replace("addLeave.php?id='.$employeeid.'&success=true");
                    </script>
                ';
                         
            } else {
                echo'
                    <script>
                        location.replace("addLeave.php?id='.$employeeid.'&failed=true");
                    </script>
                ';
            }
        }

        public function employeeEmailExists($email)
        {
            $db = $conn->db();
            $conn = new Database();
            $query = $db->query("SELECT email FROM employees WHERE email = '$email'");

            if ($query->num_rows == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }

        public function checkEmailExists($email, $emp_id)
        {
            $db = $conn->db();
            $conn = new Database();
            $query = $db->query("SELECT email FROM employees WHERE email = '$email'");

            if ($query->num_rows == 1) {
                $query2 = $db->query("SELECT email FROM employees WHERE email ='$email' AND id = '".$emp_id."'");

                if($query2->num_rows == 1) {
                    return FALSE;

                } else {
                    return TRUE;
                }

            }else{

                return FALSE;
            }
        }
        
        public function updateEmployee($firstName, $lastName, $email, $address, $mobile, $hotel_no, $job_role_id, $empid)
        {
            $db = $conn->db();
            $conn = new Database();
            $stmt = $db->prepare("UPDATE employees SET first_name = ?, last_name = ?, email = ?, address = ?, mobile = ?, hotel_no = ?, job_role_id = ? WHERE id='".$empid."'");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $address, $mobile, $hotel_no, $job_role_id);
            
            if ($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("editEmployee.php?id='.$empid.'&success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("editEmployee.php?id='.$empid.'&failed=true");
                    </script>
                ';
            }
        }

        public function updateAttendance($attendDate, $is_present_status, $duration, $hrid, $attendanceid)
        {
            $db = $conn->db();
            $conn = new Database();
            $stmt = $db->prepare("UPDATE attendance SET date = ?, is_present = ?, duration = ?, updated_by = ? WHERE id='".$attendanceid."'");
            $stmt->bind_param("ssss", $attendDate, $is_present_status, $duration, $hrid);
            
            if ($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("editAttendance.php?id='.$attendanceid.'&success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("editAttendance.php?id='.$attendanceid.'&failed=true");
                    </script>
                ';
            }
        }

        public function updateLeave($fromDate, $toDate, $total_days, $reason, $hrid, $leaveid)
        {
            $db = $conn->db();
            $conn = new Database();
            $stmt = $db->prepare("UPDATE leaves SET date_from = ?, date_to = ?, total_days = ?, reason = ?, updated_by = ? WHERE id='".$leaveid."'");
            $stmt->bind_param("sssss", $fromDate, $toDate, $total_days,$reason, $hrid);
            
            if ($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("editLeave.php?id='.$leaveid.'&success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("editLeave.php?id='.$leaveid.'&failed=true");
                    </script>
                ';
            }
        }
    }
?>