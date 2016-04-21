<?php

class ModelLogin extends Model {

    public function login($username, $password) {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT id, username, email, password, salt FROM user  WHERE email = '$username'");

        $stmt->execute();

        $numrows = $stmt->rowCount();

        if ($numrows == 1) {
            $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userInfo["email"] == $username && hash('sha256', $password . $userInfo["salt"]) == $userInfo["password"]) {
                $_SESSION["username"] = $userInfo["username"];
                $_SESSION["id"] = $userInfo["id"];
            } else {
                return "Не правильный логин или пароль";
            }
        }
    }
}
?>