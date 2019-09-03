<?php
session_start();

include_once 'db.php';

if( (!empty($_POST['title_new_article'])) && (!empty($_POST['text_new_article'])) ) {
    
    //Загрузка фото для статьи
    $photo_article = $_FILES['image_0'];
    $relative_path = '/article/' . $photo_article['name'];
    $tempName = $photo_article['tmp_name'];
    $destName = $_SERVER['DOCUMENT_ROOT'] . $relative_path;
    move_uploaded_file($tempName, $destName);
    
    //Сбор данных для статьи
    $title_article = trim($_POST['title_new_article']);
    $text_article = trim($_POST['text_new_article']);
    $date_article = date('Y-m-d H:i:s');

    //Определение id автора статьи
    $query_user = $pdo->query("SELECT * FROM `users` WHERE id='" . $_SESSION['user_id'] . "'");
    $result_user = $query_user->fetch(PDO::FETCH_ASSOC);
    $user_name = $result_user['id'];

    //Сохранение статьи в бд
    $query = $pdo->query("INSERT INTO articles VALUES (NULL, '".$title_article."', '".$text_article."', '".$date_article."', '".$relative_path."' , '".$user_name."')");

    echo 1;
} else {
    echo 0;
}