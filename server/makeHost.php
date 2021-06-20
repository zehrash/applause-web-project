<?php
set_include_path(getcwd()); 
include './DAL/queries.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["userId"])) {
    updateUserRole($_POST["userId"], $_POST["role"]);
} else{
    
}

?>