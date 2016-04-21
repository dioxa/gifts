<?php
class ModelSearch extends Model {

    public function getProfile($username) {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT username, firstname, lastname, photo FROM user where username like '$username%';");

        $stmt->execute();

        $result["usersCount"] = $stmt->rowCount();
        $result["users"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}