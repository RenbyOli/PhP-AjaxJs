<?php

if($_POST['name'] == 'reg') {
    echo '<form action="/" method="post">
            <input id="new_login" type="text" name="new_login" placeholder="Name">
            <input id="new_pass" type="password" name="new_pass" placeholder="Password">
            <button id="reg_user" type="submit" name="reg">Registration</button>
            </form>';
} elseif($_POST['name'] == 'auth') {
	echo '<form action="/" method="post">
            <input id="login" type="text" name="login" placeholder="Name">
            <input id="pass" type="password" name="pass" placeholder="Password">
            <button id="auth_user" type="submit" name="auth">Auth</button>
        </form>';
}