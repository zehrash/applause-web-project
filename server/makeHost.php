<?php
set_include_path(getcwd()); 
include './DAL/queries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["userId"])) {
    updateUserRole($_POST["userId"], 1, $_POST["seatId"]);

    $_SESSION['seatId'] = $savedseatId;
   echo json_encode(["message" => "seat save successfully"]);
} else{
    echo json_encode(["message" =>'tried to save seat but it didnt work']);//todo: add error handling   
}

?>