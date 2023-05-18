<?php

namespace App;

class DatabaseConnection
{
    private $conn;
    public function __construct()
    {
        $this->conn = new \PDO('mysql:host=localhost;dbname=gymsystemrvt', 'root', '');

        $tables = 
        "
        CREATE TABLE IF NOT EXISTS Users (
            uID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(255) NOT NULL,
            Name VARCHAR(255) NULL,
            LastName VARCHAR(255) NULL,
            Email VARCHAR(255) NULL,
            Password VARCHAR(255) NOT NULL,
            RegistrationDate DATE NOT NULL,
            isAdmin BOOL NOT NULL,
            isTrainer BOOL NOT NULL
        );
            
        CREATE TABLE IF NOT EXISTS Memberships (
            MembershipID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            MembershipName VARCHAR(50) NOT NULL,
            Price DECIMAL(8, 2) NOT NULL,
            Description VARCHAR(255),
            Duration INT NOT NULL
        );
            
        CREATE TABLE IF NOT EXISTS Workouts (
            WorkoutID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            WorkoutName VARCHAR(50) NOT NULL,
            Description VARCHAR(255),
            Price DECIMAL(8, 2) NOT NULL
        );
        
        INSERT INTO Workouts (WorkoutName, Description, Price) 
        SELECT 'NONE', 'NONE.', '0.00'
        WHERE NOT EXISTS (SELECT * FROM Workouts WHERE WorkoutName = 'NONE');

        CREATE TABLE IF NOT EXISTS WorkoutSchedule (
            ScheduleID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            WorkoutID INT NOT NULL,
            DateAndTime DATETIME NOT NULL,
            RegisteredUsers INT NOT NULL,
            FOREIGN KEY (WorkoutID) REFERENCES Workouts(WorkoutID)
        );
            
        CREATE TABLE IF NOT EXISTS WorkoutRegistrations (
            RegistrationID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            uID INT NOT NULL,
            ScheduleID INT NOT NULL,
            MembershipID INT NOT NULL,
            RegistrationDate DATE NOT NULL,
            FOREIGN KEY (uID) REFERENCES Users(uID),
            FOREIGN KEY (ScheduleID) REFERENCES WorkoutSchedule(ScheduleID),
            FOREIGN KEY (MembershipID) REFERENCES Memberships(MembershipID)
        );
        
        CREATE TABLE IF NOT EXISTS Purchases (
            PurchaseID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            uID INT NOT NULL,
            WorkoutID INT NOT NULL,
            PurchaseDate DATE NOT NULL,
            ExpirationDate DATE NOT NULL,
            FOREIGN KEY (uID) REFERENCES Users(uID),
            FOREIGN KEY (WorkoutID) REFERENCES Workouts(WorkoutID)
        );
        
        
        ";
        
        $this->conn->exec($tables);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}