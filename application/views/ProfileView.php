<?php
echo"<div class = 'col-md-12'>
        <div class = 'col-md-4 b'>
        <img src=" . $data["userInfo"]["photo"] . " height='200' width='150' class = 'img-responsive'>";
echo $data["userInfo"]["firstname"] . " " . $data["userInfo"]["lastname"];
if(isset($data["visitor"]) && !isset($data["guest"])) {
    if (!isset($data["following"])) {
        echo "<form method='POST' action='/profile/subscribe'>
        <input type='hidden' value='". $data['userInfo']['id'] ."' name='userId'>
        <button type='submit' class='btn btn-primary'>Подписаться</button>
        </form>";
    } else {
        echo "<form method='POST' action='/profile/unsubscribe'>
        <input type='hidden' value='". $data['userInfo']['id'] ."' name='userId'>
        <button type='submit' class='btn btn-primary'>Отписаться</button>
        </form>";
    }
}
echo "</div>";

echo "<div class = 'col-md-4'>
    <h5> Подписки:</h5>";
if(isset($data["subscribers"])) {
    foreach ($data["subscribers"] as $subscriber) {
        echo "<img src=" . $subscriber['photo'] . " height='50' width='50'><a href='/profile/$subscriber[username]'> $subscriber[firstname] $subscriber[lastname]</a>";
    }
}
echo "</div>";

echo "<div class = 'col-md-4'> 
    <h5> Подписчики:</h5>";
if(isset($data["followers"])) {
    foreach ($data["followers"] as $follower) {
        echo "<img src=" . $follower['photo'] . " height='50' width='50'><a href='/profile/$follower[username]'> $follower[firstname] $follower[lastname]</a>";
    }
}
echo "</div> </div>";





echo "<br> Желания:<br>";
if(!isset($data["visitor"]) && !isset($data["guest"])) {
    echo '<div class="col-lg-4"><div class="col-lg-3 table-bordered" ><a href="/gift/add"><img src="../../uploads/add.jpg" class="img-rounded"></a></div></div>';
}
    if(isset($data["gifts"])) {
    foreach ($data["gifts"] as $photo) {
        echo "<div class='col-lg-4' height='421'><a href='/gift/" . $photo["id"] . "'><img src='". $photo["photo"] . "' class='img-responsive'></a></div>";
    }
    echo "<br>";
}



?>