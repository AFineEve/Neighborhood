<?php
require "../php_public/db.php";
$posts = $_POST;
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$email = $posts["email"];

$database = new DataBase();
$sql = "select user.id, name, age, gender, email, role, telephone, file_path from user 
        left join temp_user_attachment on user.id = temp_user_attachment.user_id 
        where isCheck='no' and email='$email'";
$result = $database->execute($sql);
//get result in array
$userInfo = $database->getMultipleRecords();

if ($userInfo){
    if ($userInfo["data"][0]["role"] == "subdivision"){
        $owner_id = $userInfo["data"][0]["id"];
        $sql = "select * from subdivision where owner_id='$owner_id'";
        $result = $database->execute($sql);
        $registerInfo = $database->getMultipleRecords();
    } elseif ($userInfo["data"][0]["role"] == "building"){
        $owner_id = $userInfo["data"][0]["id"];
        $sql = "select *, subdivision.name from building left join subdivision on building.subdivision_id = subdivision.id where building.owner_id='$owner_id'";
        $result = $database->execute($sql);
        $registerInfo = $database->getMultipleRecords();
    } elseif ($userInfo["data"][0]["role"] == "apartment"){
        $owner_id = $userInfo["data"][0]["id"];
        $sql = "select *, subdivision.name, building.building_number from apartment 
                left join subdivision on apartment.subdivision_id = subdivision.id 
                left join building on apartment.building_id = building.id 
                where apartment.owner_id='$owner_id'";
        $result = $database->execute($sql);
        $registerInfo = $database->getMultipleRecords();
    }
}
$output["userInfo"] = $userInfo;
$output["registerInfo"] = $registerInfo;
$output["status"] = "success";



echo json_encode($output);