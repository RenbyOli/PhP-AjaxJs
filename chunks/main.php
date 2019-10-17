<?include_once('scripts/db.php');?>

<div class="main">
    <div class="container">
        <?
            echo '<div class="articles">';
            include_once('scripts/render_articles.php');
            echo '</div>';

            if(!empty($_COOKIE['auth_token'])) {
                $user_id_from_token = explode('_', $_COOKIE['auth_token']);

                $query = $pdo->query("SELECT * FROM users WHERE id = '" . $user_id_from_token . "'");
                $result_arr = $query->fetch(PDO::FETCH_ASSOC);

                if( $result_arr['cookie'] ==  $_COOKIE['auth_token']) {
                    include_once('chunks/add_article.php');
                } else {
                    echo 'Неправильный авторизацинный токен!';
                }
            } else {
                echo '<h1>Авторизуйся или регистрируйся, пёс</h1>';
            }
        ?>
    </div>
</div>