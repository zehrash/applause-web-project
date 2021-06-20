<?php
set_include_path(getcwd()); 
include './DAL/queries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["age"])) {
    $registered = registerUser($_POST["username"], $_POST["age"], $_POST["gender"], $_POST["role"], $_POST["password"]);
//todo: lusi jwt pls
    $_SESSION['userId'] = $registered->userId;
    $_SESSION['username'] = $registered->username;
    $_SESSION['age'] = $registered->age;
    setcookie("userId", $registered->userId ,time()+3600);

    resetUserRoles();
    echo json_encode(["message" => "registered successfuly"]);
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $loggedIn = getUser($_POST["username"], $_POST["password"]);
    if($loggedIn) {
        $_SESSION['userId'] = $loggedIn->userId;
        $_SESSION['username'] = $loggedIn->username;
        $_SESSION['age'] = $loggedIn->age;
        $_SESSION['role'] = $loggedIn->role;
        setcookie("userId", $loggedIn->userId ,time()+3600);
        echo json_encode(["message" => "logged in successfuly",
                          'value' => $loggedIn->role]);
    } else {
        echo json_encode(["message" =>"tried to log in but it didnt work"]);
    }
}
