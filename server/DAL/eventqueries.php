<?php

include "./DAL/db.php";
include "./models/event.php";

//addEvent
function createEvent($eventname, $eventdate)
{
    $db = new DB();
    $connection = $db->getConnection();

    $addsql = "INSERT INTO `events` (eventName, date) VALUES (:eventName, :eventdate)"; 
    $insertStatement = $connection->prepare($addsql);

    $event = getEvent($eventname);
    if ($event !== null) {
       http_response_code(409);//mn fancy tuka
       echo json_encode(["message" => "event with name $eventname already exists"]);
       return; 
    }
    $insertStatement->bindValue(':eventName', $eventname);
    $insertStatement->bindValue(':eventdate', $eventdate);
    $insertStatement->execute();

    return getEvent($eventname);
}

function getEvent($eventname)
{
    try{
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT * FROM events WHERE eventName = ?";
        $selectStatement = $connection->prepare($selectsql);
        $selectStatement->execute([$eventname]);

        $event = null;

    while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
        $event = new Event($row["eventId"], $row["eventName"], $row["date"]);
    }
    if ($event === null) {
        return null;
    } 

    return $event; 
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function getAllEvents()
{
    try{
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT * FROM events";
        $selectStatement = $connection->prepare($selectsql);
        $selectStatement->execute();

        $events = [];

    while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
        array_push($events,new Event($row["eventId"], $row["eventName"], $row["date"]));
    }
    if ($events === null) {
        return null;
    } 

    return $events; 
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

?>