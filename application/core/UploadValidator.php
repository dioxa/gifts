<?php
class UploadValidator {

    static function validateImage() {
        $imageFileType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        do {
            $info = md5(microtime() . rand(0, 9999));
            $targetDir = "uploads" . "/" . substr($info, 0 , 5). "/" . substr($info, 6 , 5) . "/";
            $targetFile = $targetDir . substr($info, 7 , 5) . ".$imageFileType";
        } while (file_exists($targetFile));


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
            "targetDir" => $targetDir,
            "targetFile" => $targetFile
        );

    }
}