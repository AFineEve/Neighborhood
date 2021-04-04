<?php
require "../../php_public/db.php";

$apartment_number = $_POST["apartment_number"];
$service_month = $_POST["service_month"];

// get service ids registered by current subdivision
$database = new DataBase();
$sql = "select private_service_id from apartment_private_service where apartment_number = '$apartment_number'";
$result = $database->execute($sql);
$result_array = $database->getMultipleRecords();

// get each service info by service id
$index = 0;
$service_arr = [];
foreach ($result_array["data"] as $value) {
    $private_service_id = $value["private_service_id"];
    $sql_private_service_info = "select * from private_service 
    where id = '$private_service_id' and service_month = '$service_month'";
    $result_service_info = $database->execute($sql_private_service_info);
    $result_service_info_arr = $database->fetchAssoc();
    $service_arr[$index++] = $result_service_info_arr;
}
echo json_encode($service_arr);

$database->close();