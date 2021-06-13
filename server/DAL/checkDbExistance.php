<?php

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "";


try {
    $db = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $create_query = "SHOW DATABASES LIKE 'applause_gen'";

    $stmt = $db->prepare($create_query);
    $stmt->execute();

    $database = null;
    $counter = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $counter++;
        $database = $row;
    }
    if ($database === null) {
       echo json_encode(["message" => "no db, we creating one now"]);//if this is returned, execute the create script
    }
    else {
        echo json_encode(["message" => "you have a db"]);
    }
} catch (PDOException $e) {
    http_response_code(404);//todo: add all the response codes everywhere
    echo json_encode(["message" => "something went very wrong"]);
}
?>