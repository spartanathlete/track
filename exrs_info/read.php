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
    $exrInfo = new ExrInfo($db);

    //Query exrsInfo
    $stmt = $exrInfo->read();
    $num = $stmt->rowCount();

    //Check if more than 0 record found
    if($num > 0){

        //exrsInfo array
        $exrsInfo_arr = array();
        $exrsInfo_arr["records"] = array();

        //retrieve table content
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);

            $exrInfo_item = array(
                "id" => $id,
                "reps" => $reps,
                "sets" => $sets,
                "weight" => $weight,
                "exr_id" => $exr_id,
                "date" => $date
            );

            array_push($exrsInfo_arr["records"], $exrInfo_item);
        }

        echo json_encode($exrsInfo_arr);
    } else {
        echo json_encode(
            array("messege" => "No exrsInfo found.")
        );
    }