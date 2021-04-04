<?php
require "../../php_public/db.php";

$apartment_owner_id = $_POST["apartment_owner_id"];

// Create database connection
$database = new DataBase();

$sql_delete_owner = "delete from apartment where owner_id='$apartment_owner_id'";
$result_delete_owner = $database->delete($sql_delete_owner);

if ($result_delete_owner > 0) {
    $sql_delete_apartment_owner_from_user = "delete from user where id = '$apartment_owner_id'";
    $result_delete_apartment_owner = $database->delete($sql_delete_apartment_owner_from_user);
    echo $result_delete_apartment_owner;
} else {
    echo "failed";
}

// return registered service id
$database->close();
