<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: error' ) );
    }
    require_once '../vendor/autoload.php';
    require_once '../constants.php';
    require_once '../../Models/Database.inc.php';

    class BarHandler
    {
        private $db;

        public function updateAccount($firstName, $lastName, $email, $username, $password, $userid)
        {
            $conn = new Database();
            $db = $conn->db();

            if ($password =="") {
                $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id='".$userid."'");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $username);
                
                if ($stmt->execute())
                {
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
                $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, password = ? WHERE id='".$userid."'");
                $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashPass);
            
                if ($stmt->execute())
                { 
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
            $query = $db->query("SELECT email FROM users WHERE email = '$email'");

            if ($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT email FROM users WHERE email ='$email' AND id = '".$user_id."'");
               if ($query2->num_rows == 1)
               {
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
            if ($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT username FROM users WHERE username ='$username' AND id = '".$user_id."'");
               if ($query2->num_rows == 1)
               {
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

        public function addItem($name, $price, $size, $stock)
        {
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("INSERT INTO liquor_items (name, price, size, stock) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $price, $size, $stock);
            
            if ($stmt->execute())
            { 
                $stmt->close();

                echo'
                <script>
                    location.replace("addItem.php?success=true");
                </script>';
                         
            } else {
                echo'
                <script>
                    location.replace("addLeave.php?failed=true");
                </script>';
            }
        }

        //Item update function
        public function updateItem($name, $price, $size, $stock, $itemid)
        {
            $conn = new Database();
            $db = $conn->db();           
            $stmt = $db->prepare("UPDATE liquor_items SET name = ?, price = ?, size = ?, stock = ? WHERE id='".$itemid."'");
            $stmt->bind_param("ssss", $name, $price, $size, $stock);
            
            if ($stmt->execute())
            {
                $stmt->close();

                echo'
                <script>
                    location.replace("editItem.php?id='.$itemid.'&success=true");
                </script>';
              
            } else {
                echo'
                <script>
                    location.replace("editItem.php?id='.$itemid.'&failed=true");
                </script>';
            }
        }

        public function addExpenditure($bar, $current_date, $amount, $name, $qty, $total, $bartenderid)
        {
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("INSERT INTO bar_expenditure (bar_id, date, amount, item, qty, total, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $bar, $current_date, $amount, $name, $qty, $total, $bartenderid);
            
            if ($stmt->execute())
            { 
                $stmt->close();

                     echo'<script>
                     location.replace("addExpenditure.php?success=true");
                     </script>';
                         
            } else
            {
                echo'<script>
                location.replace("addExpenditure.php?failed=true");
                 </script>';
            }
        }

        public function updateExpenditure($bar, $current_date, $amount, $name, $qty, $total, $bartenderid, $exid)
        {
            $conn = new Database();
            $db = $conn->db();
            $stmt = $db->prepare("UPDATE bar_expenditure SET bar_id = ?, date = ?, amount = ?, item = ?, qty = ?, total = ?, updated_by = ?   WHERE id='".$exid."'");
            $stmt->bind_param("sssssss", $bar, $current_date, $amount, $name, $qty, $total, $bartenderid);
            
            if ($stmt->execute())
            {
                $stmt->close();

                echo'
                <script>
                    location.replace("editExpenditure.php?id='.$exid.'&success=true");
                </script>';
              
            } else {
                echo'
                <script>
                    location.replace("editExpenditure.php?id='.$exid.'&failed=true");
                </script>';
            }
        }
    }
?>