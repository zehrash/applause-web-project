<?php
include './DAL/queries.php';
if ($_SERVER['REQUEST_METHOD'] === "GET"){
    echo json_encode(getAllUsers($_SESSION["userId"]));
    exit();
}
?>