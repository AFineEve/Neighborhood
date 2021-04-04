<?php
require "../../php_public/db.php";

$building_id = $_POST["building_id"];

// get service ids registered by current subdivision
$database = new DataBase();
$sql = "select owner_id, apartment_number from apartment where building_id = '$building_id'";
$result = $database->execute($sql);
$result_array = $database->getMultipleRecords();

// get each service info by service id
$index = 0;
$owner_arr = [];
foreach ($result_array["data"] as $value) {
    $owner_id = $value["owner_id"];
    $sql_owner_info = "select * from user where id = '$owner_id'";
    $result_owner_info = $database->execute($sql_owner_info);
    $result_owner_info_arr = $database->fetchAssoc();
    $owner_arr[$index++] = array_merge($value, $result_owner_info_arr);
}
echo json_encode($owner_arr);

$database->close();