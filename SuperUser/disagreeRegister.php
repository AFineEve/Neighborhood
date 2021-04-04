<?php
require "../php_public/db.php";

$email = $_POST["email"];

$database = new DataBase();
$sql = "select * from user where email = '$email'";
$result_user = $database->execute($sql);
$userInfo = $database->getMultipleRecords();


if ($userInfo){
    $owner_id = $userInfo["data"][0]["id"];
    $sql = "delete from user where id='$owner_id'";
    $affectRowsA = $database->delete($sql);
    $sql = "delete from ".$userInfo["data"][0]["role"]." where owner_id='$owner_id'";
    $affectRowsB = $database->delete($sql);
    $result["status"] = "success";
    echo json_encode($result);

}else{
    $result["status"] = "fail";
    $result["result"] = "no this user";
    echo json_encode($result);
}
