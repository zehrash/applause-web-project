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
    $hash_options = [
        'cost' =>12,
    ];
    
    $hashedPass = password_hash($password, PASSWORD_BCRYPT, $hash_options);

    $user = getUser($username);
    if ($user !== null) {
       // echo "user with this username already exists\n";
       echo json_encode("user with username $username already exists");
       return; 
    }

    $role = 'user';
   // echo "username => $username, age => $age, gender => $gender";
    $insertStatement->bindValue(':username', $username);
    $insertStatement->bindValue(':age', $age);
    $insertStatement->bindValue(':gender', $gender);
    $insertStatement->bindValue(':role', $role);
    $insertStatement->execute();

    echo getUser($username);
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

    if ($user === null) {
        return null;
    }

    return json_encode($user); 
}
