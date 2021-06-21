<?php

set_include_path(getcwd()); 
require_once( './DAL/queries.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["seatId"])) {
 
    $savedseatId = saveSeat($_SESSION["eventId"], $_SESSION["userId"], $_POST["seatId"]);

   $_SESSION['seatId'] = $savedseatId;
  // echo json_encode(["message" => "seat save successfully"]);

   $response = json_encode([
    "message" => "seat save successfully", 
    "seat" => $_POST["seatId"],
    "userid " => $_SESSION["userId"],
    "eventid" =>$_SESSION["eventId"]
]);
echo $response;
} else{
    echo json_encode(["message" =>'tried to save seat but it didnt work']);
}
?>
