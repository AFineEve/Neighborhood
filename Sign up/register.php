<?php
require '../php_public/db.php';
$posts = $_POST;
//  清除一些空白符号
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}

//echo $_POST["subdivision_address"];

$file = $_FILES['attachment'];

//save user
$saveUser = saveTempUser($posts);
//get user id
$id = getUserId($posts["email"]);
//save attachment and path
$saveAttachment = saveTempAttachment($posts, $file, $id);

//save type info by role
$saveTypeInfo = saveTypeInfo($posts, $id);



if ($saveUser == 1 && $saveAttachment == 1 && $saveTypeInfo== 1){
    Header("Location:../Sign up/successful.html");
} else {
    Header("Location:../Sign up/fail.html");
}


function saveTempUser($post){
    $name = $post["name"];
    $password = $post["password"];
    $age = $post["age"];
    $gender = $post["gender"];
    $email = $post["email"];
    $telephone = $post["telephone"];
    $role = $post["role_name"];
    $database = new DataBase();
    $sql = "insert into user (name,password,age,gender,email,telephone,role,isCheck) 
            values ('$name','$password','$age','$gender','$email','$telephone','$role','no')";
//    echo $sql;
    $result = $database->insert($sql);
//    echo $result;
    $database->close();
    if ($result>=0){
        return 1;//successful
    }else{
        return 0;//fail
    }

}

function getUserId($email){
    //connect db
    $database = new DataBase();
    //get id by email from user
    $sql = "select id from user where email='$email'";
    $result = $database->execute($sql);
    $result_array = $database->fetchAssoc();
    $id = $result_array["id"];
    $database->close();
    return $id;
}

function saveTempAttachment($post, $file, $id){

    $database = new DataBase();
    //save picture and path
    $dir = iconv("UTF-8", "GBK",$post["email"]);
    $dir = "../attachment/" . $dir;
    if (!file_exists($dir)){
        mkdir ($dir,0777,true);
    }
    $path = $dir."/".$file["name"];
    $type = strrchr($file["name"], ".");
    if (strtolower($type) == '.png' || strtolower($type) == '.jpg' || strtolower($type) == '.bmp' || strtolower($type) == '.gif') {
        //将图片文件移到该目录下
        move_uploaded_file($file['tmp_name'], $path);
        $sql = "insert into temp_user_attachment (user_id,file_path) values ('$id','$path')";
        $is_insert = $database->insert($sql);
        $database->close();
        if ($is_insert>=0){
            return 1;//successful
        }else{
            return 0;//fail
        }
    }






}

function saveTypeInfo($posts, $id){
    if ($posts["role_name"] == "subdivision"){
        $subdivision_name = $posts["subdivision_name"];
        $subdivision_address = $posts["subdivision_address"];
        $sql = "insert into subdivision (owner_id, name, address, isCheck) values ('$id', '$subdivision_name', '$subdivision_address', 'no')";
    }
    if ($posts["role_name"] == "building"){
        $subdivision_name = $posts["subdivision_name"];
        $building_number = $posts["building_number"];
        $sql = "insert into building (subdivision_id, owner_id, building_number, isCheck) values ('$subdivision_name','$id', '$building_number', 'no')";
    }
    if ($posts["role_name"] == "apartment"){
        $subdivision_name = $posts["subdivision_name"];
        $building_number = $posts["building_number"];
        $apartment_number = $posts["apartment_number"];
        $sql = "insert into apartment (subdivision_id, building_id, owner_id, apartment_number, isCheck) values ('$subdivision_name', '$building_number', '$id', '$apartment_number', 'no')";
    }
    $database = new DataBase();
    $result = $database->insert($sql);
    $database->close();
    if ($result>0){
        return 1;//successful
    }else{
        return 0;//fail
    }
}