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
$result = $database->execute($sql);
//get result in array
$result_array = $database->fetchAssoc();

$database->close();

if ($database->numRows() > 0) {
    //  当验证通过后，启动 Session
    session_start();
    //  注册登陆成功的 admin 变量，并赋值 true
    $_SESSION["admin"] = true;
    $_SESSION["user_id"] = $result_array["id"];
    $result_array["status"] = "success";
    echo json_encode($result_array);
} else {
    $result_array["status"] = "fail";
    echo json_encode($result_array);
}


