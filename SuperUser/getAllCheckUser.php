<?php
require "../php_public/db.php";

$database = new DataBase();
$sql = "select name, email, role from user where isCheck='no'";
$result = $database->execute($sql);
//get result in array
$output = $database->getMultipleRecords();

$database->close();
if ($output){
    $output["status"] = "success";
} else {
    $output["status"] = "fail";
    $output["reason"] = "";
}
echo json_encode($output);