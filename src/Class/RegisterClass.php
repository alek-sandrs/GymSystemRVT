<?php

namespace App\Class;

use App\DatabaseConnection;

class RegisterClass 
{
    public function register()
    {   
        if (!empty($_POST)) {
            $obj = new DatabaseConnection();
            $conn = $obj->getConnection();

            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $sql = "SELECT * FROM users WHERE username = '$username'";

            if (empty($username) && empty($password) && empty($confirm_password)) {
                $_SESSION['error'] = 'Please fill in all the fields!';
                return new \Laminas\Diactoros\Response\RedirectResponse('/registration');
            }

            if (strlen($username) < 5) {
                $_SESSION['error'] = 'Username must be at least 5 characters long!';
                return new \Laminas\Diactoros\Response\RedirectResponse('/registration');
            }

            if (strlen($password) < 8 || strlen($confirm_password) < 8) {
                $_SESSION['error'] = 'Password must be at least 8 characters long!';
                return new \Laminas\Diactoros\Response\RedirectResponse('/registration');
            }

            if ($conn->query($sql)->rowCount() > 0){
                $_SESSION['error'] = 'Username already exists!';
                return new \Laminas\Diactoros\Response\RedirectResponse('/registration');
            }

            if ($password === $confirm_password) {
                $obj = new DatabaseConnection();
                $conn = $obj->getConnection();
                
                $sql = "SELECT * FROM users";
                if ($conn->query($sql)->rowCount() === 0) {
                    $isAdmin = 1;
                    $isTrainer = 0;
                } else {
                    $isAdmin = 0;
                    $isTrainer = 0;
                }

                $password = password_hash($password, PASSWORD_DEFAULT);
                $registrationDate = date('Y-m-d H:i:s');

                $sql = "INSERT INTO users (username, password, RegistrationDate, isAdmin, isTrainer) VALUES ('$username', '$password', '$registrationDate', '$isAdmin', '$isTrainer')";
                $conn->exec($sql);

                $_SESSION['message'] = 'You have successfully registered!';
            } else {
                $_SESSION['error'] = 'Passwords do not match!';
                return new \Laminas\Diactoros\Response\RedirectResponse('/registration');
            }
        }
    }
}