<?php

echo"<img src=" . $data["userInfo"]["photo"] . " height='200' width='150' class = 'img-responsive'>";
echo $data["userInfo"]["firstname"] . " " . $data["userInfo"]["lastname"];
echo "<br>";

if(!empty($data["pageGuest"]) && !isset($_POST["guest"])) {
    if (!isset($data["following"])) {
        echo "<form method='POST' action='/profile/subscribe'>
        <input type='hidden' value='". $data['userInfo']['id'] ."' name='username'>
        <button type='submit' class='btn btn-primary'>Подписаться</button>
        </form>";
    } else {
        echo "<form method='POST' action='/profile/unsubscribe'>
        <input type='hidden' value='". $data['userInfo']['id'] ."' name='username'>
        <button type='submit' class='btn btn-primary'>Отписаться</button>
        </form>";
    }
}



echo "<br> Желания:<br>";
if(empty($_POST["username"]) && !isset($_POST["guest"])) {
    echo '<div class="col-lg-4"><div class="col-lg-3 table-bordered" ><a href="/gift/add"><img src="../../uploads/add.jpg" class="img-rounded"></a></div></div>';
}
    if(isset($data["gifts"])) {
    foreach ($data["gifts"] as $photo) {
        echo "<div class='col-lg-4' height='421'><a href='/gift/" . $photo["id"] . "'><img src='". $photo["photo"] . "' class='img-responsive'></a></div>";
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