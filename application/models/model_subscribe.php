<?php
class Model_Subscribe extends Model {

    public function subscribe() {
        require_once 'application/core/connect_db.php';

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("insert into subscribers(user_id, subscriber_id) values (:user_id, (select id from user where username = :username))");

        $stmt->bindParam(":user_id", $_SESSION["id"]);
        $stmt->bindParam(":username", $_POST["username"]);

        $stmt->execute();
    }
}