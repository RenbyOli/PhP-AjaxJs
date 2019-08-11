<?php

session_start();

$connect = mysqli_connect('localhost', 'root', '', 'php_test') or die('Пипец: '.mysqli_error());

$query = "SELECT * FROM articles";
$result_arr = mysqli_query($connect, $query);

echo '<div class="articles">';

while ($row=mysqli_fetch_assoc($result_arr)) {
    if( isset($_SESSION["user_id"]) ) {
        echo '<div class="article" id="article_'.$row["article_id"].'">
                <div class="article_delete" id="delete_article_'.$row["article_id"].'">Удалить</div>
                <div class="article__preview"><img src="'.$row["article_image"].'" alt=""></div>
                <div class="article__title">'.$row["article_title"].'</div>
                <div class="article__description">'.$row["article_text"].'</div>
                <div class="article__date">'.$row["article_date"].'</div>
            </div>';
    } else {
        echo '<div class="article" id="article_'.$row["article_id"].'">
                <div class="article__preview"><img src="'.$row["article_image"].'" alt=""></div>
                <div class="article__title">'.$row["article_title"].'</div>
                <div class="article__description">'.$row["article_text"].'</div>
                <div class="article__date">'.$row["article_date"].'</div>
            </div>';
    }
}

echo '</div>';