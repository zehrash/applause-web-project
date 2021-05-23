<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<?php
    set_include_path(getcwd());//D:\install\xampp\htdocs\web_final_project\applause-web-project\server
    include './DAL/queries.php';


    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['register'])) {
        echo 'registering';
        //removeProduct($_POST["name"], $_POST["quantity"]);
    } 
    //echo setUser('pesho')->rating;
   //todo: handle register and login
?>
</body>
</html>