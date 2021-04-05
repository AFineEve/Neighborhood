<?php
require "../php_public/db.php";
require "../Sign up/smtp.php";

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
    $check = sendmail($email);
    $result["status"] = "success";
    echo json_encode($result);

}else{
    $result["status"] = "fail";
    $result["result"] = "no this user";
    echo json_encode($result);
}

function sendmail($email){
    $smtpserver = "smtp.163.com";//SMTP服务器
    $smtpserverport =25;//SMTP服务器端口
    $smtpusermail = "lu791371160@163.com";//SMTP服务器的用户邮箱
    $smtpemailto = $email;//发送给谁
    $smtpuser = "lu791371160@163.com";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
    $smtppass = "LKWEDYMXNZFJNAYX";//SMTP服务器的授权码
    $mailtitle = "Registration Failed";//邮件主题
    $mailcontent = "The information you submitted is incomplete, please re-register and submit.";;//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
    $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

    return $state;
}
