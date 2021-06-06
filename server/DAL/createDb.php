<?php
function createDb() {
    
    //set_include_path(getcwd());
    $mysql_host = "localhost";
    $mysql_database = "applause_gen";
    $mysql_user = "root";
    $mysql_password = "";
    # MySQL with PDO_MYSQL  \
    echo 'in';
    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
    
    $query = file_get_contents("D:\\install\\xampp\\htdocs\\web_final_project\\applause-web-project\\server\\DAL\\applause_gen.sql");
    
    $stmt = $db->prepare($query);
    
    if ($stmt->execute())
         echo "Success";
    else 
         echo "Fail";
}
?>
 
