<?php
    include "../Models/Database.inc.php";
    require_once "../../vendor/autoload.php";
    require_once '../Handlers/constants.inc.php';

    class Authenticator
    {
        private $db;

        public function __construct()
        {
            $conn = new Database();
            $this->db = $conn->db();
        }
        
        public function login($email, $password)
        {
            $query = $this->db->query("SELECT count('user_ID') AS total, user.user_ID, user.user_Username, user.user_Email, user.user_Password, user.user_AccStatus, user_role.role_ID, role.role_Secret FROM user 
                                            INNER JOIN user_role ON user.user_ID = user_role.user_ID 
                                            INNER JOIN `role` ON user_role.role_ID = role.role_ID
                                            WHERE (user_Username = '$email' OR user_Email = '$email') LIMIT 1");

            while($current_user = $query -> fetch_assoc()) {
                if ($current_user['user_AccStatus'] == 0) {
                    echo '<p class="d-flex justify-content-center links" style="color:red; text-align:center;">Your account is inactivated. Please contact Administration.</p>';
                    die;
                }
                
                if ($current_user['total'] == 1 && $this -> verifyPassword($password, $current_user['user_Password']) == TRUE) {
                    session_start();
                    $_SESSION['id'] = $current_user['user_ID'];
                    $_SESSION['username'] = $current_user['user_Username'];
                    $_SESSION['user_secret'] = $current_user['role_Secret'];
                    $_SESSION['is_logged'] = TRUE;

                    if($current_user['role_Secret'] == 'c56eaf051e59063eac323a11a52ff50d73ad7435') {
                        header("Location: /admin/dashboard");
                    }
                    else if ($current_user['role_Secret'] == '8f69f7bef0f6592cbddb3de0eb707efca94c9100') {
                        header("Location: /reception/dashboard");
                    }
                    else if ($current_user['role_Secret'] == '1b1c9df50fb107e510b219734d95099ec467ff2f') {
                        header("Location: /reservation/dashboard");
                    }
                    else if($current_user['role_Secret'] == 'efc6880119dd022043c5fa395d33598c66ec79ff') {
                        header("Location: /account/dashboard");
                    }
                    else if($current_user['role_Secret'] == '7894eecc71d998d2eedd5522816a25b282752eec') {
                        header("Location: /hr/dashboard");
                    }
                    else if($current_user['role_Secret'] == 'be882d21e7a861094e65f6c509360b0cca9eadc0') {
                        header("Location: /hotelbar/dashboard");
                    }
                    else if($current_user['role_Secret'] == 'b44dee55ec976b5792aa82b5df830587818648b2') {
                        header("Location: /management/dashboard");
                    } else {
                        // redirect to 404 or something
                        header("Location: /error");
                        die;
                    }
                }
                else {
                    echo '<p class="d-flex justify-content-center links" style="color:red; text-align:center;">Invalid user credentials.</p>';
                }
            }
        }

        public function verifyPassword($password, $enc_password)
        {
            if(password_verify($password, $enc_password)) return TRUE;
        }

        public function userEmailExists($email)
        {
            $query = $this->db->query("SELECT email FROM user WHERE email = '$email'");
            if($query->num_rows == 1) {
                return TRUE;
            }
            else return FALSE;
        }

        public function sendPasswordResetLink($email)
        {
            $key = md5(time().$email);
            $date = new DateTime;
            $date = $date->format("Y-m-d H:i:s");
            $exp_date = date('Y-m-d H:i:s', strtotime('+1 hours', strtotime($date)));

            if($this->db->query("INSERT INTO `password_reset_temp`(`email`, `email_key`, `exp_date`) VALUES ('$email', '$key', '$exp_date')")) {
                try {
                    $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                        ->setUsername(MAIL_USERNAME)
                        ->setPassword(MAIL_PASSWORD);
                
                    $mailer = new Swift_Mailer($transport);
                    $message = new Swift_Message();
                
                    $message->setSubject('Password Reset Link');
                    $message->setFrom(['noreply@lakderena.com' => 'Lakderena Hotel Chain']);
                    $message->addTo($email);
                    
                    $message->setBody('Please click the link to reset your password');
                    $message->addPart('Please click the link to reset your password: <a href="http://localhost:8080/resetpassword?token='. $key .'&email='. $email .'">Reset Password</a>', 'text/html');
                    
                    $result = $mailer->send($message);
                } catch (Exception $ex) {
                    echo $e->getMessage();
                }
                return TRUE;
            }
            else return FALSE;
        }

        public function validatePasswordRestLink($token, $email)
        {
            $query = $this->db->query("SELECT exp_date FROM password_reset_temp WHERE email_key = '$token' AND email = '$email'");
            if($query->num_rows == 1) {
                $date = new DateTime;
                $date = $date->format("Y-m-d H:i:s");
        
                while($current_user = $query->fetch_assoc()) {
                    if($date < $current_user['exp_date']) {
                        return TRUE;
                    }
                }
            }
            else return FALSE;
        }

        public function resetPassword($email, $password)
        {
            $enc_password = $this->Hash($password);

            if($this->db->query("UPDATE user SET user_Password = '$enc_password' WHERE user_Email = '$email'")) {
                return TRUE;
            }
            else {
                echo $this->db->error;
            }
        }

        public function Hash($password)
        {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);
            return $hash_pass;
        }
    }
?>