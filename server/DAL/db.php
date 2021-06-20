<?php

class DB
{
    private $connection;

    function __construct()
    {

        $db_configs = parse_ini_file("database.ini");

        $dsn = "mysql:host=".$db_configs['host'].";dbname=".$db_configs['dbname'];

        $this->connection = new PDO($dsn, $db_configs['username'], $db_configs['password']);
    }

    function getConnection()
    {
        return $this->connection;
    }
}


?>