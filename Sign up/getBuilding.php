<?php
require "../php_public/db.php";

$posts = $_POST;
//  清除一些空白符号
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$subdivision_name = $posts["subdivision_name"];

$building = getBuilding($subdivision_name);
if ($building){
    $result["building"] = $building;
    $result["status"] = "success";
}else{
    $result["status"] = "fail";
    $result["reason"] = "no subdivision";
}

echo json_encode($result);

function getBuilding($subdivision_name){
    $database = new DataBase();
    $sql = "select * from building where isCheck = 'yes' and subdivision_id = '$subdivision_name'";
    $result = $database->execute($sql);
    $database->close();

    $i = 0 ;
    $output = [] ;
    while( $row = $database->fetchAssoc()){
        $output["data"][$i] = $row ;
        $i++ ;
    }
    return $output;
}

