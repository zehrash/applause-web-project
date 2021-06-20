<?php
include "./DAL/db.php";
include "./DAL/queries.php";


//send command params -> eventID, text, group and row
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

function getLastCommand($eventId, $username, $userId)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $user = retrieveUser($username);
        $gender = $user->gender;

        $seatID = getSavedSeatByUser($eventId, $userId);
        $firstChar=$seatID[0];

        //$selectsql = "SELECT * FROM `commands` WHERE eventId=:eventId ORDER BY date DESC LIMIT 1";

        $selectsql = "SELECT *FROM commands WHERE eventId=:eventId 
			AND (group = :gender
			OR group = 'o')
			OR row like ':seat%'
            ORDER BY date DESC LIMIT 1";


        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':eventId', $eventId);
        $selectStatement->bindValue(':gender', $gender);
        $selectStatement->bindValue(':seat', $firstChar);

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
