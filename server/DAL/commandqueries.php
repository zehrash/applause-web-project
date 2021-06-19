<?php
include "./DAL/db.php";

function sendCommand($eventId, $text)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "INSERT INTO `commands` (eventId, text, execution) VALUES (:eventId, :text, now())";
        $insertStatement = $connection->prepare($addsql);

        $insertStatement->bindValue(':eventId', $eventId);
        $insertStatement->bindValue(':text', $text);

        $insertStatement->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getLastCommand($eventId)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $selectsql = "SELECT * FROM `commands` WHERE eventId= ? ORDER BY execution DESC LIMIT 1";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->execute([$eventId]);
        $command = null;
        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            $command = $row["text"];
        }

        return $command;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
