<?php
require "../../php_public/db.php";

$building_id = $_POST["building_id"];

// get service ids registered by current subdivision
$database = new DataBase();
$sql = "select service_id from building_service where building_id = '$building_id'";
$result = $database->execute($sql);
$result_array = $database->getMultipleRecords();

// get each service info by service id
$index = 0;
$service_arr = [];
foreach ($result_array["data"] as $value) {
    $service_id = $value["service_id"];
    $sql_service_info = "select * from service where id = '$service_id'";
    $result_service_info = $database->execute($sql_service_info);
    $result_service_info_arr = $database->fetchAssoc();
    $service_arr[$index++] = $result_service_info_arr;
}
echo json_encode($service_arr);

$database->close();