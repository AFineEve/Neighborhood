<?php
require "../php_public/db.php";

$posts = $_POST;
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$password = $posts["pwd"];
$email= $posts["email"];

// create connect
$database = new DataBase();
$sql = "select id, name, age, gender, email, telephone, role from user where email='$email' and password='$password'";
$result_info = $database->execute($sql);
//get result in array
$user_info = $database->fetchAssoc();

$id = $user_info["id"];
$sql = "select id as role_id from ".$user_info["role"]." where owner_id = '$id'";
$result_info = $database->execute($sql);
//get result in array
$role_info = $database->fetchAssoc();

$result = array_merge($user_info, $role_info);
$result["status"] = "success";

$database->close();

if ($database->numRows() > 0) {
    //  当验证通过后，启动 Session
    session_start();
    //  注册登陆成功的 admin 变量，并赋值 true
    $_SESSION["admin"] = true;
    $_SESSION["user_id"] = $result["id"];
    $result["status"] = "success";
    echo json_encode($result);
} else {
    $result["status"] = "fail";
    echo json_encode($result);
}


