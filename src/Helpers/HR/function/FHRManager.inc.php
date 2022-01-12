<?php
    require_once '../vendor/autoload.php';
    require_once '../../Handlers/constants.php';
    require_once '../../Models/Database.inc.php';

    class HRManager
    {
        private $db;

        public function updateAccount($firstName, $lastName, $email, $username, $password, $userid)
        {
            $conn = new Database();
            $db = $conn->db();

            if ($password =="") {
                $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id='".$userid."'");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $username);
            
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
            } else {
                $hashPass = $this->Hash($password);
                $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, password = ? WHERE id='".$userid."'");
                $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashPass);
            
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
            $query = $db->query("SELECT email FROM users WHERE email = '$email'");

            if($query->num_rows == 1) {
               $query2 = $db->query("SELECT email FROM users WHERE email ='$email' AND id = '".$user_id."'");
               
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
            $query = $db->query("SELECT username FROM users WHERE username = '$username'");

            if($query->num_rows == 1) {
                $query2 = $db->query("SELECT username FROM users WHERE username ='$username' AND id = '".$user_id."'");
                if($query2->num_rows == 1) {
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