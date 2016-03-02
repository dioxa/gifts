<?php

class Model_Login extends Model {

    public function login($username, $password) {
        require_once 'application/core/connect_db.php';

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT id, username, email, password, salt FROM user  WHERE email = '$username'");

        $stmt->execute();

        $numrows = $stmt->rowCount();

        if ($numrows == 1) {
            $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user_info["email"] == $username && hash('sha256', $password . $user_info[salt]) == $user_info["password"]) {
                $_SESSION["username"] = $user_info["username"];
                $_SESSION["id"] = $user_info["id"];
            }
        }
    }
}
?>