<?php
set_include_path(getcwd()); //D:\install\xampp\htdocs\web_final_project\applause-web-project\server
include './DAL/queries.php';
//include './DAL/createDb.php';
session_start();
//createDb();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["age"])) {
    $registered = registerUser($_POST["username"], $_POST["age"], $_POST["gender"], $_POST["password"]);

    $_SESSION['username'] = $registered->username;
    $_SESSION['password'] = $registered->password;
    $_SESSION['userId'] = $registered->userId;

} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $loggedIn = getUser($_POST["username"], $_POST["password"]);
    if($loggedIn) {
        $_SESSION['username'] = $loggedIn->username;
        $_SESSION['password'] = $loggedIn->password;
        $_SESSION['age'] = $loggedIn->age;
        $_SESSION['userId'] = $loggedIn->userId;
        echo json_encode("logged in successfuly");
    } else {
        echo json_encode('tried to log in but it didnt work');//todo: add error handling
    }
}
?>
