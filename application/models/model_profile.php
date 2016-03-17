<?php
class Model_Profile extends Model {

    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function get_data() {
        require_once 'application/core/connect_db.php';

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("SELECT firstname, lastname, photo FROM user  WHERE username = :username");
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

        $result["user_info"] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $connection->prepare("SELECT photo FROM gift JOIN (select receiver_id, gift_id from wishes join (select id from user where username = :username) as users on receiver_id = users.id) as wish_list on wish_list.gift_id = id");
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

       $_POST["username"] = $this->username;
        
        if ($stmt->rowCount() > 0) {
            $result["gifts"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $stmt = $connection->prepare("SELECT id, firstname, lastname, photo, username FROM user JOIN (select subscriber_id from subscribers join (select id from user where username = '$this->username') as sub on user_id = sub.id) as subscribers on subscribers.subscriber_id = id");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result["subscribers"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $stmt = $connection->prepare("SELECT id, firstname, lastname, photo, username FROM user JOIN (select user_id from subscribers join (select id from user where username = '$this->username') as sub on subscriber_id = sub.id) as subscribers on subscribers.user_id = id");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result["followers"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

}