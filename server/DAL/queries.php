<?php

include "./DAL/db.php";
include "./DAL/user.php";

//adduser
function registerUser($username, $age, $gender, $password)
{
    $db = new DB();
    $connection = $db->getConnection();

    $addsql = "INSERT INTO `users` (username, age, gender, role, rating) VALUES (:username, :age, :gender, :role, 0)"; //add them all as basic users for now
    $insertStatement = $connection->prepare($addsql);

    //todo: hash password, add it to db as a field and then insert it;
    $user = getUser($username);
    if ($user != null) {
        echo `user with this username already exists`;
        return;
    }
    $role = 'user';
    echo "username => $username, age => $age, gender => $gender";
    $insertStatement->bindValue(':username', $username);
    $insertStatement->bindValue(':age', $age);
    $insertStatement->bindValue(':gender', $gender);
    $insertStatement->bindValue(':role', $role);
    $insertStatement->execute();
}

//retrieve user data
function getUser($username)
{
    $db = new DB();
    $connection = $db->getConnection();
    $selectsql = "SELECT * FROM users WHERE username = :username";
    $selectStatement = $connection->prepare($selectsql);

    $selectStatement->bindValue(':username', $username);
    $selectStatement->execute();
    $user = null;

    while ($row = $selectStatement->fetch(PDO::FETCH_ASSOC)) {
        $user = new User($row["username"], $row["age"], $row["gender"], $row["role"], $row["rating"]);
    }

    if ($user != null) {
        echo `$user->username exists`;
    }

    return $user;
}
