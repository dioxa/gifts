<?php
echo"<form action='/settings/setphoto' method='post' enctype='multipart/form-data'>
    Select image to upload:
    <input type='file' name='image' accept='image/jpeg, image/png' id='fileToUpload'>
    <input type='submit' value='Upload Image' name='submit'>
</form>";
?>