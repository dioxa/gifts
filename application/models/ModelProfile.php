<?php
include "application/core/Logger.php";

class ModelProfile extends Model {

    public function getData($username) {

        $query = $this->connection->prepare("SELECT firstname, lastname, photo, id FROM user  WHERE username = :username");
        $query->bindParam(":username", $username);

        $query->execute();
        Logger::sqlError($query->errorInfo());

        $result["userInfo"] = $query->fetch(PDO::FETCH_ASSOC);
        
        $query = $this->connection->prepare("SELECT photo, id FROM gift JOIN (select receiver_id, gift_id from wishes where receiver_id = :userId) as wish_list on wish_list.gift_id = id");
        $query->bindParam(":userId", $result["userInfo"]["id"]);

        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["gifts"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($_SESSION["username"])) {
            if ($_SESSION["username"] != $username) {
                $result["pageGuest"] = true;
                $query = $this->connection->prepare("SELECT subscriber_id from subscribers WHERE subscriber_id = :pageId and user_id = :userId");
                $query->bindParam(":userId", $_SESSION["id"]);
                $query->bindParam(":pageId", $result["userInfo"]["id"]);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    $result["following"] = true;
                }
            }
        } else {
            $_POST["guest"] = true;
        }
        
        $query = $this->connection->prepare("SELECT firstname, lastname, photo, username FROM user JOIN (select subscriber_id from subscribers WHERE user_id = :id) as subscribers on subscribers.subscriber_id = id");
        $query->bindParam(":id", $result["userInfo"]["id"]);
        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["subscribers"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $query = $this->connection->prepare("SELECT firstname, lastname, photo, username FROM user JOIN (select user_id from subscribers where subscriber_id = :id) as subscribers on subscribers.user_id = id");
        $query->bindParam(":id", $result["userInfo"]["id"]);
        $query->execute();
        Logger::sqlError($query->errorInfo());

        if ($query->rowCount() > 0) {
            $result["followers"] = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $result;
    }

    public function subscribe() {
        $query = $this->connection->prepare("insert into subscribers(user_id, subscriber_id) values (:userId, :pageId)");

        $query->bindParam(":userId", $_SESSION["id"]);
        $query->bindParam(":pageId", $_POST["userId"]);

        $query->execute();
        Logger::sqlError($query->errorInfo());
    }

    public function unsubscribe() {
        $query = $this->connection->prepare("DELETE FROM subscribers WHERE user_id = :userId AND subscriber_id = :pageId");

        $query->bindParam(":userId", $_SESSION["id"]);
        $query->bindParam(":pageId", $_POST["userId"]);

        $query->execute();
        Logger::sqlError($query->errorInfo());
    }
}