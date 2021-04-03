<?php
require "../php_public/db.php";

$posts = $_POST;
//  清除一些空白符号
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$type = $posts["type"];

$subdivision = getSubdivision();
if ($subdivision["data"]){
    $result["subdivision"] = $subdivision;
    $result["status"] = "success";
}else{
    $result["status"] = "fail";
    $result["reason"] = "no subdivision";
}

echo json_encode($result);

function getSubdivision(){
    $database = new DataBase();
    $sql = "select * from subdivision where isCheck = 'yes'";
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

function getBuilding(){
    $database = new DataBase();
    $sql = "select * from building where isCheck = 'yes'";
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
