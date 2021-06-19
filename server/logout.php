<?php

set_include_path(getcwd());

if ($_SERVER['REQUEST_METHOD'] === "GET") {
   
    
    $response = json_encode([
        "success" => true,
        "message" => "logout successfuly"
    ]);
    
    session_destroy();
    
    echo $response;
}
else {
    $response=json_encode([
        "success" => false,
        "message" => "couldn't logout"
    ]);

    echo $response;
}

?>