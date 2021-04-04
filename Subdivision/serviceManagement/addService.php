<?php
require "../../php_public/db.php";

//Submitted addService form
$serviceType = $_POST["serviceType"];
$serviceSupplier = $_POST["serviceSupplier"];
$subdivision_id = $_POST["subdivision_id"];

// Create database connection
$database = new DataBase();

$sql = "insert into service (id, service_name, unit_price, current_usage, total_usage, supplier) 
    values (0, '$serviceType', 0.5, 0, 0, '$serviceSupplier')";
$result = $database->insert($sql);

// return registered service id
$sql_service = "insert into subdivision_service (id, subdivision_id, service_id) values (0, $subdivision_id, $result)";
$result_service = $database->insert($sql_service);

$database->close();

echo $result_service;