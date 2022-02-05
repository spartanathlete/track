<?php

    //Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //Include db and object
    include_once '../config/Database.php';
    include_once '../models/Day.php';

    //New instances
    $database = new Database();
    $db = $database->getConnection();
    $day = new Day($db);

    //Query days
    $stmt = $day->read();
    $num = $stmt->rowCount();

    //Check if more than 0 record found
    if($num > 0){

        //days array
        $days_arr = array();
        $days_arr["records"] = array();

        //retrieve table content
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);

            $day_item = array(
                "id" => $id,
                "name" => $name,
                "description" => html_entity_decode($description),
                "date" => $date
            );

            array_push($days_arr["records"], $day_item);
        }

        echo json_encode($days_arr);
    } else {
        echo json_encode(
            array("messege" => "No days found.")
        );
    }