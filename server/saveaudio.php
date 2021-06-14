<?php
set_include_path(getcwd());
session_start();

if (isset($_FILES['userFile']['name'])) {

    $fileTmpName = $_FILES['userFile']['tmp_name'];
    $fileName = $_FILES['userFile']['name'];
    
    $fileContent = file_get_contents($_FILES['userFile']['tmp_name']);

    $location = './AppData/'.$fileName.".mp3";
    $status = file_put_contents($location, $fileContent);
    echo $status;
}
?>