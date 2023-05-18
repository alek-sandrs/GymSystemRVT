<?php

namespace App\Class;

use App\DatabaseConnection;

class SessionStart {
    public function set($row) 
    {
        $_SESSION['user'] = [
            'uID' => $row['uID'],
            'username' => $row['Username'],
            'email' => $row['Email'],
            'Name' => $row['Name'],
            'lastName' => $row['LastName'],
            'isAdmin' => $row['isAdmin'],
            'isTrainer' => $row['isTrainer']
        ];
    }

    public static function get() 
    {
        return $_SESSION['user'];
    }

    public function destroy()
    {
        unset($_SESSION['user']);
    }
}