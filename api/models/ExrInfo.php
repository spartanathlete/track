<?php
    /**
        *contains properties and methods for "exrInfo" database queries.
    */
    class ExrInfo {

        //DB connection and table
        private $conn;
        private $table_name = 'exrs_info';

        //Object properties
        public $id;
        public $reps;
        public $sets;
        public $weight;
        public $exr_id;
        public $date;

        //Constructor with db conn
        public function __construct($db) {
            $this->conn = $db;
        }

        //Create exrInfo
        function create() {
            // query to insert record
            $query = "insert into " . $this->table_name . " set reps=:reps, sets=:sets, weight=:weight, exr_id=:exr_id, date=:date";
            
            // prepare query
            $stmt = $this->conn->prepare($query);
            
            // sanitize
            $this->reps=htmlspecialchars(strip_tags($this->reps));
            $this->sets=htmlspecialchars(strip_tags($this->sets));
            $this->weight=htmlspecialchars(strip_tags($this->weight));
            $this->exr_id=htmlspecialchars(strip_tags($this->exr_id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            
            // bind values
            $stmt->bindParam(":reps", $this->reps);
            $stmt->bindParam(":sets", $this->sets);
            $stmt->bindParam(":weight", $this->weight);
            $stmt->bindParam(":exr_id", $this->exr_id);
            $stmt->bindParam(":date", $this->date);
            
            // execute query
            if($stmt->execute()){
                return true;
            }
            
            return false;
        }

        //Read exrInfo
        function read(){

            //select all
            $query = "select * from " . $this->table_name;

            //prepare
            $stmt = $this->conn->prepare($query);

            //execute
            $stmt->execute();

            return $stmt;

        }

        //update exrInfo
        function update(){

            //update query
            $query = "update " . $this->table_name . " set reps=:reps, sets=:sets, weight=:weight, exr_id=:exr_id where id=:id";

            //prepare
            $stmt = $this->conn->prepare($query);

            //sanitize
            $this->reps=htmlspecialchars(strip_tags($this->reps));
            $this->sets=htmlspecialchars(strip_tags($this->sets));
            $this->weight=htmlspecialchars(strip_tags($this->weight));
            $this->exr_id=htmlspecialchars(strip_tags($this->exr_id));
            $this->id=htmlspecialchars(strip_tags($this->id));

            //bind new values
            $stmt->bindParam(':reps', $this->reps);
            $stmt->bindParam(':sets', $this->sets);
            $stmt->bindParam(':weight', $this->weight);
            $stmt->bindParam(':exr_id', $this->exr_id);
            $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }

            return false;
        }

        //delete exrInfo
        function delete(){

            //delete query
            $query = "delete from " . $this->table_name . " where id = ?";

            //prepare
            $stmt = $this->conn->prepare($query);

            //sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));

            //bind id
            $stmt->bindParam(1, $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }

            return false;
        }
    }
