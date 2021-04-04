<?php
require "../../php_public/db.php";

//Submitted addService form
$service_id = $_POST["service_id"];
$building_id = $_POST["building_id"];

// Create database connection
$database = new DataBase();

$sql_delete_service = "delete from service where id='$service_id'";
$result_delete_service = $database->delete($sql_delete_service);

if ($result_delete_service > 0) {
    $sql_delete_subdivision_service = "delete from building_service 
        where service_id = '$service_id' and building_id = '$building_id'";
    $result_delete_subdivision_service = $database->delete($sql_delete_subdivision_service);
    echo $result_delete_subdivision_service;
} else {
    echo "failed";
}

// return registered service id
$database->close();
