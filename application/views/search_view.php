<?php
if(isset($data["users"])) {
    echo"Найдено: " .  $data['users_count'] . " пользователей<br>";
    foreach ($data["users"] as $user) {
        echo "<a href='/" . $user["username"] . "'> $user[firstname] $user[lastname] <img src='$user[photo]' height='100' width='100'></a><br>";
    }
    echo "<br>";
}