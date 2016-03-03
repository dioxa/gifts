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
    foreach ($data["gift_info"] as $photo) {
        echo "<img src='$photo' height='100' width='100'>";
    }
}

?>