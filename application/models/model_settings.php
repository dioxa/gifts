<?php

class Model_Settings extends Model {

    public function setProfilePhoto() {
        require_once("application/core/connect_db.php");

        $instance = settings::getInstance();
        $connection = $instance->getConnection();

        $stmt = $connection->prepare("select photo from user where username = '$_SESSION[username]'");

        $stmt->execute();

        $path = $stmt->fetch(PDO::FETCH_ASSOC);
        unlink(substr($path["photo"],1));

        $target_dir = "uploads/profile/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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

        if ($_FILES["fileToUpload"]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                $file_path = "/" . $target_dir . basename($_FILES["fileToUpload"]["name"]);

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