<?php

require_once '../include/config.php';

$commentText = $_POST['commentText'];
$user_id = user_details('acct_email');
$post_id = $_POST['postID'];
$createdAt = date('Y-m-d H:i:s');

//var_dump($_POST);


$stmt = $conn->prepare("INSERT INTO comment (user_email, post_id, comment, createdAt) values(:user_email,:post_id,:comment,:createdAt)");
$stmt->execute([
    'user_email'=>$user_id,
    'post_id'=>$post_id,
    'comment'=>$commentText,
    'createdAt'=>$createdAt
]);



