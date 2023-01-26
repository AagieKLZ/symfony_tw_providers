<?php

use Symfony\Component\Dotenv\Dotenv;
use mysqli;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        (new Dotenv())->load(__DIR__.'/../.env');
        $host = $_ENV['DATABASE_HOST'];
        $username = $_ENV['DATABASE_USER'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $dbname = $_ENV['DATABASE_NAME'];

        $this->connection = new mysqli($host, $username, $password, $dbname);

        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
