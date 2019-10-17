<?php

include_once('db.php');

$user_login = $_POST['login'];
$user_pass = $_POST['pass'];
$remember_me = $_POST['remember_me'];

if( (isset($_POST['login'])) && (isset($_POST['pass'])) ) {

	$query = $pdo->query("SELECT * FROM users WHERE login = '" . $user_login . "'");
    $result_arr = $query->fetch(PDO::FETCH_ASSOC);
	
	if(password_verify($user_pass, $result_arr['password'])) {
		session_start();
		if($remember_me == 'on') {
			$hash = md5($result_arr['login']);
			$auth_token = $result_arr['id'] . '_' . $hash;

			setcookie('auth_token', $auth_token, time()+60*60*24*30);

			$query = $pdo->query('UPDATE users SET cookie="'.$auth_token.'" WHERE login="'.$result_arr['login'].'"');
		}

		echo 1;
	} else {
		echo 2;
	}
}