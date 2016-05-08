<?php
include "application/core/Logger.php";

class ModelGift extends Model {

    public function getData($giftId) {
        $query = $this->connection->prepare("Select id, name, description, photo from gift where id = '$giftId'");
        $query->execute();

        Logger::sqlError($query->errorInfo());
        
        $result["gift"] = $query->fetch(PDO::FETCH_ASSOC);

        $query = $this->connection->prepare("select * from wishes where gift_id = '$giftId'");
        $query->execute();

        $gift = $query->fetch(PDO::FETCH_ASSOC);

        if ($gift["receiver_id"] == $_SESSION["id"]) {
            $result["owner"] = true;
        } else if (isset($gift["sender_id"])) {
                if ($gift["sender_id"] == $_SESSION["id"]) {
                    $result["sender"] = true;
                } else {
                    $result["flagged"] = true;
                }
        }
        return $result;
    }

    public function bindGift($id) {
        $query = $this->connection->prepare("UPDATE wishes SET sender_id=:userId WHERE gift_id='$id'");
        $query->bindParam(':userId', $_SESSION["id"]);
        $query->execute();
        Logger::sqlError($query->errorInfo());
    }

    public function addGift($giftInfo) {
        require_once ("application/core/UploadValidator.php");

        $file = UploadValidator::validateImage();
        
        if ($file !== false) {
            mkdir($file['targetDir'], 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $file['targetFile'])) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $filePath = "/" . $file['targetFile'];
                $date_created = date("YmdHis");;

                $query = $this->connection->prepare("INSERT INTO gift (name, description, date_created, photo) VALUES ('$giftInfo[name]',
                '$giftInfo[desc]', $date_created, '$filePath')");
                $query->bindParam(":username", $_SESSION["username"]);

                $query->execute();
                Logger::sqlError($query->errorInfo());

                $query = $this->connection->prepare("INSERT INTO wishes (receiver_id, gift_id) VALUES (:userId, (SELECT id from gift where photo = '$filePath'))");
                $query->bindParam(":userId", $_SESSION["id"]);

                $query->execute();

                Logger::sqlError($query->errorInfo());

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function deleteGift($id) {
        $query = $this->connection->prepare("SELECT receiver_id FROM wishes WHERE gift_id = '$id'");
        $query->execute();

        $owner = $query->fetch(PDO::FETCH_ASSOC);

        if ($owner["receiver_id"] == $_SESSION["id"]) {
            $query = $this->connection->prepare("Select photo from gift where id = '$id'");
            $query->execute();
            Logger::sqlError($query->errorInfo());

            $photo = $query->fetch(PDO::FETCH_ASSOC);
            unlink(substr($photo, 1));

            $query = $this->connection->prepare("DELETE FROM wishes where gift_id = '$id'");
            $query->execute();
            Logger::sqlError($query->errorInfo());

            $query = $this->connection->prepare("DELETE FROM gift where id = '$id'");
            $query->execute();
            Logger::sqlError($query->errorInfo());
        }
    }

}