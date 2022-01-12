<?php
    require_once '../vendor/autoload.php';
    require_once '../constants.php';
    require_once '../../Models/Database.inc.php';

    class Client
    {
        private $db;

        public function registerClient($firstName, $lastName, $email, $address, $mobile)
        {
            $conn = new Database();
            $db = $conn->db();

            $stmt = $db->prepare("INSERT INTO customers (first_name, last_name, email, address, mobile) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $address, $mobile);
            
            if($stmt->execute()) {
                $stmt->close();
                $checkClients = $db->query("SELECT count('id') AS total FROM customers ");

                while($allClients = $checkClients->fetch_assoc()) {
                    if($allClients['total'] >= 1) {
                        $getLastClient = $db->query("SELECT * FROM customers ORDER BY id DESC LIMIT 1");
                        
                        while($customerDetails = $getLastClient->fetch_assoc()) {
                            $cus_id= $customerDetails['id'];
                            $cus_mobile = $customerDetails['mobile'];
                            $stmt2 = $db->prepare("INSERT INTO customer_mobile (customer_id, normalized_phone) VALUES (?, ?)");
                            $stmt2->bind_param("ss", $cus_id, $cus_mobile);

                            if($stmt2->execute()) {
                                $stmt2->close();
                                echo'
                                    <script>
                                        location.replace("add_inquiry.php?customer='.$cus_id.'&registration=success");
                                    </script>
                                ';
                            } else {
                                echo'
                                    <script>
                                        location.replace("customer_registration.php?failed=true");
                                    </script>
                                ';
                            }
                        }
                    }
                }
            } else {
                echo'
                    <script>
                        location.replace("customer_registration.php?failed=true");
                    </script>
                ';
            }
        }

        public function customerEmailExists($email)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM customers WHERE email = '$email'");

            if($query->num_rows == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }

        public function regClientEmailExists($email, $cus_id)
        {
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM customers WHERE email = '$email'");

            if($query->num_rows == 1) {
                $query2 = $db->query("SELECT email FROM customers WHERE email ='$email' AND id = '".$cus_id."'");
               
                if($query2->num_rows == 1) {
                    return FALSE;

                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }

        public function updateClient($firstName, $lastName, $email, $address, $mobile, $cusid)
        {
            $conn = new Database();
            $db = $conn->db();

            $stmt = $db->prepare("UPDATE customers SET first_name = ?, last_name = ?, email = ?, address = ?, mobile = ? WHERE id='".$cusid."'");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $address, $mobile);
            
            if($stmt->execute()) {
                $stmt->close();
                $stmt2 = $db->prepare("UPDATE customer_mobile SET normalized_phone = ? WHERE customer_id='".$cusid."'");
                $stmt2->bind_param("s", $mobile);

                if($stmt2->execute()) {
                    $stmt2->close();
                    echo'
                        <script>
                            location.replace("edit_customer.php?id='.$cusid.'&success=true");
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                            location.replace("edit_customer.php?id='.$cusid.'&failed=true");
                        </script>
                    ';
                }
            } else {
                echo'
                    <script>
                        location.replace("edit_customer.php?id='.$cusid.'&failed=true");
                    </script>
                ';
            }
        }
    }
?>