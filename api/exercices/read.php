<?php

    //Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //Include db and object
    include_once '../config/Database.php';
    include_once '../models/Exercice.php';

    //New instances
    $database = new Database();
    $db = $database->getConnection();
    $exercice = new Exercice($db);

    //Query exercices
    $stmt = $exercice->read();
    $num = $stmt->rowCount();

    //Check if more than 0 record found
    if($num > 0){

        //exercices array
        $exercices_arr = array();
        $exercices_arr["records"] = array();

        //retrieve table content
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);

            $exercice_item = array(
                "id" => $id,
                "name" => $name,
                "description" => html_entity_decode($description),
                "date" => $date
            );

            array_push($exercices_arr["records"], $exercice_item);
        }

        echo json_encode($exercices_arr);
    } else {
        echo json_encode(
            array("messege" => "No exercices found.")
        );
    }