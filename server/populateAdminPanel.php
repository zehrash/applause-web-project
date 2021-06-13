<?php
include './DAL/eventqueries.php';
if ($_SERVER['REQUEST_METHOD'] === "GET"){
    echo json_encode(getAllEvents());
    exit();
}
?>