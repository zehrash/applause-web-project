<?php
function createDb()
{

     //set_include_path(getcwd());
     $mysql_host = "localhost";
     $mysql_database = "applause_gen.sql";
     $mysql_user = "root";
     $mysql_password = "";
     # MySQL with PDO_MYSQL  \
     echo 'in';
     $db = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $create_query = "CREATE DATABASE IF NOT EXISTS `applause_gen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
     $db->exec($create_query);

     echo "Database created successfully with the name newDB";

// change path name according to local machine 
     $query = file_get_contents("D:\\xampp\\htdocs\\applause-web-project\\server\\DAL\\applause_gen.sql");

     $stmt = $db->prepare($query);

     if ($stmt->execute())
          echo "Success";
     else
          echo "Fail";

}
createDb();
