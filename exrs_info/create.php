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
    $db=$database->getConnection();

    $exrInfo = new ExrInfo($db);

    //Get post data
    $data = json_decode(file_get_contents("php://input"));

    //set exrInfo values
    $exrInfo->name = $data->name;
    $exrInfo->description = $data->description;
    $exrInfo->date = date('Y-m-d');

    //Create exrInfo
    if ($exrInfo->create()) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "ExrInfo was created."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create exrInfo."));
    }