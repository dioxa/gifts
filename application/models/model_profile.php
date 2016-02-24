<?php
class Model_Profile extends Model {

    public function get_data() {
        require_once 'application/core/connect_db.php';

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT firstname, lastname, photo FROM user  WHERE username = :username");
        $stmt->bindParam(":username", $_SESSION["username"]);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}