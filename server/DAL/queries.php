<?php

include "./DAL/db.php";
include "./models/user.php";

//adduser
function registerUser($username, $age, $gender, $password)
{
    $db = new DB();
    $connection = $db->getConnection();

    $addsql = "INSERT INTO `users` (username, age, gender, role, rating, password) VALUES (:username, :age, :gender, :role, 0, :password)"; //add them all as basic users for now
    $insertStatement = $connection->prepare($addsql);

    $user = getUser($username, $password);
    if ($user !== null) {
        echo json_encode("user with username $username already exists");
        return;
    }
    $hashedPass = hashPass($password);
    $role = 'user';
    // echo "username => $username, age => $age, gender => $gender";
    $insertStatement->bindValue(':username', $username);
    $insertStatement->bindValue(':age', $age);
    $insertStatement->bindValue(':gender', $gender);
    $insertStatement->bindValue(':role', $role);
    $insertStatement->bindValue(':password', $hashedPass);
    $insertStatement->execute();

    return getUser($username, $password);
}

//retrieve user data
function getUser($username, $password)
{
    //todo: try catch
    $db = new DB();
    $connection = $db->getConnection();
    $selectsql = "SELECT * FROM users WHERE username = :username";
    $selectStatement = $connection->prepare($selectsql);

    $selectStatement->bindValue(':username', $username);
    $selectStatement->execute();
    $user = null;

    while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
        $user = new User($row["username"], $row["age"], $row["gender"], $row["role"], $row["rating"], $row["password"]);
    }

    if ($user === null) {
        return null;
    } else if (!password_verify($password, $user->password)) {
        return json_encode(["status" => "ERROR", "message" => "user password doesn't match"]);
    }

    return $user;
}

function hashPass($password)
{
    $hash_options = [
        'cost' => 12,
    ];

    return password_hash($password, PASSWORD_BCRYPT, $hash_options);
}


function saveSeat($eventId, $userId, $seatId)
{
    $db = new DB();
    $connection = $db->getConnection();

    $addsql = "INSERT INTO `userevents` (eventId, userId, seatId) VALUES (:eventId, :userId, :seatId)";
    $insertStatement = $connection->prepare($addsql);

    $insertStatement->bindValue(':userId', $userId);
    $insertStatement->bindValue(':eventId', $eventId);
    $insertStatement->bindValue(':seatId', $seatId);
    $insertStatement->execute();

    return $seatId;
}

function getSavedSeats($eventId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT reservedSeatId FROM userevents WHERE eventId = :eventId";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->bindValue(':eventId', $eventId);
        $selectStatement->execute();

        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            array_push($seats, $row["reservedSeatId"]);
        }
        if (count($seats) == 0) {
            return null;
        }

        return $seats;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
