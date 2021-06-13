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
       echo json_encode("event with name $eventname already exists");
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

?>