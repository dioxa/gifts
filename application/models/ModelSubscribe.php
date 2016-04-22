<?php
class ModelSubscribe extends Model {

    public function subscribe() {
        require_once 'application/core/Connect.php';

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("insert into subscribers(user_id, subscriber_id) values (:userId, (select id from user where username = :username))");

        $query->bindParam(":userId", $_SESSION["id"]);
        $query->bindParam(":username", $_POST["username"]);

        $query->execute();
        error_log( "Follow some user".print_R($query->errorInfo(),TRUE) );
    }
}