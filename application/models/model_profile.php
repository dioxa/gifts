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
        
        $stmt = $connection->prepare("SELECT photo FROM gift JOIN (select receiver_id, gift_id from wishes join (select id from user where username = :username) as user on receiver_id = user.id) as wish_list on wish_list.gift_id = id");
        $stmt->bindParam(":username", $this->username);

        $stmt->execute();

       $_POST["username"] = $this->username;

        if ($stmt->rowCount() > 0) {
            $result["gift_info"] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

}