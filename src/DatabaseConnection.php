<?php

namespace App;

class DatabaseConnection
{
    private $conn;
    public function __construct()
    {
        $this->conn = new \PDO('mysql:host=localhost;dbname=gymsystemrvt', 'root', '');

        $users_table = 
        "
            CREATE TABLE IF NOT EXISTS users (
                uID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
                isTrainer BOOLEAN NOT NULL DEFAULT FALSE
            )
        ";
        
        $this->conn->exec($users_table);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}