<?php

include "./DAL/db.php";
function getUserLinks($userId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT eventId FROM userevents WHERE userId = :userId";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':userId', $userId);
        $selectStatement->execute();

        $events = [];
        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            array_push($events, $row["eventId"]);
        }
        if (count($events) == 0) {
          
            return null;
        }
        return $events;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

?>