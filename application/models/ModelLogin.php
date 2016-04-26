<?php
include "application/core/Logger.php";

class ModelLogin extends Model {

    public function login($username, $password) {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("SELECT id, username, email, password, salt FROM user  WHERE email = '$username'");

        $query->execute();
        Logger::sqlError($query->errorInfo());

        $numrows = $query->rowCount();

        if ($numrows == 1) {
            $userInfo = $query->fetch(PDO::FETCH_ASSOC);
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