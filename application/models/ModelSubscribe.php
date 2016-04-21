<?php
class ModelSubscribe extends Model {

    public function subscribe() {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("insert into subscribers(user_id, subscriber_id) values (:userId, (select id from user where username = :username))");

        $stmt->bindParam(":userId", $_SESSION["id"]);
        $stmt->bindParam(":username", $_POST["username"]);

        $stmt->execute();
    }
}