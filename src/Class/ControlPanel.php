<?php

namespace App\Class;

use App\DatabaseConnection;

class ControlPanel 
{
    public function getUsers()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT 
            users.uID, 
            users.Username, 
            users.LastName, 
            users.isAdmin, 
            users.isTrainer, 
            IFNULL(workouts.WorkoutName, "NONE") AS WorkoutName
        FROM users
            LEFT JOIN purchases
        ON users.uID = purchases.uID
            LEFT JOIN workouts
        ON purchases.WorkoutID = workouts.WorkoutID
        ');
        $stmt->execute();
        $users = $stmt->fetchAll();

        return $users;
    }

    public function getUserCount()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT COUNT(*) FROM users');
        $stmt->execute();
        $userCount = $stmt->fetchColumn();

        return $userCount;
    }

    public function getSubscriptionCount()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT COUNT(*) FROM purchases');
        $stmt->execute();
        $subscriptionCount = $stmt->fetchColumn();

        return $subscriptionCount;
    }

    public function getEarnedMoney()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare(
        'SELECT SUM(Price) FROM purchases
            INNER JOIN workouts
        ON purchases.WorkoutID = workouts.WorkoutID');
        $stmt->execute();
        $earnedMoney = $stmt->fetchColumn();

        return $earnedMoney;
    }

    public function searchUsers($search)
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT 
            users.uID, 
            users.Username, 
            users.LastName, 
            users.isAdmin, 
            users.isTrainer, 
            IFNULL(workouts.WorkoutName, "NONE") AS WorkoutName
        FROM users
            LEFT JOIN purchases
        ON users.uID = purchases.uID
            LEFT JOIN workouts
        ON purchases.WorkoutID = workouts.WorkoutID
        WHERE users.Username LIKE :search OR users.LastName LIKE :search');
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $users = $stmt->fetchAll();
    }

    public function deleteUser()
    {
        $id = $_GET['userID'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();

        $stmt = $conn->prepare('DELETE FROM purchases WHERE uID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM users WHERE uID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getUser() 
    {
        $id = $_GET['userID'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE uID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch();

        // $rePass = password_needs_rehash($user['Password'], PASSWORD_DEFAULT);
        $uData = [
            'uID' =>$user['uID'], 
            'username' => $user['Username'],
            'password' => $user['Password'],
            'email' => $user['Email'],
            'name' => $user['Name'],
            'lastName' => $user['LastName'],
            'isAdmin' => $user['isAdmin'],
            'isTrainer' => $user['isTrainer'],
        ];
        
        return $uData;
    }

    public function editUser()
    {
        $id = $_POST['uID'];
        $username = $_POST['username'];
        // $password = $_POST['password'];
        $isAdmin = $_POST['isAdmin'];
        $isTrainer = $_POST['isTrainer'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('UPDATE users SET username = :username,
        --  password = :password, 
         isAdmin = :isAdmin, isTrainer = :isTrainer WHERE uID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':username', $username);
        // $stmt->bindValue(':password', $password);
        $stmt->bindValue(':isAdmin', $isAdmin);
        $stmt->bindValue(':isTrainer', $isTrainer);
        $stmt->execute();
    }

    public function getTrainers() 
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE isTrainer = 1');
        $stmt->execute();
        $trainers = $stmt->fetchAll();

        return $trainers;
    }

    public function getWorkout()
    {
        $id = $_GET['WorkoutID'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM workouts WHERE WorkoutID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $workout = $stmt->fetch();

        $wData = [
            'WorkoutID' => $workout['WorkoutID'],
            'WorkoutName' => $workout['WorkoutName'],
            'Description' => $workout['Description'],
            'Price' => $workout['Price']
        ];

        return $wData;
    }

    public function getWorkouts()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM workouts WHERE WorkoutName != "NONE"');
        $stmt->execute();
        $workouts = $stmt->fetchAll();

        return $workouts;
    }

    public function addWorkout() 
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();

        $stmt = $conn->prepare(
            "INSERT INTO workouts (WorkoutName, Description, Price) 
            VALUES (:workoutName, :Description, :Price)
        ");
        $stmt->bindValue(':workoutName', $_GET['WorkoutName']);
        $stmt->bindValue(':Description', $_GET['Description']);
        $stmt->bindValue(':Price', $_GET['Price']);
        $stmt->execute();
    }
    
    public function deleteWorkout()
    {
        $id = $_GET['WorkoutID'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();

        $stmt = $conn->prepare('DELETE FROM purchases WHERE WorkoutID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM workouts WHERE WorkoutID = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function editWorkout()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();

        $stmt = $conn->prepare("UPDATE workouts SET WorkoutName = :workoutName, Description = :Description, Price = :Price WHERE WorkoutID = :id");
        $stmt->bindValue(':id', $_POST['WorkoutID']);
        $stmt->bindValue(':workoutName', $_POST['WorkoutName']);
        $stmt->bindValue(':Description', $_POST['Description']);
        $stmt->bindValue(':Price', $_POST['Price']);
        $stmt->execute();
    }

    public function searchWorkouts()
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM workouts WHERE WorkoutName LIKE :search;');
        $stmt->bindValue(':search', '%' . $_GET['search'] . '%');
        $stmt->execute();
        $workouts = $stmt->fetchAll();

        return $workouts;
    }
}