<?php
if(isset($data["users"])) {
    echo"Найдено: " .  $data['users_count'] . " пользователей<br>";
    if($data['users_count'] > 1) {
        foreach ($data["users"] as $user) {
            echo "$user[firstname] $user[lastname] <img src='$user[photo]' height='100' width='100'><br>";
        }
    } else {

            echo "<a href='/profile/" . $data["users"]["username"] . "'>" . $data["users"]["lastname"] . " " . $data["users"]["firstname"] . "</a> <img src='" . $data["users"]["photo"] . "' height='100' width='100'><br>";
    }
    echo "<br>";
}