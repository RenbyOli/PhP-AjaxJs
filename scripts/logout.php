<?php
if( $_POST['logout'] == true ) {
    session_start();
    $_SESSION = [];
    session_destroy();
    echo '1';
}