<?php
echo "<a href='/gift'>Добавить подарок</a><br>
    <a href='/settings'>Настройки</a><br>
    <a href='/login/logout'>logout</a><br>";
echo"<img src=" . $data["user_info"]["photo"] . " height='200' width='100'>";
echo $data["user_info"]["firstname"] . " " . $data["user_info"]["lastname"];
echo "<br>";
if($_SESSION["username"] != $_POST["username"]) {
    echo"<a href='/subscribe'>Sub</a>";
}

if(isset($data["gift_info"])) {
    echo "<br> Желания:";
    foreach ($data["gift_info"] as $photo) {
        echo "<img src='$photo' height='100' width='100'>";
    }
    echo "<br>";
}

if(isset($data["subscribers"])) {
    echo "<br> Подписки:";
    if($data["subscribers_count"] > 1) {
        foreach ($data["subscribers"] as $subscriber) {
            echo "<img src=" . $subscriber['photo'] . " height='100' width='100'> $subscriber[firstname] $subscriber[lastname]";
        }
    } else {
        echo "<img src=" . $data['subscribers']['photo'] . " height='100' width='100'><a href='/profile/" . $data['subscribers']['username'] . "'>" . $data['subscribers']['firstname'] . " " . $data['subscribers']['lastname'] . "</a>";
    }
}

if(isset($data["followers"])) {
    echo "<br> Подписчики:";
    if($data["followers_count"] > 1) {
        foreach ($data["followers"] as $follower) {
            echo "<img src=" . $follower['photo'] . " height='100' width='100'> $follower[firstname] $follower[lastname]";
        }
    } else {
        echo "<img src=" . $data['followers']['photo'] . " height='100' width='100'><a href='/profile/" . $data['followers']['username'] . "'>" . $data['followers']['firstname'] . " " . $data['followers']['lastname'] . "</a>";
    }
}

?>