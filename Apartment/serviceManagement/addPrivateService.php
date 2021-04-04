<?php
require "../../php_public/db.php";

//Submitted addService form
$serviceType = $_POST["serviceType"];
$serviceSupplier = $_POST["serviceSupplier"];
$apartment_number = $_POST["apartment_number"];
$service_month = $_POST["service_month"];

// Create database connection
$database = new DataBase();

$sql = "insert into private_service 
    (id, private_service_name, unit_price, current_usage, total_usage, supplier, service_month, status) 
    values (0, '$serviceType', 1.7, 0, 0, '$serviceSupplier', '$service_month', 'UNPAID')";
$result = $database->insert($sql);

// return registered service id
$sql_service = "insert into apartment_private_service (id, apartment_number, private_service_id) 
    values (0, $apartment_number, $result)";
$result_service = $database->insert($sql_service);

$database->close();

echo $result_service;