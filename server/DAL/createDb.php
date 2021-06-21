<?php
function createDb()
{

    $mysql_host = "localhost";
    $mysql_user = "root";
    $mysql_password = "";

    $db = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $create_query = "CREATE DATABASE IF NOT EXISTS `applause_gen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $db->exec($create_query);

    $query = file_get_contents("./applause_gen.sql", FILE_USE_INCLUDE_PATH);

    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Success"]);
        $insertquery = file_get_contents("./applause_gen_inserts.sql", FILE_USE_INCLUDE_PATH);
        $insertstmt = $db->prepare($insertquery);
        $insertstmt->execute();
    } else
        echo json_encode(["message" => "Fail"]);
}
createDb();
