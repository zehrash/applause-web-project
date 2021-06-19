<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["eventId"])) {
    $_SESSION['eventId'] = $_POST["eventId"];
   echo json_encode(["message" => "event id set" ]);
} else{
    echo json_encode(["message" =>'tried to save eventId but it didnt work']);//todo: add error handling   
}

?>