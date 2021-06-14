<?php
session_start();

if (isset($_SESSION['username'])) {
    $response = json_encode([
        'success' => true,
        'message' => "User credentials send",
        'value' => "Welcome " . $_SESSION['username'].' !'
    ]);
    echo $response;
} else{
    $response = json_encode([
        'success' => false,
        'message' => "User credentials didn't send",
        'value' => "Welcome" . "UKNOWN"
    ]);
    echo $response;
}
?>