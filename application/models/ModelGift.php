<?php
class ModelGift extends Model {

    public function getData($giftId) {
        require_once("application/core/Connect.php");

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("Select id, name, description, photo from gift where id = '$giftId'");
        $query->execute();

        //error_log( "Getting information about gift".print_R($query->errorInfo(),TRUE) );

        $result["gift"] = $query->fetch(PDO::FETCH_ASSOC);

        $query = $connection->prepare("select username from user JOIN (SELECT reciever_id from wishes where gift_id = '$giftId') as gift on gift.reciever_id = id");
        $query->execute();

        //error_log( "Check owner".print_R($query->errorInfo(),TRUE) );

        if ($query->rowCount() > 0) {
            $result["owner"] = true;
        }
        
        return $result;
    }

    public function bindGift($id) {
        require_once("application/core/Connect.php");

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("UPDATE wishes SET sender_id=:userId WHERE gift_id='$id'");
        $query->bindParam(':userId', $_SESSION["id"]);
        $query->execute();
        //error_log( "Bind gift".print_R($query->errorInfo(),TRUE) );
    }

    public function addGift($giftInfo) {
        require_once("application/core/Connect.php");
        require_once ("application/core/UploadValidator.php");

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $file = UploadValidator::validateImage();
        
        if ($file !== false) {
            mkdir($file['targetDir'], 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $file['targetFile'])) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $filePath = "/" . $file['targetFile'];
                $date_created = date("YmdHis");;

                $query = $connection->prepare("INSERT INTO gift (name, description, date_created, photo) VALUES ('$giftInfo[name]',
                '$giftInfo[desc]', $date_created, '$filePath')");
                $query->bindParam(":username", $_SESSION["username"]);

                $query->execute();

                //error_log( "Adding at gifts".print_R($query->errorInfo(),TRUE) );

                $query = $connection->prepare("INSERT INTO wishes (receiver_id, gift_id) VALUES (:userId, (SELECT id from gift where photo = '$filePath'))");
                $query->bindParam(":userId", $_SESSION["id"]);

                $query->execute();

                //error_log( "Adding at wishes".print_R($query->errorInfo(),TRUE) );

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

}