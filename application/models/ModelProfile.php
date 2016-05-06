<?php
include "application/core/Logger.php";

class ModelProfile extends Model {

    public function getData($username) {

        $query = $this->connection->prepare("SELECT firstname, lastname, photo, id FROM user  WHERE username = :username");
        $query->bindParam(":username", $username);

        $query->execute();
        Logger::sqlError($query->errorInfo());

        $result["userInfo"] = $query->fetch(PDO::FETCH_ASSOC);
        
        $query = $this->connection->prepare("SELECT photo, id FROM gift JOIN (select receiver_id, gift_id from wishes join (select id from user where username = :username) as users on receiver_id = users.id) as wish_list on wish_list.gift_id = id");
        $query->bindParam(":username", $username);

        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["gifts"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($_SESSION["username"])) {
            if ($_SESSION["username"] != $username) {
                $result["pageGuest"] = true;
                $query = $this->connection->prepare("SELECT subscriber_id from subscribers JOIN (select id from user where username = '$username') as users on subscriber_id = users.id where user_id = :username");
                $query->bindParam(":username", $_SESSION["id"]);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    $result["following"] = true;
                }
            }
        } else {
            $_POST["guest"] = true;
        }
        
        $query = $this->connection->prepare("SELECT id, firstname, lastname, photo, username FROM user JOIN (select subscriber_id from subscribers join (select id from user where username = '$username') as sub on user_id = sub.id) as subscribers on subscribers.subscriber_id = id");

        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["subscribers"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $query = $this->connection->prepare("SELECT id, firstname, lastname, photo, username FROM user JOIN (select user_id from subscribers join (select id from user where username = '$username') as sub on subscriber_id = sub.id) as subscribers on subscribers.user_id = id");

        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["followers"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $result;
    }

    public function subscribe() {
        $query = $this->connection->prepare("insert into subscribers(user_id, subscriber_id) values (:userId, :username)");

        $query->bindParam(":userId", $_SESSION["id"]);
        $query->bindParam(":username", $_POST["username"]);

        $query->execute();
        Logger::sqlError($query->errorInfo());
    }

    public function unsubscribe() {
        $query = $this->connection->prepare("DELETE FROM subscribers WHERE user_id = :userId AND subscriber_id = :username");

        $query->bindParam(":userId", $_SESSION["id"]);
        $query->bindParam(":username", $_POST["username"]);

        $query->execute();
        Logger::sqlError($query->errorInfo());
    }
}