<?php
class Model_Gift extends Model {

    public function get_data($giftId) {
        require_once("application/core/connect_db.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("Select id, name, description, photo from gift where id = '$giftId'");
        $query->execute();

        $result["gift"] = $query->fetch(PDO::FETCH_ASSOC);

        $query = $connection->prepare("select username from user JOIN (SELECT reciever_id from wishes where gift_id = '$giftId') as gift on gift.reciever_id = id");
        $query->execute();

        if ($query->rowCount() > 0) {
            $result["owner"] = true;
        }
        
        return $result;
    }

    public function bindGift($id) {
        require_once("application/core/connect_db.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("UPDATE wishes SET sender_id=:userId WHERE gift_id='$id'");
        $query->bindParam(':userId', $_SESSION["id"]);
        $query->execute();
    }

    public function addGift($gift_info) {
        require_once("application/core/connect_db.php");
        require_once ("application/core/upload_image.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $file = UploadImage::validateImage();
        
        if ($file !== false) {
            mkdir($file['target_dir'], 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $file['target_file'])) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $file_path = "/" . $file['target_file'];
                $date_created = date("YmdHis");;

                $query = $connection->prepare("INSERT INTO gift (name, description, date_created, photo) VALUES ('$gift_info[name]',
                '$gift_info[desc]', $date_created, '$file_path')");
                $query->bindParam(":username", $_SESSION["username"]);

                $query->execute();

                $query = $connection->prepare("INSERT INTO wishes (receiver_id, gift_id) VALUES (:user_id, (SELECT id from gift where photo = '$file_path'))");
                $query->bindParam(":user_id", $_SESSION["id"]);

                $query->execute();

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

}