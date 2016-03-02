<?php
class Model_Gift extends Model {

    public function addGift($gift_info) {
        require_once("application/core/connect_db.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $target_dir = "uploads/gifts/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $file_path = "/" . $target_dir . basename($_FILES["image"]["name"]);
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