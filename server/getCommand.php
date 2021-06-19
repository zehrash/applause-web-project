<?php
set_include_path(getcwd());
include_once("./DAL/commandqueries.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['eventId'])) {
    /*echo $_SESSION['eventId'];*/
    $koma = getLastCommand($_SESSION['eventId']);
    $response = json_encode([
        'success' => true,
        'message' => "Command retrived successfully",
        'value' => $koma
    ]);

    echo $response;
} else {
    $response = json_encode([
        'success' => false,
        'message' => "No command retrieved"
    ]);
    echo $response;
}
