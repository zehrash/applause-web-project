<?php
set_include_path(getcwd());
include_once("./DAL/usereventqueries.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['userId'])) {
    $events = getUserLinks($_SESSION['userId']);
    
    $response = json_encode([
        'success' => true,
        'message' => "links information received",
        'value' => $events
    ]);
    echo $response;
} else {
    $response = json_encode([
        'success' => false,
        'message' => "links information not received",
    ]);
    echo $response;
}
?>