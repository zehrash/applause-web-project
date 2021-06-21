<?php
include './DAL/queries.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === "GET"){
    echo json_encode(getAllUsers($_SESSION["userId"]));
    exit();
}
?>