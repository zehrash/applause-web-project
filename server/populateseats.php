<?php
set_include_path(getcwd());
include_once("./DAL/queries.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "GET" /*&& isset($_SESSION['eventId']*/) {
    $seats = getSavedSeats(1);
    
    $response = json_encode([
        'success' => true,
        'message' => "Seat information received",
        'value' => $seats
    ]);
    echo $response;
} else {
    $response = json_encode([
        'success' => false,
        'message' => "Seat information weren't received",
        // 'value' => "Welcome" . "UKNOWN"
    ]);
    echo $response;
}
