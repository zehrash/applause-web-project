<?php
set_include_path(getcwd());
include "./DAL/commandqueries.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['eventId'])) {
    $command = getLastCommand($_SESSION['eventId'], $_SESSION['username'], $_SESSION['userId']);
  //  $command = retrieveUser($_SESSION['username']);
    $response = json_encode([
        'success' => true,
        'message' => "Command retrived successfully",
        'value' => $command
    ]);

    echo $response;
} else {
    $response = json_encode([
        'success' => false,
        'message' => "No command retrieved"
    ]);
    echo $response;
}
