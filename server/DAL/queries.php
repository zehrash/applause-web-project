<?php

include "./DAL/db.php";
include "./models/user.php";

//adduser
function registerUser($username, $age, $gender, $role, $password)
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "INSERT INTO users (username, age, gender, role, rating, password) VALUES (:username, :age, :gender, :role, 0, :password)";
        $insertStatement = $connection->prepare($addsql);

        $user = getUser($username, $password);
        if ($user !== null) {
            http_response_code(409);
            echo json_encode(["message" => "user with username $username already exists"]);
            return;
        }
        $hashedPass = hashPass($password);

        // echo "username => $username, age => $age, gender => $gender";
        $insertStatement->bindValue(':username', $username);
        $insertStatement->bindValue(':age', $age);
        $insertStatement->bindValue(':gender', $gender);
        $insertStatement->bindValue(':role', $role);
        $insertStatement->bindValue(':password', $hashedPass);
        $insertStatement->execute();
    } catch (PDOException $e) {
        return null;
    }
    return getUser($username, $password);
}

//retrieve user data
function getUser($username, $password)
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

        if ($user === null) {
            return null;
        } else if (!password_verify($password, $user->password)) {
            return json_encode(["status" => "ERROR", "message" => "user password doesn't match"]);
        }

        return $user;
    } catch (PDOException $e) {
        return null;
    }
}

function getAllUsers($userId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();
        $selectsql = "SELECT * FROM users WHERE role = 'user'";
        $selectStatement = $connection->prepare($selectsql);

        $selectStatement->execute();
        $users = [];

        while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
            if ($userId == $row["userId"]) {
                break;
            }

            array_push($users, new User($row["userId"], $row["username"], $row["age"], $row["gender"], $row["role"], $row["rating"], $row["password"]));
        }

        if (count($users) == 0) {
            return null;
            exit();
        }
        return $users;
    } catch (PDOException $e) {
        return null;
    }
}

function hashPass($password)
{
    $hash_options = [
        'cost' => 12,
    ];

    return password_hash($password, PASSWORD_BCRYPT, $hash_options);
}

function updateUserRole($userId, $newRole)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();
        $updatesql =  'UPDATE users
        SET role= = :role
        WHERE userId=:userId';
        $updateStatement = $connection->prepare($updatesql);

        $updateStatement->bindValue(':userId', $userId);
        $updateStatement->bindValue(':role', $newRole);
        $updateStatement->execute();
        $user = null;

        return $user;
    } catch (PDOException $e) {
        return null;
    }
}


function resetUserRoles()
{
    try {

        $db = new DB();
        $connection = $db->getConnection();

        $updatesql = "UPDATE `users` SET role = 'user' WHERE role = 'host'";
        $updateStatement = $connection->prepare($updatesql);
        $updateStatement->execute();
    } catch (PDOException $e) {
        echo json_encode(["text" => $e->getMessage()]);
    }
}

function sendEventToUser($eventId, $userId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "INSERT INTO `userevents` (eventId, userId, reservedSeatId) VALUES (:eventId, :userId, 0)";
        $insertStatement = $connection->prepare($addsql);

        $insertStatement->bindValue(':userId', $userId);
        $insertStatement->bindValue(':eventId', $eventId);
        $insertStatement->execute();
    } catch (PDOException $e) {
        echo json_encode(["text" => $e->getMessage()]);
    }
}

function sendPointsToUser($userId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "UPDATE `users` SET rating = rating+5 WHERE userId = :userId";
        $insertStatement = $connection->prepare($addsql);

        $insertStatement->bindValue(':userId', $userId);
        $insertStatement->execute();
    } catch (PDOException $e) {
        return null;
    }
}

function saveSeat($eventId, $userId, $seatId)
{
    try {
        $db = new DB();
        $connection = $db->getConnection();

        $addsql = "INSERT INTO `userevents` (eventId, userId, reservedSeatId) VALUES (:eventId, :userId, :reservedSeatId)";
        $insertStatement = $connection->prepare($addsql);

        $insertStatement->bindValue(':userId', $userId);
        $insertStatement->bindValue(':eventId', $eventId);
        $insertStatement->bindValue(':reservedSeatId', $seatId);
        $insertStatement->execute();

        return $seatId;
    } catch (PDOException $e) {
        return null;
    }
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

        $seats = [];
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
