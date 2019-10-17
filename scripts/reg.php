<?php

include_once('db.php');

$new_user_login = $_POST['new_login'];
$new_user_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
$new_user_date = date('Y-m-d H:i:s');

if( (isset($_POST['new_login'])) && (isset($_POST['new_pass'])) ) {

    $query = $pdo->query("SELECT * FROM users WHERE login = '" . $new_user_login . "'");
    $result_arr = $query->fetch(PDO::FETCH_ASSOC);

    if( !isset($result_arr) ) {
        $reg_query = $pdo->query("INSERT INTO users VALUES (NULL, '".$new_user_login."', '".$new_user_pass."', '".$new_user_date."')");
        $result = $reg_query->fetch(PDO::FETCH_ASSOC);
        echo "Всё заебись";
    } else {
        echo "Такой пользователь уже есть";
    }	
}