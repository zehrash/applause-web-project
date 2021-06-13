<?php
set_include_path(getcwd()); 
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["seatId"])) {
    $savedseat = saveSeat($_POST["userId"], $_POST["eventId"], $_POST["seatId"]);

    $_SESSION['seatId'] = $savedseat->seatId;
} else{
    echo json_encode('tried to save seat but it didnt work');//todo: add error handling   
}
?>
