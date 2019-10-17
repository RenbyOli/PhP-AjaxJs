<?php
session_start();

include_once('scripts/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page">
	<header class="header">
		<div class="header__container container">
			<a href="/" class="logo"></a>

			<div class="header__form" id="form">
				<?php

				if(!empty($_COOKIE['auth_token'])) {
					$user_id_from_token = explode('_', $_COOKIE['auth_token']);
	
					$query = $pdo->query("SELECT * FROM users WHERE id = '" . $user_id_from_token . "'");
					$result_arr = $query->fetch(PDO::FETCH_ASSOC);
	
					if( $result_arr['cookie'] ==  $_COOKIE['auth_token']) {
						echo '<button class="btn-exit" id="exit">Exit</button>';
					} else {
						echo 'Неправильный авторизацинный токен!';
					}
				} else {
					echo '<div class="header__buttons">
							<button class="btnRegAuth" id="reg">Reg</button>
							<button class="btnRegAuth" id="auth">Auth</button>
						</div>';
				}
				
				?>
			</div>

		</div>
	</header>