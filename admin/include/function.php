<?php
require_once '../include/config.php';


if(isset($_POST['addCategorySubmit'])) {
    $category_name = inputValidation($_POST['category_name']);
    $category_description = inputValidation($_POST['category_description']);

    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $name = $file['name'];

        $path = pathinfo($name, PATHINFO_EXTENSION);

        $allowed = array('jpg', 'png', 'jpeg');


        $folder = "../assets/img/category/";
        $n = inputValidation($category_name) . $name;

        $destination = $folder . $n;
    }
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $category_slug = strtolower($category_name)."-"."news";
        $category_id = uniqid();
        $stmt = $conn->prepare('INSERT INTO categories (category_id,category_name, category_slug, category_description,category_image) VALUES (:category_id,:category_name,:category_slug,:category_description,:category_image)');
        $stmt->execute([
            'category_id'=>$category_id,
            'category_name'=>$category_name,
            'category_slug'=>$category_slug,
            'category_description'=>$category_description,
            'category_image'=>$n
        ]);

        if(true){
            notify_alert('Category Added Successfully','success','3000','close');
        }
    }
}


if(isset($_POST['addAuthor'])) {
    $author_name = inputValidation($_POST['author_name']);
    $author_description = inputValidation($_POST['author_description']);

    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $name = $file['name'];

        $path = pathinfo($name, PATHINFO_EXTENSION);

        $allowed = array('jpg', 'png', 'jpeg');


        $folder = "../assets/img/author/";
        $n =$author_name. $name;

        $destination = $folder . $n;
    }
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $author_id = uniqid();
        $stmt = $conn->prepare('INSERT INTO author (author_id, author_name, author_description, author_image) VALUES (:author_id,:author_name,:author_description,:author_image)');
        $stmt->execute([
            'author_id'=>$author_id,
            'author_name'=>$author_name,
            'author_description'=>$author_description,
            'author_image'=>$n
        ]);

        if(true){
            notify_alert('Category Added Successfully','success','3000','close');
        }else{
            notify_alert('Sorry Something went wrong','danger','2000','close');
        }
    }
}

if(isset($_POST['addAdvertisementSubmit'])){
    $title = inputValidation($_POST['title']);
    $url = inputValidation($_POST['url']);
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $name = $file['name'];

        $path = pathinfo($name, PATHINFO_EXTENSION);

        $allowed = array('jpg', 'png', 'jpeg');


        $folder = "../assets/img/category/";
        $n = inputValidation($category_name) . $name;

        $destination = $folder . $n;
    }
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $stmt = $conn->prepare('INSERT INTO ads (title,url,image) VALUES (:title,:url,:image)');
        $stmt->execute([
            'title'=>$title,
            'url'=>$url,
            'image'=>$n
        ]);

        if(true){
            notify_alert('Ads Added Successfully','success','3000','close');
        }
    }
}

function fetchDetails($value){
    global $conn;
    $stmt = $conn->query("SELECT * FROM $value ");
    return $stmt->rowCount();
}






