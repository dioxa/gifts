<?php
echo"<form action='/gift/adding' method='post' enctype='multipart/form-data'>
    Select image to upload:
    <input type='file' name='image' id='fileToUpload'>
    <input type='text' name='gift[name]'>
    <textarea name='gift[desc]'></textarea>
    <input type='submit' value='Upload Image' name='submit'>
</form>";