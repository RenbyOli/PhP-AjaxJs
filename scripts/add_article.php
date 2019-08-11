<?php

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

if( (!empty($_FILES['preview_new_article'])) && (!empty($_POST['title_new_article'])) && (!empty($_POST['text_new_article'])) ) {
    $photo_article = $_FILES['preview_new_article'];

    $relative_path = '/article/' . $photo_article['name'];
    $tempName = $photo_article['tmp_name'];
    $destName = $_SERVER['DOCUMENT_ROOT'] . $relative_path;
    move_uploaded_file($tempName, $destName);
    
    $title_article = trim($_POST['title_new_article']);
    $text_article = trim($_POST['text_new_article']);
    $date_article = date('Y-m-d H:i:s');

    $query = "INSERT INTO articles VALUES (NULL, '".$title_article."', '".$text_article."', '".$relative_path."', '".$date_article."')";
    $result = mysqli_query($connect, $query);

    echo $result;
} else {
    echo 'Стоп, что то тут не чисто!';
}