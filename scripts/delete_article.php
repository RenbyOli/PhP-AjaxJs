<?php

include_once 'db.php';

$query = $pdo->query("DELETE FROM articles WHERE id = '".$_POST['id']."'");