<?php
error_reporting(0);
require_once('../utils/Exceptions/BadRequestExceptoin.php');

class DatabaseHelper
{
    const HOST = "localhost";
    const USERNAME = "ZeeshanAli";
    const PASSWORD = "Zeeshan100";
    const DB = "blog_slotions";
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $this->connection = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DB);
            if ($this->connection->connect_errno) {
                throw new BadRequestExceptoin();
            }
        } catch (BadRequestExceptoin $e) {
            die($e->errorMessage());
        }
    }

    public function createTable($sqlQuery)
    {
        $this->connection->query($sqlQuery);
    }

    public function runSql($query)
    {
        $result = $this->connection->query($query);
        if ($result) {
            $this->connection->close();

            return true;
        } else {
            $this->connection->close();
            return false;
        }
    }

    public function getData($query)
    {
        $result = $this->connection->query($query);
        if ($result && $result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $this->connection->close();
            return $data;
        } else {
            $this->connection->close();
            return null;
        }

    }
}