<?php
set_include_path(getcwd()); 
include './DAL/eventqueries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $event = createEvent($_POST["eventname"], $_POST["eventdate"]);
    $response = json_encode([
        "message" => "created event successfuly", 
        "eventId" => $event->eventId,
        "eventName" => $event->eventName,
        "eventDate" => $event->date
    ]);

    echo $response;
}
?>
