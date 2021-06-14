<?php

set_include_path(getcwd()); 
include './DAL/queries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["userId"])) {
    sendEventToUser($_POST["lastAddedEvent"], $_POST["userId"]);

   echo json_encode(["message" => "send invite successfully"]);
} else{
    echo json_encode(["message" =>'tried to send invite but it didnt work']);
}
?>
