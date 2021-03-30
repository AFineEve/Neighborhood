<?php
require "../php_public/db.php";
//  防止全局变量造成安全隐患
$admin = false;
//  启动会话，这步必不可少
session_start();
//  判断是否登陆
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    $id = $_SESSION["user_id"];
    // 创建连接
    $database = new DataBase();
    $sql = "select id, name, age, gender, email, telephone, role from user where id = '$id'";
    $result = $database->execute($sql);
    $result_array = $database->fetchAssoc();
    $result_array["status"] = "success";
    $database->close();
    echo json_encode($result_array);
} else {
    //  验证失败，将 $_SESSION["admin"] 置为 false
    $_SESSION["admin"] = false;
    $result["status"] = "fail";
    echo json_encode($result);
}
