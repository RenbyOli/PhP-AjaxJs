<?php

session_start();

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

$query = "SELECT * FROM articles";
$result_arr = mysqli_query($connect, $query);

echo '<div class="articles">';

while ($row=mysqli_fetch_assoc($result_arr)) {
    echo '<div class="article">
            <div class="article__preview"><img src="'.$row["article_image"].'" alt=""></div>
            <div class="article__title">'.$row["article_title"].'</div>
            <div class="article__description">'.$row["article_description"].'</div>
            <div class="article__date">'.$row["article_date"].'</div>
        </div>';
}

echo '</div>';