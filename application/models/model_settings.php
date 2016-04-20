<?php

class Model_Settings extends Model {

    public function setProfilePhoto() {
        require_once("application/core/connect_db.php");
        require_once ("application/core/uploadValidator.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("select photo from user where username = '$_SESSION[username]'");

        $stmt->execute();

        $path = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($path["info"] != "/uploads/profile/mzl.qdfvhgoj.jpg") {
            unlink(substr($path["photo"], 1));
        }

        $file = UploadValidator::validateImage();

        if ($file !== false) {
            mkdir($file['targetDir'], 0777, true);
            if ( move_uploaded_file($_FILES["image"]["tmp_name"], $file['targetFile'])) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $filePath = "/" . $file['targetFile'];

                $query = $connection->prepare("update user set photo = '$filePath' where username = :username");
                $query->bindParam(":username", $_SESSION["username"]);

                $query->execute();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>