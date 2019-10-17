<?php

include_once('db.php');

$result = $pdo->query('SELECT articles.id as article_id,
                                articles.image as article_image,
                                articles.title as article_title,
                                articles.text as article_text,
                                articles.date as article_date,
                                users.login as article_users_login FROM articles INNER JOIN users ON users.id=articles.user_id');

$output = '';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    if( isset($_COOKIE["auth_token"]) ) {

        $output .= '<div class="article" id="article_'.$row["article_id"].'">
                <div class="article__card">
                    <div class="article__front" style="background-image:url('.$row["article_image"].')">
                </div>
                <div class="article__back">
                    <div class="article__delete" id="delete_article_'.$row["article_id"].'">Удалить</div>
                    <div class="article__author">'.$row["article_users_login"].'</div>
                    <div class="article__title">'.$row["article_title"].'</div>
                    <div class="article__description">'.$row["article_text"].'</div>
                    <div class="article__date">'.$row["article_date"].'</div>
                </div>
            </div>
        </div>';
    } else {
        $output .= '<div class="article" id="article_'.$row["article_id"].'">
                <div class="article__card">
                    <div class="article__front" style="background-image:url('.$row["article_image"].')">
                </div>
                <div class="article__back">
                    <div class="article__author">'.$row["article_users_login"].'</div>
                    <div class="article__title">'.$row["article_title"].'</div>
                    <div class="article__description">'.$row["article_text"].'</div>
                    <div class="article__date">'.$row["article_date"].'</div>
                </div>
            </div>
        </div>';
    }
}

echo $output;