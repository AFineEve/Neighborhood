<?php
require "../../php_public/db.php";

$subdivision_id = $_POST["subdivision_id"];

// get service ids registered by current subdivision
$database = new DataBase();
$sql = "select service_id from subdivision_service where subdivision_id = '$subdivision_id'";
$result = $database->execute($sql);
//$result_array = $database->fetchArray();

$result_array = $database->getMultipleRecords();
echo json_encode($result_array);

$database->close();