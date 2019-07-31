<div class="main">
    <div class="container">
        <?php
            if( isset($_SESSION["user_id"]) ) {
                include_once('scripts/add_article.php');
            } else {
                echo '<h1>Авторизуйся или регистрируйся, пёс</h1>';
            }

            include_once('scripts/render_articles.php');
        ?>
    </div>
</div>