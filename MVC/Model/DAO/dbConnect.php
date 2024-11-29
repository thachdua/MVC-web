<?php

const DB_HOSTNAME = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'qlpb';
const DB_PORT = '3306';

class dbConnect
{
    private string $hostname;
    private string $username;
    private string $password;
    private string $database;
    private string $port;
    private ?mysqli $connection;

    public function __construct()
    {
        $this->hostname = DB_HOSTNAME;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->database = DB_DATABASE;
        $this->port = DB_PORT;

        try {
            $this->connection = new mysqli(hostname: $this->hostname, username: $this->username, password: $this->password, database: $this->database, port: $this->port);
        } catch (mysqli_sql_exception) {
            $this->connection = null;
        }
    }

    public function executeQuery($query): mysqli_result|bool
    {
        $resultSet = $this->connection->query($query);
        if ($resultSet->num_rows > 0) {
            return $resultSet;
        }
        return false;
    }

    public function executeUpdate($query): mysqli_result|bool
    {
        return $this->connection->query($query);
    }

    public function __destruct()
    {
        $this->connection?->close();
    }
}
