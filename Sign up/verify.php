<?php
require "smtp.php";

$verification = GetRandStr(6);
$posts = $_POST;
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$email = $posts["email"];
//$email = "791371160@qq.com";

$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "lu791371160@163.com";//SMTP服务器的用户邮箱
$smtpemailto = $email;//发送给谁
$smtpuser = "lu791371160@163.com";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
$smtppass = "LKWEDYMXNZFJNAYX";//SMTP服务器的授权码
$mailtitle = "Verification Code of Neighborhood";//邮件主题
$mailcontent = "The verification code is:\n".$verification;;//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

$result = array();
if($state==""){
    $result["status"] = "fail";
    $result["reason"] = "Please check your email and try again";
} else {
    $result["status"] = "success";
    $result["verification"] = $verification;
}

echo json_encode($result);

function GetRandStr($length) {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $len = strlen($str) - 1;
    $randstr = '';
    for ($i = 0; $i < $length; $i++) {
        $num = mt_rand(0, $len);
        $randstr .= $str[$num];
    }
    return $randstr;
}


