<?php

class Model_Settings extends Model {

    public function setProfilePhoto() {
        require_once("application/core/connect_db.php");
        require_once ("application/core/upload_image.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("select photo from user where username = '$_SESSION[username]'");

        $stmt->execute();

        $path = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($path["info"] != "/uploads/profile/mzl.qdfvhgoj.jpg") {
            unlink(substr($path["photo"], 1));
        }

        $file = UploadImage::validateImage();

        if ($file !== false) {
            mkdir($file['target_dir'], 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $file['target_file'])) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $file_path = "/" . $file['target_file'];

                $query = $connection->prepare("update user set photo = '$file_path' where username = :username");
                $query->bindParam(":username", $_SESSION["username"]);

                $query->execute();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>