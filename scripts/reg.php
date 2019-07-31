<?php

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

$new_user_login = $_POST['new_login'];
$new_user_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
$new_user_date = date('Y-m-d H:i:s');

if( (isset($_POST['new_login'])) && (isset($_POST['new_pass'])) ) {

    $query = "SELECT * FROM users WHERE user_name = '" . $new_user_login . "'";
    $result_arr = mysqli_fetch_assoc(mysqli_query( $connect, $query ) );

    if( !isset($result_arr) ) {
        $reg_query = "INSERT INTO users VALUES (NULL, '".$new_user_login."', '".$new_user_pass."', '".$new_user_date."', 'user')";
        $result = mysqli_query($connect, $reg_query);
        echo "Всё заебись";
    } else {
        echo "Такой пользователь уже есть";
    }	
}