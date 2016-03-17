<?php
class Model_Search extends Model {

    public function get_profile($username) {
        require_once 'application/core/connect_db.php';

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT username, firstname, lastname, photo FROM user where username like '$username%';");

        $stmt->execute();

        $result["users_count"] = $stmt->rowCount();
        $result["users"] = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}