<?php

    //Req headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset:UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    //Req includes
    include_once '../config/Database.php';
    include_once '../models/ExrInfo.php';

    //Db conn and instances
    $database = new Database();
    $db = $database->getConnection();

    $exrInfo = new ExrInfo($db);

    //Get post data
    $data = json_decode(file_get_contents("php://input"));

    //set Id and values of exrInfo to be edited
    $exrInfo->id = $data->id;
    $exrInfo->reps = $data->reps;
    $exrInfo->sets = $data->sets;
    $exrInfo->weight = $data->weight;
    $exrInfo->exr_id = $data->exr_id;

    //update exrInfo
    if ($exrInfo->update()){

        // set response code - 200 ok
        http_response_code(200);
    
        // tell the user
        echo json_encode(array("message" => "ExrInfo was updated."));
    } else {
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Unable to update exrInfo."));
    }