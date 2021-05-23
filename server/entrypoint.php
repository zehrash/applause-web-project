<?php
    set_include_path(getcwd());//D:\install\xampp\htdocs\web_final_project\applause-web-project\server
    include './DAL/queries.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['register'])) {
        echo 'registering';
        registerUser($_POST["username"], $_POST["age"], $_POST["gender"],$_POST["password"]);
    } 
    //echo getUser('pesho')->rating;
   //todo: handle register and login
?>