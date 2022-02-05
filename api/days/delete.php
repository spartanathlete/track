<?php

    //Req headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset:UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //Req includes
    include_once '../config/Database.php';
    include_once '../models/Day.php';

    //Db conn and instances
    $database = new Database();
    $db=$database->getConnection();

    $day = new Day($db);

    //Get post data
    $data = json_decode(file_get_contents("php://input"));

    //set Id of product to be deleted
    $day->id = $data->id;

    //delete product
    if ($day->delete()) {
        // set response code - 200 ok
        http_response_code(200);
        
        // tell the user
        echo json_encode(array("message" => "Day was deleted."));
    } else {    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Unable to delete day."));
    }