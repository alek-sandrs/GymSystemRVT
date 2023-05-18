<?php

namespace App\Class;

use App\DatabaseConnection;
use App\Class\SessionStart;

class LoginClass
{
    public function login() 
    {
        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE username = '$username'";

            if ($conn->query($sql)->rowCount() > 0) {
                if ($row = $conn->query($sql)->fetch()) {
                    if (password_verify($password, $row['Password'])) {
                        $obj = new SessionStart();
                        $obj->set($row);

                        return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
                    } else {
                        $_SESSION['error'] = 'Wrong password!';

                        return new \Laminas\Diactoros\Response\RedirectResponse('/login');
                    }
                }
            }
        }
    }
}