<?php
require "../../php_public/db.php";

//Submitted addService form
$service_id = $_POST["service_id"];
$subdivision_id = $_POST["subdivision_id"];

// Create database connection
$database = new DataBase();

$sql_delete_service = "delete from service where id='$service_id'";
$result_delete_service = $database->delete($sql_delete_service);

if ($result_delete_service > 0) {
    $sql_delete_subdivision_service = "delete from subdivision_service 
        where service_id = '$service_id' and subdivision_id = '$subdivision_id'";
    $result_delete_subdivision_service = $database->delete($sql_delete_subdivision_service);
    echo $result_delete_subdivision_service;
} else {
    echo "failed";
}

// return registered service id
$database->close();
