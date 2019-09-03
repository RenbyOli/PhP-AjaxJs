<div class="main">
    <div class="container">
        <?php
            echo '<div class="articles">';
            include_once('scripts/render_articles.php');
            echo '</div>';

            if( isset($_SESSION["user_id"]) ) {
                include_once('chunks/add_article.php');
            } else {
                echo '<h1>Авторизуйся или регистрируйся, пёс</h1>';
            }
        ?>
    </div>
</div>