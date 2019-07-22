<?php

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

$user_login = $_POST['login'];
$user_pass = $_POST['pass'];

if( (isset($_POST['login'])) && (isset($_POST['pass'])) ) {
	$query = "SELECT * FROM users WHERE user_name = '" . $user_login . "'";
	$result_arr = mysqli_fetch_assoc(mysqli_query( $connect, $query ) );
	
	if(password_verify($user_pass, $result_arr['user_pass'])) {
		echo '1';
	} else {
		echo "2";
	}
}