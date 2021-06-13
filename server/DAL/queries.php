<?php

include "./DAL/db.php";
include "./models/user.php";

//adduser
function registerUser($username, $age, $gender, $password)
{
    try {

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
            $user = new User($row["username"], $row["age"], $row["gender"], $row["role"], $row["rating"], $row["password"]);
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


function hashPass($password)
{
    $hash_options = [
        'cost' => 12,
    ];

    return password_hash($password, PASSWORD_BCRYPT, $hash_options);
}
