<?php
include "application/core/Logger.php";

class ModelSearch extends Model {

    public function getProfile($username) {
        $query = $this->connection->prepare("SELECT username, firstname, lastname, photo FROM user where username like '$username%';");

        $query->execute();
        Logger::sqlError($query->errorInfo());

        $result["usersCount"] = $query->rowCount();
        $result["users"] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}