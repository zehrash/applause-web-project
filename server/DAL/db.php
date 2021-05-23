<?php


class DB
{
    private $connection;

    function __construct()
    {

        $dbtype = "mysql";
        $host = "localhost";
        $dbname = "applause_gen";
        $username = "root";
        $password = "";

        $dsn = "$dbtype:host=$host;dbname=$dbname";

        $this->connection = new PDO($dsn, $username, $password);
    }

    function getConnection()
    {
        return $this->connection;
    }
}


?>