<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: error' ) );
    }
    require_once '../../../vendor/autoload.php';
    require_once '../../Handlers/constants.php';
    require_once '../../Models/Database.php';

    class Accountant
    {
        private $db;

        public function updateAccount($firstName, $lastName, $email, $username, $password, $userID)
        {
            $conn = new Database();
            $db = $conn->db();

            if ($password == "") {
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ? WHERE user_ID='". $userID ."'");
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
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ?, password = ? WHERE user_ID='". $userID ."'");
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

        public function checkEmailExists($email, $userID)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT user_Email FROM user WHERE user_Email = '$email'");

            if($query->num_rows == 1) {
                $query2 = $db->query("SELECT user_Email FROM user WHERE user_Email ='$email' AND id = '". $userID ."'");
                
                if($query2->num_rows == 1) {
                    return FALSE;

                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }
        
        public function checkUsernameExists($username, $userID)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT user_Username FROM user WHERE user_Username = '$username'");

            if($query->num_rows == 1) {
                $query2 = $db->query("SELECT user_Username FROM user WHERE user_Username ='$username' AND userID = '". $userID ."'");
                
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