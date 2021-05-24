<?php
set_include_path(getcwd()); //D:\install\xampp\htdocs\web_final_project\applause-web-project\server
include './DAL/queries.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["age"])) {
    $registered = registerUser($_POST["username"], $_POST["age"], $_POST["gender"], $_POST["password"]);
    // $_SESSION['username'] = $registered['username'];  
    //$_SESSION['password'] = $registered['password'];  
    return $registered;
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $loggedIn = getUser($_POST["username"]);
    echo $loggedIn;
}
