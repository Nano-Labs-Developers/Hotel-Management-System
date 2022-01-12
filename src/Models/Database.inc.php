<?php
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location: error' ) );
    }

    class Database
    {
        private $server = "localhost";
        private $username = "root";
        private $pass = "";
        private $db = "hotelsys";

        public function db()
        {
            $conn = new mysqli($this->server, $this->username, $this->pass, $this->db);

            if($conn->connect_errno)
            {
                die("DB:01 - Connection Failed".$conn->connect_errno);
            }
            return $conn;
        }
    }
?>
