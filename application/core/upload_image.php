<?php
class UploadImage {

    static function validateImage() {
        $imageFileType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        do {
            $info = md5(microtime() . rand(0, 9999));
            $target_dir = "uploads" . "/" . substr($info, 0 , 5). "/" . substr($info, 6 , 5) . "/";
            $target_file = $target_dir . substr($info, 7 , 5) . ".$imageFileType";
        } while (file_exists($target_file));


        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                return false;
            }
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return false;
        }

        return array(
            "target_dir" => $target_dir,
            "target_file" => $target_file
        );

    }
}