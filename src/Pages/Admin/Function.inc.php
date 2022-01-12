<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: error' ) );
    }

    require_once '../../../vendor/autoload.php';
    require_once '../constants.php';
    require_once '../Models/Database.inc.php';

    class Admin
    {
        private $db;

        public function updateAccount($firstName, $lastName, $email, $username, $password, $userid)
        {
            $conn = new Database();
            $db = $conn->db();

            if ($password =="") {
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ? WHERE `user_ID`='". $userid ."'");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $username);
            
                if ($stmt->execute()) {
                    $stmt->close();

                    echo'
                    <script>
                        location.replace("settings.php?success=true");
                    </script>';
                } else {
                    echo'
                    <script>
                        location.replace("settings.php?failed=true");
                    </script>';
                }
            } else {
                $hashPass = $this->Hash($password);
                $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ?, password = ? WHERE `user_ID`='". $userid ."'");
                $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashPass);
                
                if ($stmt->execute()) {
                    $stmt->close();

                    echo'
                    <script>
                        location.replace("settings.php?success=true");
                    </script>';
                } else {
                    echo'
                    <script>
                        location.replace("settings.php?failed=true");
                    </script>';
                }
            }
        }

        public function checkEmailExists($email, $user_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT user_Email FROM user WHERE user_Email = '$email'");

            if ($query->num_rows == 1) {
                $query2 = $db->query("SELECT user_Email FROM user WHERE user_Email ='$email' AND `user_ID` = '". $user_id ."'");

                if ($query2->num_rows == 1) {
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

            if ($query->num_rows == 1) {
                $query2 = $db->query("SELECT user_Username FROM user WHERE user_Username ='$username' AND `user_ID` = '". $user_id ."'");

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

        public function updateUser($firstName, $lastName, $email, $username, $hotel, $role, $user_id, $active_status)
        {
            $conn = new Database();
            $db = $conn->db();

            $stmt = $db->prepare("UPDATE user SET user_FName = ?, user_LName = ?, user_Email = ?, user_Username = ?, hotel_no = ?, user_AccStatus = ? WHERE `user_ID`='". $user_id ."'");
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $username, $hotel, $active_status);
        
            if ($stmt->execute()) {
                $stmt->close();
                $stmt = $db->prepare("UPDATE role_users SET role_id = ? WHERE user_id='". $user_id ."'");
                $stmt->bind_param("s", $role);

                if ($stmt->execute()) {
                    $stmt->close();
                }

                echo'
                    <script>
                        location.replace("edit_user.php?id='. $user_id .'&success=true");
                    </script>
                ';
            } else {
                echo'<script>
                        location.replace("edit_user.php?id='. $user_id .'&failed=true");
                    </script>';
            }
        }

        public function createUser($firstName, $lastName, $email, $username, $hotel, $role)
        {
            $conn = new Database();
            $db = $conn->db();

            $password = $this->random_strings(8);
            $hashPass = $this->Hash($password);
            $current_date_time = date("Y-m-d H:i:s");

            $stmt = $db->prepare("INSERT INTO user (user_FName, user_LName, user_Email, user_Username, password, hotel_no, created_at) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $username, $hashPass, $hotel, $current_date_time);
            
            if ($stmt->execute()) {
                $role_userid = $stmt->insert_id;

                $stmt1 = $db->prepare("INSERT INTO role_users (role_id, user_id) VALUES (?,?)");
                $stmt1->bind_param("ss", $role, $role_userid);

                if ($stmt1->execute()) {
                    $stmt1->close();
                    $stmt->close();
                }

                $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                    ->setUsername(MAIL_USERNAME)
                    ->setPassword(MAIL_PASSWORD);
        
                $mailer = new Swift_Mailer($transport);
                $message = new Swift_Message();

                $message->setSubject('New User Account Created');
                $message->setFrom(['noreply@lakderena.com' => 'Lakderena Hotel Chain']);
                $message->addTo($email);
                $message->addPart('Your account credentials as below: <br /><br />Please visit: <a href="http://lakderena.com/">http://lakderena.com/</a><br />Username: ' . $username . '<br />Email: ' . $email . '<br />Temp Password: ' . $password .'<br /><br />Thanks,<br />Lakderena Hotel Chain', 'text/html');
                
                $result = $mailer->send($message);

                echo'
                    <script>
                        location.replace("new_user.php?success=true");
                    </script>
                ';
            } else {
                echo'
                    <script>
                        location.replace("new_user.php?failed=true");
                    </script>
                ';
            }
        }

        public function random_strings($length_of_string)
        {
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            return substr(str_shuffle($str_result), 0, $length_of_string);
        }

        public function checkHotelCodeExists($code, $hotel_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT hotel_Code FROM hotel WHERE hotel_Code = '$code'");

            if ($query->num_rows == 1) {
                $query2 = $db->query("SELECT hotel_Code FROM hotel WHERE hotel_Code ='$code' AND hotel_ID = '". $hotel_id ."'");

                if ($query2->num_rows == 1) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }

        public function updateHotel($name, $code, $address, $phone, $hotel_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("UPDATE hotel SET name = ?, hotel_Code = ?, address = ?, hotel_Contact = ? WHERE hotel_ID ='". $hotel_id ."'");
            $stmt->bind_param("ssss", $name, $code, $address, $phone);
        
            if ($stmt->execute()) {
                $stmt->close();
                echo'
                    <script>
                        location.replace("edit_hotel.php?id='.$hotel_id.'&success=true");
                    </script>
                    ';
            } else {
                echo'
                    <script>
                        location.replace("edit_hotel.php?id='.$hotel_id.'&failed=true");
                    </script>
                ';
            }
        }
    }
?>