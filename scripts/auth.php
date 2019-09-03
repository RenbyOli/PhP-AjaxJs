<?php

$connect = mysqli_connect('localhost', 'root', '', 'renby') or die('Пипец: '.mysqli_error());

$user_login = $_POST['login'];
$user_pass = $_POST['pass'];

if( (isset($_POST['login'])) && (isset($_POST['pass'])) ) {
	$query = "SELECT * FROM users WHERE login = '" . $user_login . "'";
	$result_arr = mysqli_fetch_assoc(mysqli_query( $connect, $query ) );
	
	if(password_verify($user_pass, $result_arr['password'])) {
		session_start();
		$_SESSION['user_id'] = $result_arr['id'];
		// $_SESSION['user_name'] = $result_arr['user_name'];
		// $session_key = generateSalt();

		// setcookie('login', $result_arr['user_name'], time()+60*60*24*30);
		// setcookie('key', $session_key, time()+60*60*24*30);

		// $query = 'UPDATE users SET cookie="'.$session_key.'" WHERE user_name="'.$result_arr['user_name'].'"';
		// mysqli_query($connect, $query);

		echo '1';
	} else {
		echo "2";
	}
}