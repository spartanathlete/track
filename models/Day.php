<?php
    /**
        *contains properties and methods for "day" database queries.
    */
    class Day {

        //DB connection and table
        private $conn;
        private $table_name = 'days';

        //Object properties
        public $id;
        public $name;
        public $description;
        public $date;

        //Constructor with db conn
        public function __construct($db) {
            $this->conn = $db;
        }

        //Create day
        function create() {
            // query to insert record
            $query = "insert into " . $this->table_name . " set name=:name, description=:description, date=:date";
            
            // prepare query
            $stmt = $this->conn->prepare($query);
            
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->date=htmlspecialchars(strip_tags($this->date));
            
            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":date", $this->date);
            
            // execute query
            if($stmt->execute()){
                return true;
            }
            
            return false;
        }

        //Read day
        function read(){

            //select all
            $query = "select * from " . $this->table_name;

            //prepare
            $stmt = $this->conn->prepare($query);

            //execute
            $stmt->execute();

            return $stmt;

        }

        //update day
        function update(){

            //update query
            $query = "update " . $this->table_name . " set name=:name, description=:description, date=:date where id=:id";

            //prepare
            $stmt = $this->conn->prepare($query);

            //sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->id=htmlspecialchars(strip_tags($this->id));

            //bind new values
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }

            return false;
        }

        //delete day
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
