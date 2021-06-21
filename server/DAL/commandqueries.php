<?php
include "./DAL/db.php";
include_once("./models/user.php");

//send command params -> eventID, text, group and row
function sendCommand($eventId, $text, $group, $seatrow)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "INSERT INTO `commands` (eventId, text, usergroup, seatrow, execution) VALUES (:eventId, :text, :usergroup, :seatrow, now())";
        $insertStatement = $connection->prepare($addsql);

        $insertStatement->bindValue(':eventId', $eventId);
        $insertStatement->bindValue(':text', $text);
        $insertStatement->bindValue(':usergroup', $group);
        $insertStatement->bindValue(':seatrow', $seatrow);

        $insertStatement->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function getSavedSeatByUser($eventId, $userId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT reservedSeatId FROM `userevents` WHERE eventId = :eventId AND userId = :userId";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':eventId', $eventId);
        $selectStatement->bindValue(':userId', $userId);
        $selectStatement->execute();

        $seat = null;
        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            $seat = $row["reservedSeatId"];
        }

        return $seat;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function retrieveUser($username)
{

    try {
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT * FROM users WHERE username = :username";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':username', $username);
        $selectStatement->execute();
        $user = null;

        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row["userId"], $row["username"], $row["age"], $row["gender"], $row["role"], $row["rating"], $row["password"]);
        }

        return $user;
    } catch (PDOException $e) {
        return null;
    }
}


function getLastCommand($eventId, $username, $userId)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $user = retrieveUser($username);
        $usergroup = $user->gender;

        $seatID = getSavedSeatByUser($eventId, $userId);

        $seatrow = $seatID[0];


        $selectsql = "SELECT * FROM `commands` WHERE eventId=:eventId
        AND usergroup = :usergroup OR seatrow = :seatrow ORDER BY execution DESC LIMIT 1";

        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':eventId', $eventId);
        $selectStatement->bindValue(':usergroup', $usergroup);
        $selectStatement->bindValue(':seatrow', $seatrow);

        $selectStatement->execute();
        $command = null;
        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            $command = $row["text"];
        }

        return $command;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
