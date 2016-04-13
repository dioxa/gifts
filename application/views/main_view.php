<?php
if(!isset($_SESSION["username"])) {
    echo '<form method="POST" action="/login"><br>
    <input type="text" name="login" placeholder="login"/><br>
    <input type="password" name="password"/>
    <input type="submit" value="Login">
    </form>';
    echo '<a href="/Registration"> Регистрация </a>';
} else {
    header("Location:/profile/$_SESSION[username]");
}
?>
