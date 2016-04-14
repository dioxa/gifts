<?php

echo"<img src=" . $data["user_info"]["photo"] . " height='200' width='150' class = 'img-responsive'>";
echo $data["user_info"]["firstname"] . " " . $data["user_info"]["lastname"];
echo "<br>";
if($_SESSION["username"] != $_POST["username"]) {
    echo"<form method='POST' action='/subscribe'>
    <input type='hidden' value='$_POST[username]' name='username'>
    <input type='submit' value='Подписаться'>
    </form>";
}



echo "<br> Желания:<br>";
echo'<div class="col-lg-4"><div class="col-lg-3 table-bordered" ><a href="/gift/add"><img src="../../uploads/add.jpg" class="img-rounded"></a></div></div>';
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