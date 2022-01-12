<?php
    require_once '/vendor/autoload.php';
    require_once '/src/Handlers/constants.php';
    require_once '../../Models/Database.inc.php';

    class Receptionist
    {
        private $db;

        public function addInquiry($customer_id, $room_type_id, $is_ac, $status, $receptionist_id, $checkin, $checkout, $adults, $childs)
        {
            $datetime = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $datetime = $current_date->format("Y-m-d H:i:s");
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("INSERT INTO inquiry (client_ID, rt_ID, inq_AC, inq_Status, rec_ID, inq_checkIn, inq_checkOut, inq_adults, inq_childs, inq_datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $customer_id, $room_type_id, $is_ac, $status, $receptionist_id, $checkin, $checkout, $adults, $childs, $datetime);
            
            if($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("add_inquiry.php?success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("add_inquiry.php?failed=true");
                    </script>
                ';
            }
        }

        public function updateInquiry($inquiry_id, $room_type_id, $is_ac, $status, $receptionist_id, $checkin, $checkout, $adults, $children)
        {
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("UPDATE inquiry SET rt_ID = ?, inq_AC = ?, inq_Status = ?, rec_ID = ?, inq_checkIn = ?, inq_checkOut = ?, inq_adults = ?, inq_childs = ? WHERE inq_ID ='".$inquiry_id."'");
            $stmt->bind_param("ssssssss", $room_type_id, $is_ac, $status, $receptionist_id, $checkin, $checkout, $adults, $children);
            
            if($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("edit_inquiry.php?success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("edit_inquiry.php?failed=true");
                    </script>
                ';
            }
        }

        public function updateAccount($firstName, $lastName, $email, $username, $password, $userid)
        {
            $conn = new Database();
            $db = $conn->db();

            if ($password =="") {
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ? WHERE user_ID ='". $userid ."'");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $username);
            
                if ($stmt->execute()) {
                    $stmt->close();

                    echo'
                        <script>
                            location.replace("settings.php?success=true");
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                            location.replace("settings.php?failed=true");
                        </script>
                    ';
                }
            } else {
                $hashpass = $this->Hash($password);
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ?, password = ? WHERE user_ID ='".$userid."'");
                $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashpass);
            
                if($stmt->execute()) {
                    $stmt->close();
                    echo'
                        <script>
                            location.replace("settings.php?success=true");
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                            location.replace("settings.php?failed=true");
                        </script>
                    ';
                }
            }
        }

        public function checkEmailExists($email, $user_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT user_Email FROM users WHERE user_Email = '$email'");

            if($query->num_rows == 1) {
               $query2 = $db->query("SELECT user_Email FROM user WHERE user_Email ='$email' AND user_ID = '".$user_id."'");

                if($query2->num_rows == 1) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }
        
        public function checkUsernameExists($username, $user_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT user_Username FROM user WHERE user_Username = '$username'");
            if($query->num_rows == 1)
            {
                $query2 = $db->query("SELECT user_Username FROM user WHERE user_Username ='$username' AND user_ID = '".$user_id."'");
                
                if ($query2->num_rows == 1) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }
        
        public function Hash($password)
        {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);
            return $hash_pass;
        }
    }
?>