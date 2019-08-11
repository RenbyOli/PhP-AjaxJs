<?php

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

$query ="DELETE FROM articles WHERE article_id = '".$_POST['id']."'";
$result = mysqli_query($connect, $query);