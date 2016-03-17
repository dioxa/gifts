<?php
echo '<form method="POST" action="/search">
    <input type="text" name="username">
    <input type="submit" value="Найти"><br>
    </form>';

echo "<a href='/profile/'>Моя страница</a><br>
    <a href='/gift'>Добавить подарок</a><br>
    <a href='/settings'>Настройки</a><br>
    <a href='/login/logout'>logout</a><br>";
echo"<img src=" . $data["user_info"]["photo"] . " height='200' width='150'>";
echo $data["user_info"]["firstname"] . " " . $data["user_info"]["lastname"];
echo "<br>";
if($_SESSION["username"] != $_POST["username"]) {
    echo"<form method='POST' action='/subscribe'>
    <input type='hidden' value='$_POST[username]' name='username'>
    <input type='submit' value='Подписаться'>
    </form>";
}


if(isset($data["gifts"])) {
    echo "<br> Желания:";
    foreach ($data["gifts"] as $photo) {
        echo "<img src='". $photo["photo"] . "' height='100' width='100'>";
    }
    echo "<br>";
}

if(isset($data["subscribers"])) {
    echo "<br> Подписки:";
        foreach ($data["subscribers"] as $subscriber) {
            echo "<img src=" . $subscriber['photo'] . " height='100' width='100'><a href='/profile/$subscriber[username]'> $subscriber[firstname] $subscriber[lastname]</a>";
}}


if(isset($data["followers"])) {
    echo "<br> Подписчики:";
        foreach ($data["followers"] as $follower) {
            echo "<img src=" . $follower['photo'] . " height='100' width='100'><a href='/profile/$follower[username]'> $follower[firstname] $follower[lastname]</a>";
        }
}

?>