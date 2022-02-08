<?php

    //Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //Include db and object
    include_once '../config/Database.php';
    include_once '../models/ExrInfo.php';

    //New instances
    $database = new Database();
    $db = $database->getConnection();
    $exr_info = new ExrInfo($db);

    
    // set ID property of record to read
    $exr_info->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Query exrs_info
    $stmt = $exr_info->read__();
    $num = $stmt->rowCount();

    //Check if more than 0 record found
    if($num > 0){

        //exrs_info array
        $exrs_info_arr = array();
        $exrs_info_arr["records"] = array();

        //retrieve table content
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);

            $exr_info_item = array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "day_id" => $day_id
            );

            array_push($exrs_info_arr["records"], $exr_info_item);
        }

        echo json_encode($exrs_info_arr);
    } else {
        echo json_encode(
            array("messege" => "No exrs_info found.")
        );
    }