<?php

namespace App\Class;

use App\DatabaseConnection;

class ProfileClass
{
    public function resetPassword()
    {
        $obj = new DatabaseConnection;
        $conn = $obj->getConnection();

        $username = $_SESSION['user']['username'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password']; 

        if (strlen($password) < 8 || strlen($confirm_password) < 8) {
            $_SESSION['error'] = 'Password must be at least 8 characters long!';
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile/reset-password');
        }

        if ($password === $confirm_password) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password = :password WHERE Username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'password' => $password,
                'username' => $username
            ]);

            $_SESSION['message'] = "Password changed successfully";
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        } else {
            $_SESSION['error'] = "Passwords do not match";
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile/reset-password');
        }
    }

    public function purchase()
    {
        $obj = new DatabaseConnection;
        $conn = $obj->getConnection();

        $uID = $_SESSION['user']['uID'];
        $workoutID = $_GET['WorkoutID'];

        // Check if user has already purchased this workout
        $sql = "SELECT * FROM purchases WHERE uID = :uID AND WorkoutID = :workoutID";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'uID' => $uID,
            'workoutID' => $workoutID
        ]);
        $purchase = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($purchase) {
            $_SESSION['message'] = "You have already purchased this workout.";
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        }

        // Check if user has an active subscription for another workout
        $sql = "SELECT * FROM purchases WHERE uID = :uID AND ExpirationDate > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'uID' => $uID
        ]);
        $subscription = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($subscription && $subscription['WorkoutID'] != $workoutID) {
            $_SESSION['message'] = "You already have an active subscription for another workout.";
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        }

        // Insert new purchase record
        $sql = "INSERT INTO purchases (uID, WorkoutID, PurchaseDate, ExpirationDate) VALUES (:uID, :workoutID, NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH))";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'uID' => $uID,
                'workoutID' => $workoutID
            ]);

            $_SESSION['message'] = "Workout purchased successfully";
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        } catch (\PDOException $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
            return new \Laminas\Diactoros\Response\RedirectResponse('/error');
        }
    }

    public function getWorkouts()
    {
        $obj = new DatabaseConnection;
        $conn = $obj->getConnection();

        $sql = "SELECT * FROM workouts WHERE WorkoutID != '1'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $workouts = $stmt->fetchAll();

        return $workouts;
    }

    public static function getWorkout()
    {
        $obj = new DatabaseConnection;
        $conn = $obj->getConnection();

        $uID = $_SESSION['user']['uID'];

        $sql = "SELECT * FROM purchases 
        INNER JOIN workouts
            ON purchases.WorkoutID = workouts.WorkoutID
        WHERE uID = :uID AND ExpirationDate > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'uID' => $uID
        ]);

        $workout = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $workout;
    }
}