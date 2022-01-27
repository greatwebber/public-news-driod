<?php
require_once '../include/config.php';

$full_name = $_POST['name'];
$email2 = $_POST['email'];
$phone = $_POST['phone'];
$visa = $_POST['visa'];
$country = $_POST['country'];

$reference = uniqid('CON');

$stmt = $conn->prepare("INSERT INTO contact_request (refrence_id,full_name, email, phone, visa, visa_reason) VALUES(:refrence_id,:full_name, :email, :phone,:visa,:visa_reason)");
$stmt->execute([
    'refrence_id'=>$reference,
    'full_name' =>$full_name,
    'email'=>$email2,
    'phone'=>$phone,
    'visa'=>$visa,
    'visa_reason'=>$country
]);

    if(true){
        $email = "kaywhytee232@gmail.com";
        $APP_NAME = $pageName;
        $message = $sendMail->contactMail2($full_name, $email2, $phone, $visa,$APP_NAME,$web_url);
        $subject = "Contact Request - $pageName";
        $email_message->send_mail($email, $message, $subject);
    }




