<?php

set_include_path(getcwd()); 
include './DAL/queries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["userId"])) {
    sendPointsToUser($_POST["userId"]);

   echo json_encode(["message" => "send points successfully"]);
} else{
    echo json_encode(["message" =>'tried to send points but it didnt work']);
}
?>
