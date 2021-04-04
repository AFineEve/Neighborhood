<?php
require "../php_public/db.php";

$email = $_POST["email"];

$database = new DataBase();
$sql = "update user set isCheck = 'yes' where email = '$email'";
$affectRowsA = $database->update($sql);
if ($affectRowsA > 0){
    $sql = "select * from user where email = '$email'";
    $result_user = $database->execute($sql);
    $userInfo = $database->getMultipleRecords();
    $owner_id = $userInfo["data"][0]["id"];
    $sql = "update ".$userInfo["data"][0]["role"]." set isCheck = 'yes' where owner_id = '$owner_id'";
    $affectRowsB = $database->update($sql);
    $database->close();
    if ($affectRowsB > 0){
        $result["status"] = "success";
        echo json_encode($result);
    }else{
        $result["status"] = "fail";
        $result["result"] = "update ".$userInfo["data"][0]["role"]." error";
        echo json_encode($result);
    }
}else{
    $result["status"] = "fail";
    $result["result"] = "update user error";
    echo json_encode($result);
}


