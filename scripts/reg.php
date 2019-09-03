<?php

$connect = mysqli_connect('localhost', 'root', '', 'renby') or die('Пипец: '.mysqli_error());

$new_user_login = $_POST['new_login'];
$new_user_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
$new_user_date = date('Y-m-d H:i:s');

if( (isset($_POST['new_login'])) && (isset($_POST['new_pass'])) ) {

    $query = "SELECT * FROM users WHERE login = '" . $new_user_login . "'";
    

    if( !isset($result_arr) ) {
        $reg_query = "INSERT INTO users VALUES (NULL, '".$new_user_login."', '".$new_user_pass."', '".$new_user_date."')";
        $result = mysqli_query($connect, $reg_query);
        echo "Всё заsdsdasdебись";
    } else {
        echo "Такой пользователь уже есть";
    }	
}