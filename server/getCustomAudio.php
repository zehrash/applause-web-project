<?php
set_include_path(getcwd());
session_start();

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['userId'])) {
    $dir    = './AppData/';
    $files = scandir($dir);
    $output_array = array();

    foreach($files as &$value)
    {
        if($value != "." && $value != "..")
           $output_array[] = array( 'name' => $value);
    }

    echo json_encode($output_array);
}
?>