<?php
session_start();
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

				if( isset($_SESSION['user_id']) ) {
					echo '<button class="btn-exit" id="exit">Exit</button>';
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