<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // include database and object files
    include_once '../config/Database.php';
    include_once '../models/Day.php';
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare day object
    $day = new Day($db);
    
    // set ID property of record to read
    $day->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    // read the details of day to be edited
    $day->readOne();
    
    if($day->name!=null){
        // create array
        $day_arr = array(
            "id" =>  $day->id,
            "name" => $day->name,
            "description" => $day->description,
            "date" => $day->date
        );
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($day_arr);
    }
    
    else{
        // set response code - 404 Not found
        http_response_code(404);
    
        // tell the user day does not exist
        echo json_encode(array("message" => "Day does not exist."));
    }