<?php
    include_once 'constants.php';
    class Database {

        //DB Params (all private)
        private $conn;

        //Connection (try) function
        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO(DSN, DB_USER, DB_PASS);
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }