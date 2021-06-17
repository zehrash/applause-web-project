<?php

set_include_path(getcwd()); 
include './DAL/commandqueries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["eventId"])) {
   sendCommand($_POST["eventId"], $_POST["text"]);

   echo json_encode(["message" => "command sent successfully"]);
} else{
    echo json_encode(["message" =>'tried to sent command but it didnt work']);//todo: add error handling   
}

?>