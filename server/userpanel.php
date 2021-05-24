<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="demo">

    </div>
</body>

</html>
<?php
    session_start();

    if(isset($_SESSION['username'])){
//this doesnt work 
        echo "Welcome" .$_SESSION['username'];//."<br/> ";
    }
?>