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

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $imageFileType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        do {
            $info = md5(microtime() . rand(0, 9999));
            $target_dir = "uploads" . "/" . substr($info, 0 , 5). "/" . substr($info, 6 , 5) . "/";
            $target_file = $target_dir . substr($info, 7 , 5) . ".$imageFileType";
        } while (file_exists($target_file));

        $uploadOk = 1;


        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            mkdir($target_dir, 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $file_path = "/" . $target_file;
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